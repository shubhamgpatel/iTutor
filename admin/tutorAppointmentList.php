<?php require_once "../includes/adminHeader.php";

require_once "../database/classes/TutorAppointmentContext.php"; //crud functions
require_once "../database/classes/models/TutorAppointment.php";
include_once "../database/LearningRoomDb.php";

// initialise the CRUD class
$room = new LearningRoomDb();
// $rooms = $room->Getbyid();
$TutorAppointmentContext = new TutorAppointmentContext();
if($sessionData->roleId == 1){
    $Appointments = $TutorAppointmentContext->ListAlll();
}else if($sessionData->roleId == 2){
    //echo "----------------------------------------------------user id ----".$sessionData->userId;
    $gettutorid = $TutorAppointmentContext->Gettutor($sessionData->userId);
    //$userid_tutor = $gettutorid->id;
    $tutor_id = $gettutorid->ttutor_id; //2
    //  echo "----------------------------------------------------Tutor id ----".$tutor_id;
     //var_dump($gettutorid);
    $Appointments = $TutorAppointmentContext->ListAllTutor($tutor_id);
    //var_dump($Appointments);
}else{
    // echo "--------------------------------------".$sessionData->userId;
    $Appointments = $TutorAppointmentContext->ListAll($sessionData->userId);
    // var_dump($Appointments);
}


if (isset($_POST["deleteAppointBtn"])) {
    $appointmentid = $_POST["appointmentid"];  
    $TutorAppointmentContext = new TutorAppointmentContext();
    $numRowsAffected = $TutorAppointmentContext->Delete($appointmentid);
    if ($numRowsAffected) { 
            //if a appointment is deleted it will list method
        $TutorAppointmentContext = new TutorAppointmentContext();
        
        $Appointments = $TutorAppointmentContext->ListAll($sessionData->userId); //calling the list method
    } else {
        echo "Problem in Deleting!!";
    }
}
// $Appointments
?>
    <main class="adminmain admin-mock-tests">
    
        <div class="section no-pad-bot" id="index-banner">
            <div class="row">
                <div class="col s10 m6 l12">
                    <h5 class="breadcrumbs-title">Tutor Appointments</h5>
                    <!-- <?=var_dump($sessionData->roleId);?> -->
                    <?php
                    if($sessionData->roleId === "1"){
                        echo "Welcome admin";
                    }else if($sessionData->roleId === "2"){
                        echo "Welcome tutor";
                    }else if($sessionData->roleId === "3"){
                        echo "Welcome Student";
                    }
                    ?>
                </div>
                <div class="row">
                    <form>
                        <div class="input-field col s12 m12 l4">
                            <input id="first_name" type="text" class="validate search-box">
                            <label for="first_name" class="search-label">Search any appointment...</label>
                        </div>
                        <div class="input-field col s12 m12 l4">
                           <select class="browser-default">
								<option value="" disabled selected>Select Tutor</option>
								<option value="1">Chirstine</option>
								<option value="2">Priyanka</option>
								<option value="3">Bernie</option>
							</select>
                        </div>
                        <div class="input-field col s12 m12 l2">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Search
                                <i class="material-icons right">search</i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                            <?php if($sessionData->roleId == 3){                            ?>
                                <div class="direction-top">
                                    <a title="Add Appointment" href="tutorAppointmentAdd.php" class="btn-floating btn-large green floatright">
                                        <i class="large material-icons">add</i>
                                    </a>
                                </div>
                            <?php } ?>
                                <table class="responsive-table">
                                    <thead>
                                    <tr>
                                        <?php if($sessionData->roleId == 1){ ?>
                                        <th>Booked by</th>
                                        <?php }else if($sessionData->roleId == 2){ ?>
                                        <th>Booked by</th>
                                        <?php }
                                            if($sessionData->roleId != 2){?>
                                                <th>Tutor</th>
                                        <?php    }                                      
                                        ?>

                                        <th>Subject</th>
                                        <th>Room No</th>
                                        <th>Appointment Date</th>
                                        <th>Confirmed</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    foreach($Appointments as $value){?> 
                                    <tr>
                                        <?php
                                            $subject_data = $TutorAppointmentContext->getTutorSubject($value->subject_id);
                                              //var_dump($subject_data);
                                            if($sessionData->roleId == 1){
                                                // echo $value->user_id;
                                                $admin = $TutorAppointmentContext->Get($value->user_id);
                                                // var_dump($admin);
                                                ?>
                                            <td><?=$admin->first_name; ?></td>        
                                            <?php }
                                            if($sessionData->roleId == 2){
                                                 
                                                 $tutor = $TutorAppointmentContext->Get($value->user_id);
                                                 //var_dump($value);
                                             echo "<td>".$value->first_name."</td>";    
                                                  
                                            }else{
                                                //echo "<td>".$value->first_name."</td>";
                                                echo  "<td>".$subject_data['users_first_name']."</td>";
                                            }
                                            
                                            ?>
                                      
                                        <td><?=$subject_data['subject_title']?></td>
                                        <td><?php $rooms = $room->Getbyid($value->learning_room_id);
                                        // var_dump($rooms);
                                            echo $rooms->room_number;
                                        ?></td>
                                        <td><?=$value->date_time?></td>
                                        <?php if($sessionData->roleId == 1){ ?>
                                            <td><?=($value->is_confirmed == 0 ? "Not Confirmed" : "Confirmed") ?>
                                                <a href='tutorAppointmentEdit.php?id=<?=$value->id?>' name='appointEdit'><i class='material-icons blue-text'>create</i></a>
                                        </td>
                                        <?php }else{ ?>

                                        <td><?=($value->is_confirmed == 0 ? "Not Confirmed" : "Confirmed") ?></td>
                                        <?php } ?>

                                        <td>

                                            <?php $appid = "id".$value->id; ?> 
                                            <a class='modal-trigger cursor-pointer' href='#<?=$appid?>'>
                                                <i class='material-icons red-text'>delete</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <div id='id<?=$value->id?>' class='modal modal-learning-popup'>
                                        <div class='modal-content'>
                                        <h4>Are you sure?</h4>
                                        <p>Do you really want to delete this Appointment?</p>
                                        </div>
                                        <div class='modal-footer-LearningRoom'>
                                            <!-- a form that will redirect to the same page -->
                                            <form method="post">
                                                <div class="modal-footer">
                                                    <input type="hidden" name="appointmentid" value="<?=$value->id;?>">
                                                    <a href="#!" class="modal-action modal-close waves-effect waves-white btn-flat">Close</a>
                                                    <button class="btn waves-effect waves-light delete-btn-learningRoom"
                                                            type="submit" name="deleteAppointBtn">Delete
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <?php }  ?>
									</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
    function sendIt(e) {
       if(e == 0){
           alert("Not confirmed");
       }else{
           alert("Confirmed");
       }
    }
    </script>
<?php require_once "../includes/adminFooter.php" ?>