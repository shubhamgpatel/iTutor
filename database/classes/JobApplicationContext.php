<?php
/*
    Created by : Priyanka Khadilkar
    This file contains all the queries or CRUD with table job_applications for listing the job application
*/
require_once "connect.php";
require_once "models/JobApplication.php";

class JobApplicationContext extends Database
{
    public function __construct()
    {

    }

    //Add job application into database
    public function Add($JobApplication)
    {

        $sql = "INSERT INTO job_applications (firstname, lastname, email,phone_number,resume_filename,job_id,applied_On) VALUES (:first_name,:last_name,:email,:phone_number,:resume_filename,:job_id,:applied_On)";

       //Saving the date into database for
        $date = date('Y-m-d H:i:s');
        $pdostm = parent::getDb()->prepare($sql);

        $firstName = $JobApplication->getFirstName();
        $lastName = $JobApplication->getLastName();
        $email = $JobApplication->getEmail();
        $phoneNumber = $JobApplication->getPhoneNumber();
        $jobId = (int)$JobApplication->getJobId();
        $resumeFileName = $JobApplication->getResumeFileName();

        $pdostm->bindParam(':first_name', $firstName);
        $pdostm->bindParam(':last_name', $lastName);
        $pdostm->bindParam(':email', $email);
        $pdostm->bindParam(':phone_number', $phoneNumber);
        $pdostm->bindParam(':resume_filename', $resumeFileName);
        $pdostm->bindParam(':job_id', $jobId);
        $pdostm->bindParam(':applied_On', $date);

        $numRowsAffected = $pdostm->execute();
        return $numRowsAffected;
    }

    //Delete job application from the database
    public function Delete($id)
    {
        $sql = "DELETE FROM job_applications WHERE id = :id";
        $pst = parent::getDb()->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;
    }

    //Search from job application
    public function Search($JobPostId, $SearchKeyword)
    {
        //Search with job post
        if ($JobPostId != "" && $SearchKeyword == "") {
            $sql = "select j.id,j.firstname,j.lastname,j.email,j.job_id,jp.title,j.phone_number,j.resume_filename from job_applications j inner join job_post jp on j.job_id=jp.id where jp.id = :jobPostId";
            $pst = parent::getDb()->prepare($sql);
            $pst->bindParam(':jobPostId', $JobPostId);
        } else if ($JobPostId == "" && $SearchKeyword != "") {
            //search with search keyword
            $sql = "select j.id,j.firstname,j.lastname,j.email,j.job_id,jp.title,j.phone_number,j.resume_filename from job_applications j inner join job_post jp on j.job_id=jp.id where LOWER(j.firstname) LIKE :searchKey OR LOWER(j.lastname) LIKE :searchKey OR LOWER(j.email) LIKE :searchKey OR LOWER(j.phone_number) LIKE :searchKey OR LOWER(jp.title) LIKE :searchKey ";
            $searchKey = '%' . strtolower($SearchKeyword) . '%';
            $pst = parent::getDb()->prepare($sql);
            $pst->bindParam(':searchKey', $searchKey);
        }
        else if($JobPostId != "" && $SearchKeyword != "")
        {
            //search with both like job post and searchkeyword
            $sql = "select j.id,j.firstname,j.lastname,j.email,j.job_id,jp.title,j.phone_number,j.resume_filename from job_applications j inner join job_post jp on j.job_id=jp.id where LOWER(j.firstname) LIKE :searchKey OR LOWER(j.lastname) LIKE :searchKey OR LOWER(j.email) LIKE :searchKey OR LOWER(j.phone_number) LIKE :searchKey OR LOWER(jp.title) LIKE :searchKey  OR jp.id = :jobPostId";
            $pst = parent::getDb()->prepare($sql);
            $pst->bindParam(':jobPostId', $JobPostId);
        }
        else
        {
            //If nothing is passed then it will list all the data.
            $sql = "select j.id,j.firstname,j.lastname,j.email,j.job_id,jp.title,j.phone_number,j.resume_filename from job_applications j inner join job_post jp on j.job_id=jp.id";
            $pst = parent::getDb()->prepare($sql);
        }
        $pst->execute();
        $jobApplications = $pst->fetchAll(PDO::FETCH_OBJ);
        return $jobApplications;
    }

    //Function to list all job applications
    public function ListAll()
    {
        $sql = "select j.id,j.firstname,j.lastname,j.email,j.job_id,jp.title,j.phone_number,j.resume_filename from job_applications j inner join job_post jp on j.job_id=jp.id";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->execute();
        $jobApplications = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $jobApplications;
    }

    //Function to list job application by job id.
    public function GetById($id)
    {
        $sql = "select j.id,j.firstname,j.lastname,j.email,j.job_id,jp.title,j.phone_number,j.resume_filename from job_applications j inner join job_post jp on j.job_id=jp.id where j.id = :id";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $pdostm->execute();
        $jobopenings = $pdostm->fetch(PDO::FETCH_OBJ);
        return $jobopenings;
    }
}