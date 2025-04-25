<?php
    require_once "../database/LearningRoomDB.php";
    require_once "../database/classes/models/LearningRoom.php";

    //clearing the variable if there is some data in it.
$errorRoom = "";
// this will check if the request came is from roomadd button only
//this if statement will only execute if a user has filled the form successfully.
if(isset($_POST['roomAdd'])) {
    // this will grab the value of text field whose name is roomNo
    $roomNo = $_POST['roomNo'];

    //check if it is null or empty whiile submitting
    if($roomNo === "" || $roomNo === null){
        $errorRoom = "Please enter a Room no";  //this will throw a popup to the user that enter a room no
    }else{
        // if a user has submitted form properly with proper input fields
        //initialize Learning room class and passing that particular room value     e.g new LearningRoom(H101);
        //basically this will call the getter and setter methods.
        $learningRoom = new LearningRoom($roomNo);  //passing data using get set
        
        //this will initialize the CRUD operation
        $learningRoomDB = new LearningRoomDB();     //initializing CRUD operation
        // var_dump($learningRoomDB->Get($roomNo));        //passing Create->AddFunctn (getSetclass)
        //since the room number will be unique, we have to check that it is not repeated
        //calling a get method and passing the given roomNo value
        $getroom = $learningRoomDB->Get($roomNo);        //passing Create->AddFunctn (getSetclass)
        if(is_bool($getroom)){  //if the room does not exist from the table, this if statement will get executed
            ///passing Create->AddFunctn (getSetclass)   
            // passing the data and calling add function
            if($learningRoomDB->Add($learningRoom)){
                // after adding successfully, redirect to the list of learningRoom
                header("Location:LearningRoomList.php");
            }
        }else{
            $errorRoom = "Room already exists";
        }
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
                                <span class="card-title">Add Learning Room</span>
                                <div class="row">
                                    <!--  a form that wwill redirect to same page -->
                                    <form class="col s12" action="" method="post">
                                        <div class="row margin-bottom-none">
                                          
                                            <div class="input-field col s12">
                                                <input id="roomNo" name="roomNo" type="text" class="validate">
                                                <label for="roomNo">Room No</label>
                                                <span id="roomError" class="red-text"><?= $errorRoom; ?></span>
                                            </div>
                                                                                       
                                            <div class="input-field col s12">
                                                <button class="btn waves-effect waves-light" name="roomAdd" type="submit"
                                                        name="action">Add Room
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