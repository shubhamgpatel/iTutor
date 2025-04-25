<?php
/* Developer : Priyanka Khadilkar
* This file contains form for adding job post.
* Only admin can access this form
*/
require_once "../vendor/autoload.php";

//Variable to hold the validation Message.
$TitleValidationMsg = "";
$DescriptionValidationMsg = "";

//function to Check validation of form input
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
if (isset($_POST['addJobPost'])) {
    //get the values from form and assign to local variable
    $jobTitle = $_POST['title'];
    $jobDescription = $_POST['description'];

    //check if user entered the data

    if (checkValidation($jobTitle, $jobDescription) == true) {
        //Add Job Post if Job title and job description is entered.
        $jobPost = new JobPost($jobTitle, $jobDescription);

        //insert the data
        $jobPostDb = new JobPostContext();
        $numRowsAffected = $jobPostDb->Add($jobPost);
        if ($numRowsAffected) {
            header('Location: jobPosts.php');
        } else {
            echo "problem inserting data";
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
                                <span class="card-title">Add Job Post</span>
                                <div class="row">
                                    <form method="post" class="col s12">
                                        <div class="row margin-bottom-none">
                                            <div class="input-field col s12">
                                                <input id="title" name="title" type="text" class="validate">
                                                <label for="title">Title</label>
                                                <span class="helper-text red-text"><?= $TitleValidationMsg ?></span>
                                                <div class="col s12 paddingleft0">
                                                    <label class="fontsizeinherit" for="description">Description</label>
                                                </div>
                                                <div class="input-field col s12">
                                                <textarea id="description" name="description"
                                                          class="summernote validate"
                                                ></textarea>
                                                </div>
                                                <div class="input-field col s12">
                                                    <span class="helper-text red-text"><?= $DescriptionValidationMsg ?></span>
                                                </div>
                                                <div class="input-field col s12">
                                                    <button class="btn waves-effect waves-light" type="submit"
                                                            name="addJobPost">Submit
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