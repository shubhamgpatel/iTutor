<?php

/*
    Created by : Priyanka Khadilkar
    Properties of job application page
*/
class JobApplication
{
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $phoneNumber;
    private $resumeFileName;
    private $jobId;

    public function __construct($firstName, $lastName, $email, $phoneNumber, $resumeFileName, $jobId)
    {
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setEmail($email);
        $this->setPhoneNumber($phoneNumber);
        $this->setResumeFileName($resumeFileName);
        $this->setJobId($jobId);
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

    public function setResumeFileName($value)
    {
        $this->resumeFileName = $value;
    }

    public function getResumeFileName()
    {
        return $this->resumeFileName;
    }

    public function setPhoneNumber($value)
    {
        $this->phoneNumber = $value;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setJobId($value)
    {
        $this->jobId = $value;
    }

    public function getJobId()
    {
        return $this->jobId;
    }

}