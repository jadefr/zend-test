<?php

namespace Person\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Person\Form\PersonForm;

class PersonController extends AbstractActionController {

    private $table;

    public function __construct($table) {
        $this->table = $table;
    }

    public function indexAction() {
		return new ViewModel(['persons' => $this->table->getAll()]); // para retornar todos os registros do banco de dados
	}

	public function addAction(){

        $form = new PersonForm();
        //$form->get('submit')->setValue('Adicionar');
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return new ViewModel(['form'=>$form]);
        }

        $person = new \Person\Model\Person();
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            return new ViewModel(['form'=>$form]);
        }

        $person->exchangeArray($form->getData());
        $this->table->savePerson($person);

	    return $this->redirect()->toRoute('person');
    }

    public function editAction(){
        $id = (int) $this->params()->fromRoute('id',0);
        if ($id === 0) {
            return $this->redirect()->toRoute('person',['action' => 'add']);
        }

        try {
            $person = $this->table->getPerson($id);
        } catch (Exception $exception) {
            //echo $exception->getTraceAsString();
            return $this->redirect()->toRoute('person',['action' => 'index']);
        }

        $form = new PersonForm();
        $form->bind($person);
        $form->get('submit')->setAttribute('value', 'Salvar'); //pega o botão e muda o label pra Salvar
        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if(!$request->isPost()) {
            return $viewData;
        }

        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return $viewData;
        }

        //$person->exchangeArray($form->getData());
        $this->table->savePerson($form->getData());
	    return $this->redirect()->toRoute('person');
    }

    public function removeAction(){
        $id = (int) $this->params()->fromRoute('id',0);
        if ($id === 0) {
            return $this->redirect()->toRoute('person');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $delete = $request->getPost('delete', 'Não');
            if ($delete == 'Sim') {
                $id = (int) $request->getPost('id');
                $this->table->deletePerson($id);
            }
            return $this->redirect()->toRoute('person');
        }
        return ['id' => $id, 'person' => $this->table->getPerson($id)];
    }

}