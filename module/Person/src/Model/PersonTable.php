<?php

namespace Person\Model;
use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class PersonTable {

    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function getAll() {
        return $this->tableGateway->select();
    }

    public function getPerson($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]); //conjunto de linhas que o BD retorna com base nos parâmetros passados
        $row = $rowset->current(); // registro a ser retornado

        if(!$row) { // se o row for vazio
            throw new RuntimeException(sprintf('Não foi encontrado o id %d', $id));
        }

        return $row;
    }

    public function savePerson(Person $person) {
        $data = [
            'id' => $person->getId(),
            'name' => $person->getName(),
            'surname' => $person->getSurname(),
            'email' => $person->getEmail(),
            'situation' => $person->getSituation(),
        ];

        $id = (int) $person->getId();
        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }
        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deletePerson($id) {
        $this->tableGateway->delete(['id' => (int) $id]);
    }

}