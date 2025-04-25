<?php
//  require_once "../includes/adminHeader.php";
require_once "connect.php";
include_once "../database/classes/models/TutorAppointment.php";      //CRUD operations file
class TutorAppointmentContext extends Database
{
    public function __construct() 
    {
    }

    public function getTutorSubject($subject_id)
    {
      $sql = "select TS.id AS tutor_subject_id,TS.tutor_id AS tutor_subject_tutor_id, TS.subject_id AS tutor_subject_subject_id,
T.id AS tutors_tutor_id,T.user_id AS tutors_user_id,T.qualification AS tutors_qualification,T.experience AS tutors_experience,T.tutor_field AS tutors_tutor_field, T.hourly_rate AS tutors_hourly_rate, S.title AS subject_title,
U.id AS users_id, U.first_name AS users_first_name, U.last_name AS user_last_name, U.email AS user_email, U.role_id AS users_role_id
      from tutor_subject TS inner join tutors T on TS.tutor_id = T.id
                            inner join users U on T.user_id = U.id 
                            inner join subjects S on TS.subject_id = S.id
                            where TS.subject_id = :subject_id";
      $pdostm = parent::getDb()->prepare($sql);
      $pdostm->bindParam(':subject_id', $subject_id); 
      
      $pdostm->execute();
      $tutor = $pdostm->fetch(PDO::FETCH_ASSOC);
      return $tutor;
    }


    public function getAllTutors()
    {
      $sql = "select * from tutors t, users u where u.id = t.user_id";
      $pdostm = parent::getDb()->prepare($sql);
      $pdostm->execute();
      $tutors = $pdostm->fetchAll(PDO::FETCH_ASSOC);
      return $tutors;
    }
    public function Add($TutorAppointmentContext)
    {
        $sql = "INSERT INTO tutor_appointment_bookings (user_id, tutor_id, subject_id, learning_room_id, date_time, message, is_confirmed,created_datetime) VALUES (:user_id,:tutor_id,:subject_id,:learning_room_id,:date_time,:message,:is_confirmed,:created_datetime)";
        $date = date('Y-m-d H:i:s');
        $pdostm = parent::getDb()->prepare($sql);
        // echo "User id : ".$TutorAppointmentContext->getuserid();

        $user_id = $TutorAppointmentContext->getuserid();
        $tutor_id = $TutorAppointmentContext->gettutorid();
        $subject_id = $TutorAppointmentContext->getsubjectid();
        $learning_room_id = $TutorAppointmentContext->getlearningroomid();
        $date_time = $TutorAppointmentContext->getdatetime();
        $message = $TutorAppointmentContext->getmessage();
        $is_confirmed = $TutorAppointmentContext->getisconfirmed();
        // echo "<br>is confirmed : ".$TutorAppointmentContext->getisconfirmed();

        $pdostm->bindParam(':user_id', $user_id);        
        $pdostm->bindParam(':tutor_id', $tutor_id);        
        $pdostm->bindParam(':subject_id', $subject_id);        
        $pdostm->bindParam(':learning_room_id', $learning_room_id);        
        $pdostm->bindParam(':date_time', $date_time);        
        $pdostm->bindParam(':message', $message);        
        $pdostm->bindParam(':is_confirmed', $is_confirmed);      
        $pdostm->bindParam(':created_datetime', $date);  
        // var_dump($pdostm);
        $numRowsAffected = $pdostm->execute();
        return $numRowsAffected;

    }
    public function ListAll($userId)
    {
      // require_once "../includes/adminHeader.php";
      // echo $sessionData->userId;
        $sql = "SELECT * FROM tutor_appointment_bookings where user_id = $userId";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->execute();
        $tutor_appointment_bookings = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $tutor_appointment_bookings; 
    }
   
    public function ListAlll()
    {
      // require_once "../includes/adminHeader.php";
      // echo $sessionData->userId;
        $sql = "SELECT * FROM tutor_appointment_bookings";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->execute();
        $tutor_appointment_bookings = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $tutor_appointment_bookings;
    }
    public function Delete($id)
    {
        $sql = "DELETE FROM tutor_appointment_bookings WHERE id = :id";

        $pst = parent::getDb()->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;
    }
    public function Get($user_id)
    {   
        $sql = "select * from users where id = :user_id";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':user_id', $user_id);
        $pdostm->execute();
        $user_id = $pdostm->fetch(PDO::FETCH_OBJ);
        return $user_id;
    }
    public function Gettutor($user_id)
    {   
        $sql = "select tt.id as ttutor_id,tt.user_id as tutor_user_id,us.id as user_id from tutors tt inner join users us on tt.user_id = us.id where us.id = :user_id";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':user_id', $user_id);
        $pdostm->execute();
        $user_id_query = $pdostm->fetch(PDO::FETCH_OBJ);
        return $user_id_query;
    }
    public function ListAllTutor($userId)
    {
        $sql = "SELECT * FROM tutor_appointment_bookings ts Inner join users us on ts.user_id = us.id inner join tutors tt on tt.id = ts.tutor_id WHERE ts.tutor_id = $userId";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->execute();
        $tutor_appointment_bookings = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $tutor_appointment_bookings; 
    }
    public function GetEdit($id)
    {   
        $sql = "select * from tutor_appointment_bookings where id = :id";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $pdostm->execute();
        $user_id = $pdostm->fetch(PDO::FETCH_OBJ);
        return $user_id;
    }
    public function Update($value,$id)
    { //set room_number = :room_number where id= :id"
        $sql = "Update tutor_appointment_bookings set is_confirmed = :value where id = :id";
        $pdostm = parent::getDb()->prepare($sql);
   
        // $getRoomNo = $learningRoom->getRoomNumber();
        $pdostm->bindParam(':value', $value);
         $pdostm->bindParam(':id', $id);

        $numRowsAffected = $pdostm->execute();
        return $numRowsAffected;
    }
}
