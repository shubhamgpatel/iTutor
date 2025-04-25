<?php require_once "../includes/adminHeader.php";

require_once "../database/classes/models/TutorAppointment.php";
require_once "../database/classes/TutorAppointmentContext.php"; //crud functions
include_once "../database/LearningRoomDb.php";
if(isset($_POST['update_appoint'])) {
	// echo "post request";
	if($_POST['confirmation'] == "" || $_POST['confirmation'] == null){
		echo $updateappoint = "Please enter a specific value for confirmation";
	}else{
		$TutorAppointmentContext = new TutorAppointmentContext();  //passing data using get set
		echo "value".$_POST['confirmation'];
		if($_POST['confirmation'] == "Confirmed"){
			$value = 1;
		}else{
			$value= 0;
		}
		$id = $_POST['id'];
		$TutorAppointmentContext->Update($value,$id);   
//Calling the update method where we pass 2 arguments
			// first is object where we can send all the variable details.
			//other is that specific id for updating
			// $learningRoomDb->Update($learningRoom,$_GET['id']);        //passing object and id
			
			//redirect to the listing page
			// header("Location:tutorAppointmentList.php");
		// }else{
			// echo $roomExists = "Room already exists";
		// }
	}
	
}

$room = new LearningRoomDb();
$TutorAppointmentContext = new TutorAppointmentContext();
$user_id = $_GET['id'];
$Appointments = $TutorAppointmentContext->GetEdit($user_id);
//  var_dump($Appointments);
$user_id = $Appointments->user_id;
$subject_id = $Appointments->subject_id;
$subject_data = $TutorAppointmentContext->getTutorSubject($subject_id);
$user_details = $TutorAppointmentContext->Get($user_id);

$updateappoint ="";


 ?>
    <main>
        <div class="container">
            <div class="section">
                <div class="row">
                    <div class="col s12 m12 l8  offset-l2">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Edit Appointment</span>
                                <div class="row">
                                    <form action="" method="post" class="col s12">
                                    <div class="input-field col s12 m12 16">
										Booked by : <strong><?=$user_details->first_name;?></strong>
									</div>
									                                     
										<div class="input-field col s12 m12 l12">
											Tutor : <strong><?=$subject_data['users_first_name']?></strong>
										</div>
										
										<div class="input-field col s12 m12 l12">
											Subject : <strong><?=$subject_data['subject_title']?></strong>
										</div>
                                        <div class="input-field col s12 m12 l12">
											Learning Room  : <strong><?php
											$room_id = $Appointments->learning_room_id;
												$room_no = $room->Getbyid($room_id);
                                            echo $room_no->room_number;?>
										
										</strong>
										</div>
										<div class="input-field col s12 m12 l12">
											Date Time : <strong><?=$Appointments->date_time;?></strong>
										</div>
										<div class="input-field col s12 m12 l12">
											Message : <strong><?=$Appointments->message;?></strong>
										</div>
										<div class="input-field col s12 m12 l12">
											Created on : <strong><?=$Appointments->created_datetime;?></strong>
										</div>
                                        <div class="input-field col s12 m12 16">
											Booking Confirmation(Booked/Waiting/Not Confirmed)  : <strong><?=($Appointments->is_confirmed == 0 ? "Not Confirmed" : "Confirmed") ?></strong>
										</div>
										<div class="input-field col s12 m12 16">
											<input type="text" name="confirmation" value="<?=($Appointments->is_confirmed == 0 ? "Not Confirmed" : "Confirmed") ?>"/>  
											<span class="red-text"><?=$updateappoint; ?></span>
											<input type="hidden" name="id" value="<?=$Appointments->id;?>"/>
										</div>
                                            <div class="input-field col s12">
                                                <button class="btn waves-effect waves-light" type="submit"
                                                        name="update_appoint">Update Appointment
                                                </button>
                                                <button class="btn waves-effect waves-light" type="submit"
                                                        name="action">Clear
                                                </button>
                                            </div>
                                    </form>
										
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
<?php require_once "../includes/adminFooter.php" ?>