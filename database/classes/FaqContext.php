<?php

// require_once "../../vendor/autoload.php";

class FaqContext extends Database
{
    public function __construct()
    {
    }

    public function ListAll()
    {
        $sql = "SELECT * FROM faqs";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->execute();

        $faqs = $pdostm->fetchAll(PDO::FETCH_OBJ);
        // var_dump($faqs);
        return $faqs;
    }

    public function Add($Faq)
    {
        $sql = "INSERT INTO faqs (question, answer, created_datetime ) VALUES (:faqquestion,:faqanswer, :createdDatetime)";
        $date = date('Y-m-d H:i:s');
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':faqquestion', $Faq['question']);
        $pdostm->bindParam(':faqanswer', $Faq['answer']);
        $pdostm->bindParam(':createdDatetime', $date);


        $numRowsAffected = $pdostm->execute();
        return $numRowsAffected;
    }

    public function Update($Faq, $id)
    {
        $sql = "Update faqs set question = :faqquestion, answer = :faqanswer where id= :id";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':faqquestion', $Faq['question']);
        $pdostm->bindParam(':faqanswer', $Faq['answer']);
        $pdostm->bindParam(':id', $id);

        $numRowsAffected = $pdostm->execute();
        return $numRowsAffected;
    }

    public function Delete($id)
    {
        $sql = "DELETE FROM faqs WHERE id = :id";

        $pst = parent::getDb()->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;
    }

    public function Get($id)
    {
        $sql = "select * from faqs where id = :id";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $pdostm->execute();
        $faqs = $pdostm->fetch(PDO::FETCH_OBJ);
        return $faqs;
    }
    public function Search($faqsearchkey)
    {
        $sql = "SELECT * FROM faqs where LOWER(question) LIKE :faqsearchkey";
        $pdostm = parent::getDb()->prepare($sql);
        $faqsearchkey = '%' . strtolower($faqsearchkey) . '%';
        $pdostm->bindParam(':faqsearchkey', $faqsearchkey);
        $pdostm->execute();

        $faqs = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $faqs;
    }
}
