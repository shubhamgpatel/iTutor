<?php
     require_once "../includes/adminHeader.php";
    include_once "../database/classes/TutorContext.php";
    include_once "../database/classes/SubjectContext.php";
    include_once "../database/classes/TutorAppointmentContext.php";
    include_once "../database/LearningRoomDb.php";      //CRUD operations file
    include_once "../database/classes/models/TutorAppointment.php";      //CRUD operations file
    
    require_once "../database/classes/models/LearningRoom.php";
    // var_dump($_SESSION);
    // $tutor_name ="";
    echo $sessionData->roleId;

    $tutor = new TutorContext();
    $tutors = $tutor->getAllTutors();
    
    $subject = new SubjectContext();
    $subjects = $subject->getAllSubjects();

    $room = new LearningRoomDb();
    $rooms = $room->ListAll();

    if(isset($_POST['appointAdd'])) {
            
            $TutorAppointmentContext = new TutorAppointmentContext();
            $result = $TutorAppointmentContext->getTutorSubject($_POST['subject_id']);

            $subject_id = $_POST['subject_id']; //subjectid
            $room_no = $_POST['room_no'];    // room id
            $dateTime = $_POST['dateTime'];   //datetime
            $message = $_POST['appointMsg']; //message
            // echo "Users user id : ". implode(', ', $result);
            $user_id = $result['users_id'];   //user id
            $user_id = $sessionData->userId;   //user id
            $tutor_id = $result['tutors_tutor_id'];   
            $learning_room_id = $_POST['room_no'];   
            $is_confirmed = 0;
            
           /*
            echo "<br>Room No ".$_POST['room_no'];
            echo "<br>Date Time ".$_POST['dateTime'];
            echo "<br>Message ".$_POST['appointMsg'];
            echo "<br>Users_user_id ".$result['users_id'];
            echo "<br>Tutors_tutor_id ".$result['tutors_tutor_id'];
            echo "<br>Learning_room_id ".$_POST['room_no'];
           */
            // echo "Tutor : ".implode(', ', $result);
           
           $TutorAppointment = new TutorAppointment($user_id, $tutor_id, $subject_id, $learning_room_id, $dateTime, $message, $is_confirmed);

           $TutorAppointmentContext = new TutorAppointmentContext();  

           $result = $TutorAppointmentContext->Add($TutorAppointment);
           if($result){
            //    echo "True";
           }else{
            //    echo "False";
           }

    }
require_once "../includes/adminHeader.php";
?>
    <main>
        <div class="container">
            <div class="section">
                <div class="row">
                    <div class="col s12 m12 l8  offset-l2">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Add Tutor Appointment</span>
                                <div class="row">
                                    <!--  a form that wwill redirect to same page -->
                                    <form class="col s12" action="" method="post">
                                        <div class="row margin-bottom-none">
                                          
                                        <div class="input-field col s12 m12 l6">
                                            <select name="subject_id" onchange="" id="subject" class="browser-default" required>
                                            <option value='' selected>---Select Subject---</option>
                                            <?php
                                            foreach ($subjects as $subject) { 
                                            ?>
                                            <option  value="<?= $subject['id'];?>"><?= $subject['title']; ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        <div class="input-field col s12 m12 32"> 
                                        <span id="show" name="tutor_name1"></span>

                                        
                                        </div>        
                                        <!-- <div class="input-field col s12 m12 l6"> -->
                                           <!-- <select class="browser-default">
                                            <option value='' selected>---Select Tutor---</option>
                                            <?php
                                                foreach ($tutors as $tutor) { 
                                            ?>
                                                <option value="<?= $tutor['id']; ?>"><?= $tutor['first_name'] . " " . $tutor['last_name']; ?></option>
                                            <?php } ?>
                                            </select>-->
                                            
                                        <!-- </div> -->

                                        <div class="input-field col s12 m12 l6">
                                            <select name="room_no" class="browser-default" required>
                                            <option value='' selected>---Select Room---</option>
                                            <?php
                                            foreach ($rooms as $room) { 
                                            ?>
                                            <option value="<?= $room->id; ?>"><?= $room->room_number; ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>

                                        <div class="input-field col s12">
                                                <i class="material-icons prefix">date_range</i>
                                                <input name="dateTime"  id="dateOfBirth" type="text" class="validate datepicker" required>
                                                <label for="dateTime">Date of Booking</label>
                                                <span class="helper-text red-text"></span>
                                        </div>
                                        
                                        <div class="input-field col s12">
                                            <textarea id="textarea2" class="materialize-textarea" name="appointMsg" data-length="120"></textarea>
                                            <label for="textarea2">Message</label>
                                        </div>
                                                                
                                        <div class="input-field col s12">
                                            <button class="btn waves-effect waves-light" name="appointAdd" type="submit"
                                                    name="action">Add Appointment
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
        </div>
        </div>
    </main>
<?php require_once "../includes/adminFooter.php" ?>