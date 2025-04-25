<?php
/*
 *  Developed by : Priyanka Khadilkar
    This file is being used for the all the database communication
   to the job_post table (CRUD)
*/
require_once "connect.php";
require_once "models/JobPost.php";

class JobPostContext extends Database
{
    public function __construct()
    {
    }

    //This function will List all job post records
    public function ListAll()
    {
        //Query to selecting all the job post from the database
        $sql = "SELECT * FROM job_post";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->execute();

        $jobopenings = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $jobopenings;

    }

    //Search job post list with the job post title.
    public function Search($searchKey)
    {
        $sql = "SELECT * FROM job_post where LOWER(title) LIKE :searchKey OR LOWER(description) LIKE :searchKey";
        $pdostm = parent::getDb()->prepare($sql);
        $searchKey = '%' . strtolower($searchKey) . '%';
        $pdostm->bindParam(':searchKey', $searchKey);
        $pdostm->execute();

        $jobOpenings = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $jobOpenings;
    }

    //This function to add job post into the database
    public function Add($JobPost)
    {
        $sql = "INSERT INTO job_post (title, description, created_datetime) VALUES (:jobtitle, :jobdescription, :createdDatetime)";
        $date = date('Y-m-d H:i:s');
        $pdostm = parent::getDb()->prepare($sql);
        $JobTitle = $JobPost->getJobTitle();
        $JobDesc = $JobPost->getJobDescription();
        $pdostm->bindParam(':jobtitle', $JobTitle);
        $pdostm->bindParam(':jobdescription', $JobDesc);
        $pdostm->bindParam(':createdDatetime', $date);

        $numRowsAffected = $pdostm->execute();
        return $numRowsAffected;

    }

    //This function to update job post into the database
    public function Update($JobPost, $id)
    {
        $sql = "Update job_post set title = :jobtitle, description = :jobdescription where id= :id";
        $pdostm = parent::getDb()->prepare($sql);
        $JobTitle = $JobPost->getJobTitle();
        $JobDesc = $JobPost->getJobDescription();
        $pdostm->bindParam(':jobtitle', $JobTitle);
        $pdostm->bindParam(':jobdescription', $JobDesc);
        $pdostm->bindParam(':id', $id);

        $numRowsAffected = $pdostm->execute();
        return $numRowsAffected;

    }

    //This function to delete job post into the database
    public function Delete($id)
    {
        $sql = "DELETE FROM job_post WHERE id = :id";

        $pst = parent::getDb()->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;

    }

    //This function to get job post by id into the database
    public function Get($id)
    {
        $sql = "select * from job_post where id = :id";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $pdostm->execute();
        $jobOpening = $pdostm->fetch(PDO::FETCH_OBJ);
        return $jobOpening;

    }


}
