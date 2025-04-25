<?php
/* Developer : Maitri Modi
  * This file is for showing the static view of contact us page,
  * Only Admin can view this static view subjects
 */ 
require_once "../includes/adminHeader.php";
require_once "../vendor/autoload.php";
// require_once '../database/classes/connect.php';
// require_once '../database/classes/UserContactContext.php';

    if(isset($_GET['action'])){
		if($_GET['action']=="delete" && isset($_GET['id'])){
            $id = $_GET['id'];
		} 
    }
    $db = Database::getDb();
    $noContact ="";
    $addUpdateMsg ="";
    $uc = new UserContact();     //
    $contacts = $uc->getAllUserContacts($db);

    
    if (isset($_POST["deleteUserContact"])) {
        $id = $_POST["id"];

        $uc = new UserContact();
        $numRowsAffected = $uc->deleteUserContact($id,$db);
        
        if ($numRowsAffected) {
            $uc = new UserContact();
            $contacts = $uc->getAllUserContacts($db);
        } else {
            echo "Problem in Deleting!!";
        }
    }
       
    if (isset($_POST["searchContactBtn"])) {
        $searchKey = $_POST["namesearch"];
        $uc = new UserContact();
        $contacts = $uc->Search($searchKey,$db);
        if(!$contacts){
            $noContact = "<tr><td colspan=2>Sorry!! No name found!!</td></tr>";
        }
    }
           
?>
    <main class="adminmain admin-mock-tests">
        <div class="section no-pad-bot" id="index-banner">
            <div class="row">
                <div class="col s10 m6 l12">
                    <h5 class="breadcrumbs-title">User Contacts</h5>
                    
                </div>
                <div class="row">
                    <form method="post">
                        <div class="input-field col s12 m12 l4">
                            <input id="namesearch" type="text" name="namesearch" class="validate search-box">
                            <label for="namesearch" class="serach-label">Search Users...</label>
                        </div>
                        <div class="input-field col s12 m12 l2">
                            <button class="btn waves-effect waves-light" type="submit" name="searchContactBtn">Search
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
                                <table class="responsive-table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    echo $noContact;
                                    foreach($contacts as $contact){?>
                                        <!-- echo " -->
                                    <tr>
                                        <td><?=$contact->name?></td>
                                        <td><?=$contact->phone?></td>
                                        <td><?=$contact->email?></td>
                                        <td><?=$contact->subject?></td>
                                        <td><?=$contact->message?></td>
                                        <td>
                                            

                                            <?php $id = "id".$contact->id; ?>

                                            <a class='modal-trigger cursor-pointer' href='#<?=$id?>'>
                                                <i class='material-icons red-text'>delete</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!--  -->
                                    <!--- modal pop up for delete --->
                                    <div id='id<?=$contact->id?>' class='modal modal-learning-popup'>
                                        <div class='modal-content'>
                                        <h4>Are you sure?</h4>
                                        <p>Do you really want to delete this contact?</p>
                                        </div>
                                        <div class='modal-footer-LearningRoom'>
                                            <form method="post">
                                                <div class="modal-footer">
                                                    <input type="hidden" name="id" value="<?=$contact->id;?>">
                                                    <a href="#!" class="modal-action modal-close waves-effect waves-white btn-flat">Close</a>
                                                    <button class="btn waves-effect waves-light delete-btn-learningRoom"
                                                            type="submit" name="deleteUserContact">Delete
                                                    </button>
                                                </div>
                                            </form>
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