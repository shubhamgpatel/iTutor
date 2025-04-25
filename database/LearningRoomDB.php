<?php
// this file does all CRUD operations
// normal learning room do get set process

require_once "classes/models/LearningRoom.php";
require_once "classes/connect.php";

class LearningRoomDb extends Database
{
    //calling basic constructor
    public function __construct()
    {
    }

    //list method to list all the rooms from the database
    public function ListAll()
    {
        $sql = "SELECT * FROM learning_rooms";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->execute();
        $learningrooms = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $learningrooms;
    }

    //add method taking learning room object
    public function Add($LearningRoom)
    {
        $sql = "INSERT INTO learning_rooms (room_number,created_datetime) VALUES (:room_number,CURRENT_TIMESTAMP())";
        $pdostm = parent::getDb()->prepare($sql);
        $room_number = $LearningRoom->getRoomNumber();
        $pdostm->bindParam(':room_number', $room_number);        

        $numRowsAffected = $pdostm->execute();
        return $numRowsAffected;

    }
    //update method that takes 2 parameters
    //One is object of learningroom and other is ID which we would like to update
    public function Update($learningRoom,$id)
    {
        $sql = "Update learning_rooms set room_number = :room_number where id= :id";
        $pdostm = parent::getDb()->prepare($sql);
   
        $getRoomNo = $learningRoom->getRoomNumber();
        $pdostm->bindParam(':room_number', $getRoomNo);
        $pdostm->bindParam(':id', $id);

        $numRowsAffected = $pdostm->execute();
        return $numRowsAffected;
    }
    //this method is used to delete a particular room
    public function Delete($id)
    {
        $sql = "DELETE FROM learning_rooms WHERE id = :id";

        $pst = parent::getDb()->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;
    }
    //this method is used to get the details of specific room for checking
    public function Get($room_number)
    {   
        $sql = "select * from learning_rooms where room_number = :room_number";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':room_number', $room_number);
        $pdostm->execute();
        $roomno = $pdostm->fetch(PDO::FETCH_OBJ);
        return $roomno;
    }
    public function Getbyid($id)
    {   
        $sql = "select * from learning_rooms where id = :id";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $pdostm->execute();
        $roomno = $pdostm->fetch(PDO::FETCH_OBJ);
        return $roomno;
    }
    //this method is used to search rooms from the list
    public function Search($room_number)
    {
        $sql = "SELECT * FROM learning_rooms where room_number LIKE :room_number";
        $pdostm = parent::getDb()->prepare($sql);
        $searchKey = '%' . strtolower($room_number) . '%';
        $pdostm->bindParam(':room_number', $searchKey);
        $pdostm->execute();

        $learningRoom = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $learningRoom;
    }
}
