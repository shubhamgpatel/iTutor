<?php

/*
    Created by : Priyanka Khadilkar
    Properties of User page
*/
class User
{
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $phoneNumber;
    private $dateOFBirth;
    private $genderId;
    private $roleId;
    private $createdDatetime;
    private $updatedDatetime;

    public function __construct($firstName, $lastName, $email, $password, $phoneNumber, $dateOFBirth, $genderId, $roleId)
    {
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setPhoneNumber($phoneNumber);
        $this->setDateOFBirth($dateOFBirth);
        $this->setGenderId($genderId);
        $this->setRoleId($roleId);
    }

    public function setFirstName($value)
    {
        $this->firstName = $value;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setLastName($value)
    {
        $this->lastName = $value;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setEmail($value)
    {
        $this->email = $value;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($value)
    {
        $this->password = $value;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPhoneNumber($value)
    {
        $this->phoneNumber = $value;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setDateOFBirth($value)
    {
        $date = date_create($value);
        $value = date_format($date, "Y-m-d");
        $this->dateOFBirth = $value;
    }

    public function getDateOfBirth()
    {
        return $this->dateOFBirth;
    }

    public function setGenderId($value)
    {
        $this->genderId = $value;
    }

    public function getGenderId()
    {
        return $this->genderId;
    }

    public function setRoleId($value)
    {
        $this->roleId = $value;
    }

    public function getRoleId()
    {
        return $this->roleId;
    }
    
}