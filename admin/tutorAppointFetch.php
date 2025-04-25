<?php
$tutor_name = "";
    include_once "../database/classes/TutorAppointmentContext.php";
if(isset($_POST['id'] )) {
        $TutorAppointmentContext = new TutorAppointmentContext();
        $result = $TutorAppointmentContext->getTutorSubject($_POST['id']);
        // var_dump($result);
        if($result){
            // echo "Tutor : ".implode(', ', $result);
            echo "Tutor : ".$result['users_first_name'];
        }else{
            echo "No tutors found!!";
        }
        
        }
?>