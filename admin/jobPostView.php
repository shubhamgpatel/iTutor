<?php
/*
 * Developer : Priyanka Khadilkar
This page will display the details of job posting.
so when user click on view icon on the job listing page it will redirect to here.
*/
require_once "../vendor/autoload.php";

//Variable to set the data to input
$id = "";
$jobTitle = "";
$jobDescription = "";

//Get details of job posting
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    //Get the job post detail according to id from the database
    $jobPostDb = new JobPostContext();
    $jobPost = $jobPostDb->Get($id);
    $jobTitle = $jobPost->title;
    $jobDescription = $jobPost->description;
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
                            <span class="card-title"><?= $jobTitle ?></span>
                            <div class="row">
                                <div class="col s12">
                                    <div class="row margin-bottom-none">
                                        <div class="input-field col s12">
                                            <?= $jobDescription ?>

                                        </div>
                                        <div class="input-field col s12">
                                            <a class="btn waves-effect waves-light"
                                               href="jobPostUpdate.php?id=<?= $id ?>">Edit
                                            </a>
                                            <a class="btn waves-effect waves-light"
                                               href="jobPosts.php">Back to List
                                            </a>
                                        </div>
                                </div>
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
