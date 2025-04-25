<?php
/* Developer : Priyanka Khadilkar
  * This file list all job post. we can search the job listing according to
  * Job title.
 * Only admin can access this  List
  */
require_once "../includes/adminHeader.php" ?>
<?php

require_once "../vendor/autoload.php";

//Fetch all Job posts
$jobPostDb = new JobPostContext();
$jobPosts = $jobPostDb->ListAll();

//when user click on the delete button to delete job post.
if (isset($_POST["deleteJobPost"])) {
    $jobPostId = $_POST["jobPostId"];

    $jobPostDb = new JobPostContext();
    $numRowsAffected = $jobPostDb->Delete($jobPostId);
    if ($numRowsAffected) {
        $jobPostDb = new JobPostContext();
        $jobPosts = $jobPostDb->ListAll();
    } else {
        echo "problem Listing Data";
    }
}

//When user search for the Job Post into the list and click on search button
if (isset($_POST["searchJobPost"])) {

    $searchKey = $_POST["searchKey"];
    $jobPostDb = new JobPostContext();
    $jobPosts = $jobPostDb->Search($searchKey);
}
?>
    <main class="adminmain admin-mock-tests">
        <div class="section no-pad-bot" id="index-banner">
            <div class="row">
                <div class="col s10 m6 l12">
                    <h5 class="breadcrumbs-title">Job Openings</h5>
                </div>
                <div class="row">
                    <form method="post">
                        <div class="input-field col s12 m12 l4">
                            <input id="searchKey" name="searchKey" type="text" class="validate search-box">
                            <label for="searchKey" class="serach-label">Search Job Posts..</label>
                        </div>
                        <div class="input-field col s12 m12 l2">
                            <button class="btn waves-effect waves-light" type="submit" name="searchJobPost">Search
                                <i class="material-icons right">search</i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <div class="direction-top">
                                    <a title="Add Job Opening" href="jobPostAdd.php"
                                       class="btn-floating btn-large green floatright">
                                        <i class="large material-icons">add</i>
                                    </a>
                                </div>
                                <div class="row sub-list">
                                    <?php foreach ($jobPosts as $jobPost) { ?>
                                        <div class="col s12 m6 l4">
                                            <div class="card">
                                                <div class="card-content fixed-card-height">
                                                    <span class="card-title"><?= $jobPost->title; ?></span>
                                                    <p class="small-text"><?= $jobPost->description ?> </p>
                                                </div>
                                                <div class="card-action add-contact-flex">
                                                    <!-- link for view job description to the job post -->
                                                    <a href="jobPostView.php?id=<?= $jobPost->id ?>"  title="View full job description" class="small-text"><i
                                                                class="material-icons green-text sub-del-icon">remove_red_eye</i></a>
                                                    <!-- link for update job description to the job post -->
                                                    <a href="jobPostUpdate.php?id=<?= $jobPost->id ?>"
                                                       class="small-text"><i
                                                                class="material-icons blue-text sub-del-icon">create</i></a>
                                                    <?PHP
                                                    $modalId = "modal" . $jobPost->id;
                                                    ?>
                                                    <!-- link for delete job description to the job post -->
                                                    <a class="modal-trigger" href="#<?= $modalId ?>"><i
                                                                class="material-icons red-text sub-del-icon">delete</i></a>
                                                    <!-- Modal Structure  for delete confirmation popup for the job post-->
                                                    <div id="<?= $modalId ?>" class="modal">
                                                        <div class="modal-content">
                                                            <h4><?= $jobPost->title; ?></h4>
                                                            <p>Are you sure you want to delete this job post?</p>
                                                        </div>
                                                        <form method="post">
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="jobPostId"
                                                                       value="<?= $jobPost->id ?>">
                                                                <a class="modal-close waves-effect waves-red btn-flat">No</a>
                                                                <button class="btn waves-effect waves-light"
                                                                        type="submit"
                                                                        name="deleteJobPost">Yes
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php require_once "../includes/adminFooter.php" ?>