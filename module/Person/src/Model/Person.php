<?php

namespace Person\Model;

class Person implements \Zend\Stdlib\ArraySerializableInterface {

    private $id;
    private $name;
    private $surname;
    private $email;
    private $situation;

    public function exchangeArray(array $data) {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->name = !empty($data['name']) ? $data['name'] : null;
        $this->surname = !empty($data['surname']) ? $data['surname'] : null;
        $this->email = !empty($data['email']) ? $data['email'] : null;
        $this->situation = !empty($data['situation']) ? $data['situation'] : null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSituation()
    {
        return $this->situation;
    }

    public function setSituation($situation)
    {
        $this->situation = $situation;
    }


    /**
     * Return an array representation of the object
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'situation' => $this->situation,
        ];
    }
}