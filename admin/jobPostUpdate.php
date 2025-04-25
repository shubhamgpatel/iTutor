<?php
/* Developer : Priyanka Khadilkar
  * This file contains form to update job post.
 * Only admin can access this  List
  */
require_once "../vendor/autoload.php";

//Declaring variables for validation message and form input
$TitleValidationMsg = "";
$DescriptionValidationMsg = "";
$id = "";
$jobTitle = "";
$jobDescription = "";

//Get the job detail on page load using the querystring value of job id
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    //Get the the job post detail from database using job post Id
    $jobPostDb = new JobPostContext();
    $jobPost = $jobPostDb->Get($id);

    //Assign the value to the input.
    $jobTitle = $jobPost->title;
    $jobDescription = $jobPost->description;
}

//function to validate form input.
function checkValidation($jobTitle, $jobDescription)
{
    global $TitleValidationMsg, $DescriptionValidationMsg;
    $isValid = false;
    if ($jobTitle == "") {
        $TitleValidationMsg = "Please enter title.";
    }
    if ($jobDescription == "") {
        $DescriptionValidationMsg = "Please enter job description";
    }
    if ($jobTitle != null && $jobDescription != null && $jobDescription != "" && $jobTitle != "") {
        $isValid = true;
    }
    return $isValid;
}

//check if the form is submitted
if (isset($_POST['btnJobPostUpdate'])) {
    //get the values from form and assign to local variable
    $jobTitle = $_POST['title'];
    $jobDescription = $_POST['description'];

    //check if user entered the data
    if (checkValidation($jobTitle, $jobDescription) == true) {
        //Add Job Post if Job title and job description is entered.
        $jobPost = new JobPost($jobTitle, $jobDescription);

        //update the data
        $jobPostDb = new jobPostContext();
        $numRowsAffected = $jobPostDb->Update($jobPost, $id);
        if ($numRowsAffected) {
            header('Location: JobPosts.php');
        } else {
            echo "problem updating data";
        }
    }

}
?>
<?php require_once "../includes/adminHeader.php" ?>
<main>
    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 m12 l8  offset-l2">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Update Job Post</span>
                            <div class="row">
                                <form method="post" class="col s12">
                                    <div class="row margin-bottom-none">
                                        <div class="input-field col s12">
                                            <input id="title" value="<?= $jobTitle ?>" name="title" type="text"
                                                   class="validate">
                                            <label class="active" for="title">Title</label>
                                            <span class="helper-text red-text"><?= $TitleValidationMsg ?></span>
                                        </div>
                                        <div class="col s12 paddingleft0">
                                            <label class="fontsizeinherit" for="description">Description</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <textarea id="description" name="description"
                                                      class="validate summernote"><?= $jobDescription ?></textarea>
                                        </div>
                                         <div class=" input-field col s12">
                                            <span class="helper-text red-text"><?= $DescriptionValidationMsg ?></span>
                                        </div>
                                        <div class=" input-field col s12">
                                            <button class="btn waves-effect waves-light" type="submit"
                                                    name="btnJobPostUpdate">Submit
                                            </button>
                                            <a class="btn waves-effect waves-light"
                                               href="jobPosts.php">Back to List
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
