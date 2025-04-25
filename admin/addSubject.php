 <?php
 /* Developer : Maitri Modi
  * This file is for adding subject details,
  * Only Admin can add the subjects
 */ 
   
//  require_once '../database/classes/connect.php';
//  require_once '../database/classes/SubjectContext.php';
require_once '../vendor/autoload.php';

 $title = $subjectField  = $description = "";
 $titleErr = $subjectFieldErr  = $descriptionErr = "";

 $errFound = false;
 if(isset($_POST["addSubject"])){
     if(empty($_POST["title"])){
         $titleErr = "Subject title is required";
         $errFound = true;
     } else {
         $title = check_input($_POST["title"]);
     }

     if(empty($_POST["subjectField"])){
         $subjectFieldErr = "Please select the field of the subject";
         $errFound = true;
     } else {
         $subjectField = check_input($_POST["subjectField"]);
     }

     
     if(empty($_POST["description"])){
         $description = "Description of the subject is required";
         $errFound = true;
     } else {
         $description = check_input($_POST["description"]);
     }

     if(!$errFound){
         $db = Database::getDb();
         $s = new SubjectContext();
         $sub = $s->addSubject($title,$subjectField,$description,$db);

         if($sub){
             header('Location: listSubjects.php');
         } else {
             echo "problem adding the subject";
         }
     }
 }

 function check_input($input){
     $input = trim($input);
     $input = stripslashes($input);
     $input = htmlspecialchars($input);
     return $input;
 }

 
 ?>
 <?php
 require_once "../includes/adminHeader.php";
 
 
 ?>
    <main>
        <div class="container">
            <div class="section">
                <div class="row">
                    <div class="col s12 m12 l8  offset-l2">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Add Subject</span>
                                <div class="row">
                                    <form class="col s12" action="" method="post" enctype="multipart/form-data">
                                        <div class="row margin-bottom-none">
                                            <div>
                                                <p for="sub-update-title">Subject:</p>
                                                <input id="sub-update-title" name="title" type="text" class="add-contact-form" placeholder="Subject Name">
                                            </div>
                                            <div class="add-contact-form">
                                                <label for="subjectField">Choose a Field:</label>
                                                <select id="subjectField" name="subjectField">
                                                <option value="">----Select----</option>
                                                <option value="webDevelopment">Web Development</option>
                                                <option value="webDesignAndDevelopment">Web Design and Development</option>
                                                <option value="itSolution">IT Solution</option>
                                                <option value="gameProgramming">Game Programming</option>
                                                <option value="projectManagement">Project Management</option>
                                                </select>
                                            </div>
                                            <div>
                                                <p for="sub-update-title">Description:</p>
                                                <input id="sub-update-title" name="description" type="text" class="add-contact-form" placeholder="Description">
                                            </div>
                                            
                                            <div class="add-contact-flex">
                                                <div>
                                                    <button class="btn-small waves-effect waves-light contact-submit" type="submit" name="addSubject">Add
                                                    </button>
                                                </div>
                                                <div>
                                                    <a class="waves-effect waves-light btn add-contact-btn " href="listSubjects.php">Cancel</a>
                                                </div>
                                            </div>
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