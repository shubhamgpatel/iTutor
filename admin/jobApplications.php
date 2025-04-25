<?php
/* Developer : Priyanka Khadilkar
  * This file list all job post applications. we can search the job application listing according to
  * Job title.
  * Only admin can access this List.
  */
require_once "../includes/adminHeader.php" ?>
<?php

require_once "../vendor/autoload.php";

//Declaring job Application search form variables
$jobPostId = "";
$searchKey = "";

//Fetch all Job posts
$jobApplicationsDb = new JobApplicationContext();
$jobApplications = $jobApplicationsDb->ListAll();

//Fetch all job post for binding into dropdown for search
$jobPostDb = new JobPostContext();
$jobPosts = $jobPostDb->ListAll();

//If user clicks on the search button
if(isset($_POST["searchJobApplication"])){
    $searchKey = $_POST["searchKey"];
    if(isset($_POST["jobPostId"]))
    {
        $jobPostId  = $_POST["jobPostId"];
    }
    //Search job application according to searchkeyword or selected job post.
    $jobApplicationsDb = new JobApplicationContext();
    $jobApplications = $jobApplicationsDb->Search($jobPostId,$searchKey);
}

?>
    <main class="adminmain">
        <div class="section no-pad-bot" id="index-banner">
            <div class="row">
                <div class="col s10 m6 l12">
                    <h5 class="breadcrumbs-title">Job Applicants</h5>
                </div>
                <div class="row">
                    <form method="post">
                        <div class="input-field col s12 m12 l4">
                            <input id="searchKey" name="searchKey" type="text" class="validate search-box">
                            <label for="searchKey" class="serach-label">Search Job applicants...</label>
                        </div>
                        <div class="input-field col s12 m12 l3">
                            <select name="jobPostId" class="browser-default">
                                <option value="" disabled selected>Select Job Post
                                    <!--Binding the job post dropdown -->
                                    <?php
                                    foreach ($jobPosts as $jobPost){
                                    ?>
                                <option value="<?=  $jobPost->id; ?>">
                                    <?= $jobPost->title; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input-field col s12 m12 l2">
                            <button class="btn waves-effect waves-light" type="submit" name="searchJobApplication">Search
                                <i class="material-icons right">search</i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <table class="responsive-table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Job Post</th>
                                        <th>Resume</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!--Binding All job application into the table -->
                                    <?php foreach ($jobApplications as $jobApplication) { ?>
                                        <tr>
                                            <td><?= $jobApplication->firstname; ?> <?= $jobApplication->lastname; ?> </td>
                                            <td><?= $jobApplication->email; ?></td>
                                            <td><?= $jobApplication->phone_number; ?></td>
                                            <td><?= $jobApplication->title; ?></td>
                                            <?php $filelink = '../Resume/' . $jobApplication->resume_filename; ?>
                                            <td><a target="_blank" href="<?= $filelink ?>"><?= $jobApplication->resume_filename ?></a>
                                            </td>
                                            <td>
                                                <a title="Email" href="emailToJobApplicant.php?id=<?= $jobApplication->id ?>"><i class="material-icons green-text">email</i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php require_once "../includes/adminFooter.php" ?>