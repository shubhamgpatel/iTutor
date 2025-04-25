<?php
/* Developer : Priyanka Khadilkar
  * This file list all job post. we can search the job listing according to
  * Job title.User can click on View description and apply
  */
require_once "includes/header.php" ?>
<?php

require_once "vendor/autoload.php";

//Fetch all Job posts
$jobPostDb = new JobPostContext();
$jobPosts = $jobPostDb->ListAll();

//When user search for the Job Post into the list and click on search button
if (isset($_POST["searchJobPost"])) {

    $searchKey = $_POST["searchKey"];
    $jobPostDb = new JobPostContext();
    $jobPosts = $jobPostDb->Search($searchKey);
}
?>
    <div class="container">
        <div class="section">
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
                                                    <a href="jobApply.php?id=<?= $jobPost->id ?>"
                                                       title="View full job description"
                                                       class="btn waves-effect waves-light">View Job Description &
                                                        Apply</a>
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
    </div>
<?php require_once "includes/footer.php" ?>