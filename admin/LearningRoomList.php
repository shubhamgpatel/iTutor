<?php
require_once "../includes/adminHeader.php";

    require_once "../database/LearningRoomDb.php";
    require_once "../database/classes/models/LearningRoom.php";
    // if a user get an action from post request
    if(isset($_GET['action'])){
        //if u get an action where it is delete  and also id is set for deleting specific id
		if($_GET['action']=="delete" && isset($_GET['id'])){
            $id = $_GET['id'];
		}
    }
    //empty the string value
    $noRooms ="";
    $addUpdateMsg = "";
    // initialise the CRUD class
    $learningRoomDb = new LearningRoomDb();
    //calling the list method from Learning Room Db class
    $Room = $learningRoomDb->ListAll();

    // if a request is received from deleteRoom button
    if (isset($_POST["deleteRoom"])) {
        $roomid = $_POST["learningRoomId"];

        //calling learningRoomdb class for fetching and deleteing particular room id
        $learningRoomDb = new LearningRoomDb();
        //passing room id and calling learningRoom Db class
        $numRowsAffected = $learningRoomDb->Delete($roomid);
        
        if ($numRowsAffected) { 
                //if a room is deleted it will list method
            $learningRoomDb = new LearningRoomDb();
            $Room = $learningRoomDb->ListAll(); //calling the list method
        } else {
            echo "Problem in Deleting!!";
        }
    }
       //if a request received from searchroom button if go in this "if statement"
    if (isset($_POST["searchRoomBtn"])) {
        $searchKey = $_POST["roomsearch"];  //getting the search value and storing in $searchkey variable
        $learningRoomDb = new LearningRoomDb();
        $Room = $learningRoomDb->Search($searchKey);    //calling search method and passing the variable
        if(!$Room){
            $noRooms = "<tr><td colspan=2>Sorry!! No rooms found!!</td></tr>";
        }
    }
           
?>
    <main class="adminmain admin-mock-tests">
        <div class="section no-pad-bot" id="index-banner">
            <div class="row">
                <div class="col s10 m6 l12">
                    <h5 class="breadcrumbs-title">Learning Rooms</h5>
                    
                </div>
                <div class="row">
                    <form method="post">
                        <div class="input-field col s12 m12 l4">
                            <input id="roomsearch" type="text" name="roomsearch" class="validate search-box">
                            <label for="roomsearch" class="serach-label">Search learning Rooms...</label>
                        </div>
                        <div class="input-field col s12 m12 l2">
                            <button class="btn waves-effect waves-light" type="submit" name="searchRoomBtn">Search
                                <i class="material-icons right">search</i>
                            </button>
                        </div>
                    </form>
                <span><?=$addUpdateMsg;?></span>    
                </div>
                
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <div class="direction-top">
                                    <a title="Add Learning Material" href="learningRoomAdd.php" class="btn-floating btn-large green floatright">
                                        <i class="large material-icons">add</i>
                                    </a>
                                </div>
                                <table class="responsive-table">
                                    <thead>
                                    <tr>
                                        <th>Room No</th>
                                        <th>Created On</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    echo $noRooms;  // this will display if there are no rooms if a user is searching which is not in the list
                                    foreach($Room as $value){?>     <!--a loop to display the list of all rooms-->
                                        <!-- echo " -->
                                    <tr>
                                        <!-- calling data[specific row data] using $value-->
                                        <td><?=$value->room_number?></td>   
                                        <td><?=$value->created_datetime?></td>
                                        <td>
                                            <!-- a button which is a hyperlink to edit specific room, also passing that particular room id -->
                                            <a href='LearningRoomEdit.php?id=<?=$value->id?>' name='edit_room'><i class='material-icons blue-text'>create</i></a>
                                            <!-- for storing specific room id in variable which can be passed to the modal popup -->
                                            <?php $roomid = "roomid".$value->id; ?> <!-- for storing rooom id for transfer to modal pop up-->
                                            <!-- passing the room id with # to a pop up -->
                                            <a class='modal-trigger cursor-pointer' href='#<?=$roomid?>'>
                                                <i class='material-icons red-text'>delete</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!--  -->
                                    <!--- modal pop up for delete that particular room--->
                                    <div id='roomid<?=$value->id?>' class='modal modal-learning-popup'>
                                        <div class='modal-content'>
                                        <h4>Are you sure?</h4>
                                        <p>Do you really want to delete this room?</p>
                                        </div>
                                        <div class='modal-footer-LearningRoom'>
                                            <!-- a form that will redirect to the same page -->
                                            <form method="post">
                                                <div class="modal-footer">
                                                    <!-- a field which is hidden as we will be passing that learning room id in the form for deleting that room -->
                                                    <input type="hidden" name="learningRoomId" value="<?=$value->id;?>">
                                                    <a href="#!" class="modal-action modal-close waves-effect waves-white btn-flat">Close</a>
                                                    <button class="btn waves-effect waves-light delete-btn-learningRoom"
                                                            type="submit" name="deleteRoom">Delete
                                                    </button>
                                                </div>
                                            </form>
                                            <!-- <a href='LearningRoomList?action=delete&id=<?=$value->id?>' name="nom" class=" ">Delete</a> -->
                                            <!-- <span class="delete-btn-learningRoom waves-effect waves-light btn-small"></span> -->
                                            <!-- <a href="#!" class="modal-action modal-close waves-effect waves-white btn-flat">Close</a> -->
                                        </div>
                                    </div>
                                <?php }  ?>
                                     
                                    </tbody>
                                </table>
                                <ul class="pagination">
                                    <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a>
                                    </li>
                                    <li class="red"><a href="#!">1</a></li>
                                    <li class="waves-effect"><a href="#!">2</a></li>
                                    <li class="waves-effect"><a href="#!">3</a></li>
                                    <li class="waves-effect"><a href="#!">4</a></li>
                                    <li class="waves-effect"><a href="#!">5</a></li>
                                    <li class="waves-effect"><a href="#!"><i
                                                    class="material-icons">chevron_right</i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
 require_once "../includes/adminFooter.php" ?>