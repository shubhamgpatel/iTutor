<?php

/*
    Created by : Priyanka Khadilkar
    Properties of job post page
*/
class JobPost
{
    private $jobTitle;
    private $jobDesceiption;
    private $createdDatetime;
    private $updatedDatetime;

    public function __construct($jobTitle, $jobDesceiption)
    {
        $this->setJobTitle($jobTitle);
        $this->setJobDescription($jobDesceiption);
    }

    public function setJobTitle($value)
    {
        $this->jobTitle = $value;
    }

    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    public function setJobDescription($value)
    {
        $this->jobDesceiption = $value;
    }

    public function getJobDescription()
    {
        return $this->jobDesceiption;
    }

}