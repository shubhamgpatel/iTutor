<?php
require_once "connect.php";

class SubjectContext extends Database
{
    public function __construct()
    {
    }

    public function getSubject($subjectID)
    {
      $sql = "select * from subjects where id = :subject_id";
      $pdostm =parent::getDb()->prepare($sql);
      $pdostm->bindParam(':subject_id', $subjectID); 
      $pdostm->execute();
      $subject = $pdostm->fetchAll(PDO::FETCH_ASSOC);
      // var_dump($subject);
      
      return $subject;
    }

    public function getAllSubjects()
    {
      $sql = "select * from subjects";
      $pdostm =parent::getDb()->prepare($sql);
      $pdostm->execute();
      $subjects = $pdostm->fetchAll(PDO::FETCH_ASSOC);
      return $subjects;
    }

    public function addSubject($title,$subject_field,$description,$db) {
      $datetime = (string) date('Y-m-d H:i:s', time());
      $sql = "INSERT INTO subjects (title,subject_field,description,created_datetime)
      VALUES (:title,:subject_field, :description, :created_datetime)";

      $pst = $db->prepare($sql);

      $pst->bindParam(':title',$title);
      $pst->bindParam(':subject_field',$subject_field);
      $pst->bindParam(':description',$description);
      $pst->bindParam(':created_datetime',$datetime);

      $count = $pst->execute();
      return $count;

    }

    public function deleteSubject($id,$db){
      $sql = "DELETE FROM subjects WHERE id = :id";

      $pst = $db->prepare($sql);
      $pst->bindParam(':id',$id);
      $count = $pst->execute();
      return $count;
    }

    public function updateSubject($id,$title,$subject_field,$description,$db){
      $datetime = (string) date('Y-m-d H:i:s', time());
      $sql = "UPDATE subjects 
              SET title = :title,
              subject_field = :subject_field,
              description = :description,
              updated_datetime = :datetime
              WHERE id = :id";
      
      $pst = $db->prepare($sql);

      $pst->bindParam(':title',$title);
      $pst->bindParam(':subject_field',$subject_field);
      $pst->bindParam(':description',$description);
      $pst->bindParam(':id',$id);
      $pst->bindParam(':datetime',$datetime);

      $count = $pst->execute();

      return $count;
    }

    public function Search($title,$db){
      $sql = "SELECT * FROM subjects WHERE title LIKE :title";
      $pst = $db->prepare($sql);
      $searchKey = '%' . strtolower($title) . '%';
      $pst->bindParam(':title',$searchKey);
      $pst->execute();

      $subject = $pst->fetchAll(PDO::FETCH_ASSOC);
      return $subject;
    }

}
?>
