<?php 
// if the user directly tries to access this webpage, he/she cannot and it will redirect to the list page of Learning Room
    if(!$_GET['id']) {
        header("Location:learningRoomList.php");
    }
   
require_once "../database/LearningRoomDb.php";
require_once "../database/classes/models/LearningRoom.php";
//clearing the variable data
$roomExists="";

    $learningRoomDb = new LearningRoomDb();
    //for  each loop used too get the data value related to that specific room id
    foreach($learningRoomDb->ListAll() as $value){  //for getting room number from id
        if($value->id == $_GET['id']){
            $room_number = $value->room_number; //grabbing the value and storing in a variable
        }
    }
        //thiis if statement will execute when a user has submitted the formz
    if(isset($_POST['update_room'])) {
        if($_POST['updateRoomNo'] == "" || $_POST['updateRoomNo'] == null){
            echo $roomExists = "Please enter a specific Room No";
        }else{
            $learningRoom = new LearningRoom($_POST['updateRoomNo']);  //passing data using get set
            $learningRoomDb = new LearningRoomDb();     //initializing CRUD operation
            $getroom = $learningRoomDb->Get($_POST['updateRoomNo']);       

            // if(is_bool($getroom)){   // this functionality is commented because it depends on the client if he/she wants to check for same room
                //setting the updated value of the room
                $learningRoom->setRoomNumber($_POST['updateRoomNo']);
                echo $roomExists = "Room Updated";
                //Calling the update method where we pass 2 arguments
                // first is object where we can send all the variable details.
                //other is that specific id for updating
                $learningRoomDb->Update($learningRoom,$_GET['id']);        //passing object and id
                $addUpdateMsg = "Room updated";
                //redirect to the listing page
                header("Location:LearningRoomList.php");
            // }else{
                // echo $roomExists = "Room already exists";
            // }
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
                                <span class="card-title">Edit Learning Room</span>
                                <div class="row">
                                    <!-- form that wil redirect to same page as method is post -->
                                    <form class="col s12" action="" method="post">
                                        <div class="row margin-bottom-none">
                                          
                                            <div class="input-field col s12">
                                                <input id="roomNo" name="updateRoomNo" type="text" value="<?= (isset($_GET['id']) ? $room_number : $_POST['updateRoomNo']);?>" class="validate">
                                                <label for="roomNo">Room No</label>
                                                <span class="red-text"><?=$roomExists; ?></span>
                                            </div>  
											
                                            <div class="input-field col s12">
                                                <button type="submit" class="btn waves-effect waves-light" type="submit"
                                                        name="update_room">Update Room
                                                </button>
                                                <a class="btn waves-effect waves-light"
                                                    href="LearningRoomList.php">Back to Rooms
                                                    </a>
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