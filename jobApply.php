<?php
/* Developer : Priyanka Khadilkar
  * User can apply for the job and upload
  * the resume
  */
require_once "includes/header.php" ?>
<?php

require_once "vendor/autoload.php";

//Variable to set the data
$id = "";
$jobTitle = "";
$jobDescription = "";
$fNameErr = "";
$lNameErr = "";
$emailErr = "";
$phoneNumberErr = "";
$firstname = "";
$lastname = "";
$email = "";
$phoneNumber = "";
$resumeErr = "";
$jobId = "";
$msg = "";

//Get details of job posting
if (isset($_GET['id'])) {
    $jobId = $_GET['id'];

    //Get the job post detail according to id from the database
    $jobPostDb = new JobPostContext();
    $jobPost = $jobPostDb->Get($jobId);
    $jobTitle = $jobPost->title;
    $jobDescription = $jobPost->description;
}

//Get file extension
function get_file_extension($file_name)
{
    return substr(strrchr($file_name, '.'), 1);
}

//Function to validate all inputs
function validateInputs($firstname, $lastname, $email, $phoneNumber)
{
    Global $fNameErr, $lNameErr, $emailErr, $phoneNumberErr, $resumeErr;
    $isFirstNameValid = false;
    $isLastNameValid = false;
    $isEmailValid = false;
    $isPhoneNumberValid = false;
    $isResumeValid = false;
    $phoneNumberPattern = "/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/";

    if ($firstname == "") {
        $fNameErr = "Please enter first name.";
    } else {
        $fNameErr = "";
        $isFirstNameValid = true;
    }

    if ($lastname == "") {
        $lNameErr = "Please enter last name.";
    } else {
        $lNameErr = "";
        $isLastNameValid = true;
    }

    if ($email == "") {
        $emailErr = "Please enter email.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Please enter valid email.";
    } else {
        $emailErr = "";
        $isEmailValid = true;
    }


    if ($phoneNumber == "") {
        $phoneNumberErr = "Please enter your contact number.";
    } else if (!preg_match($phoneNumberPattern, $phoneNumber)) {
        $phoneNumberErr = "Please enter valid contact number.";
    } else {
        $phoneNumberErr = "";
        $isPhoneNumberValid = true;
    }

    if (isset($_FILES['resume']) && (is_uploaded_file($_FILES['resume']['tmp_name']))) {
        $maxsize = 2097152;
        $acceptable = array(
            'application/pdf',
        );

        if (($_FILES['resume']['size'] >= $maxsize) || ($_FILES["resume"]["size"] == 0)) {
            $resumeErr = 'File too large. File must be less than 2 megabytes.';
        } else if (!in_array($_FILES['resume']['type'], $acceptable) && (!empty($_FILES["resume"]["type"]))) {
            $resumeErr = 'Invalid file type. Only PDF are accepted.';
        } else {
            $isResumeValid = true;
        }
    } else {
        $resumeErr = "Please select your resume.";
    }


    if ($isFirstNameValid == true && $isLastNameValid == true && $isEmailValid == true
        && $isPhoneNumberValid == true && $isResumeValid == true) {
        return true;
    } else {
        return false;
    }


}

//When User click on the Apply button
if (isset($_POST["btnApply"])) {
    $firstname = $_POST["firstName"];
    $lastname = $_POST["lastName"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $isFormValid = validateInputs($firstname, $lastname, $email, $phoneNumber);

    //If form is valid then allow user to register
    if ($isFormValid == true) {
        //Folder to upload resume
        $uploads_dir = 'Resume';
        //Get the file name
        $fileName = $_FILES['resume']['name'];

        //Move file from the temp location to physical path
        move_uploaded_file($_FILES['resume']['tmp_name'], "$uploads_dir/$fileName");

        $jobApplication = new JobApplication($firstname, $lastname, $email, $phoneNumber, $fileName, $jobId);
        $jobApplicationContext = new JobApplicationContext();

        //Application will be added into database
        $isApplied = $jobApplicationContext->Add($jobApplication);
        if ($isApplied) {
            $msg = "<span class='green-text'>Thank you. You have successfully applied for job. We will contact you soon. </span>";
        }
    }
}

?>
    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 m12 l8  offset-l2">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title"><?= $jobTitle ?></span>
                            <div class="row">
                                <div class="row margin-bottom-none">
                                    <div class="input-field col s12">
                                        <?= $jobDescription ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <?= $msg ?>
                            </div>
                            <div class="row">
                                <form method="post" enctype="multipart/form-data" class="col s12">
                                    <div class="row margin-bottom-none">
                                        <div class="input-field col s12 m12 l6">
                                            <i class="material-icons prefix">account_circle</i>
                                            <input name="firstName" value="<?= $firstname ?>" id="firstname"
                                                   type="text" class="validate">
                                            <label for="firstname">Firstname</label>
                                            <span class="helper-text red-text"><?= $fNameErr ?></span>
                                        </div>
                                        <div class="input-field col s12 m12 l6">
                                            <i class="material-icons prefix">account_circle</i>
                                            <input name="lastName" value="<?= $lastname ?>" id="lastname"
                                                   type="text" class="validate">
                                            <label for="lastname">Lastname</label>
                                            <span class="helper-text red-text"><?= $lNameErr ?></span>
                                        </div>
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">mail</i>
                                            <input name="email" value="<?= $email ?>" id="email" type="email"
                                                   class="validate">
                                            <label for="email">Email</label>
                                            <span class="helper-text red-text"><?= $emailErr ?></span>
                                        </div>
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">phone</i>
                                            <input name="phoneNumber" value="<?= $phoneNumber ?>" id="contact"
                                                   type="text" class="validate">
                                            <label for="contact">Contact</label>
                                            <span class="helper-text red-text"><?= $phoneNumberErr ?></span>
                                        </div>
                                        <div class="file-field input-field col s12">
                                            <div class="btn">
                                                <span>Upload Resume</span>
                                                <input name="resume" type="file">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                            <span class="helper-text red-text"><?= $resumeErr ?></span>
                                        </div>
                                        <div class="input-field col s12">
                                            <button class="btn waves-effect waves-light" type="submit"
                                                    name="btnApply">Apply
                                            </button>
                                            <a class="btn waves-effect waves-light"
                                               href="jobListing.php">Back to List
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
<?php require_once "includes/footer.php" ?>