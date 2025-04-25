<?php
require_once '../vendor/autoload.php';
$sessionData = Session::getInstance();
if (isset($sessionData->userId)) {
    $username = $sessionData->firstName;
} else {
    header('Location: ../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>iTutor</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link rel="stylesheet" href="../css/dist/summernote-lite.css"/>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="../css/dist/summernote-lite.js"></script>
    <script src="../css/dist/lang/summernote-es-ES.js"></script>
</head>
<body>
<header>
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="../admin/myProfile.php"><i class="material-icons">person_outline</i>Profile</a></li>
        <li><a href="../admin/changePassword.php"><i class="material-icons">security</i>Change Password</a></li>
        <li class="divider"></li>
        <li><a href="../logout.php"><i class="material-icons">keyboard_tab</i>Logout</a></li>
    </ul>
    <div class="navbar-fixed">
        <nav class="blue-grey" role="navigation">
            <div class="nav-wrapper">
                <a id="logo-container" href="#" class="brand-logo logo-font">iTutor</a>
                <ul class="right hide-on-med-and-down">
                    <li>
                        <a class="dropdown-trigger" href="#!" data-target="dropdown1">Welcome, <?= $username ?><i
                                    class="material-icons right">arrow_drop_down</i></a>
                    </li>
                </ul>

                <ul id="nav-mobile" class="sidenav admin-mobilemenu">
                    <li><a href="listUsers.php"><i class="material-icons">supervisor_account</i>Users</a></li>
                    <li><a href="listSubjects.php"><i class="material-icons">subject</i>Subjects</a></li>
                    <li><a href="LearningRoomList.php"><i class="material-icons">business</i>Learning Materials</a></li>
                    <?php if ($sessionData->roleId == UserRoles::Admin) { ?>
                        <li><a href="mockTests.php"><i class="material-icons">assignment</i>Mock Tests</a></li>
                        <li><a href="../admin/jobPosts.php"><i class="material-icons">work</i>Job Openings</a></li>
                        <li><a href="../admin/jobApplications.php"><i class="material-icons">picture_as_pdf</i>Job
                                Applications</a></li>
                    <?php } else if ($sessionData->roleId == UserRoles::Student) { ?>
                        <li><a href="../admin/mockTestEnroll.php"><i class="material-icons">assignment</i>Mock Test Enrollment</a></li>
                    <?php }?>
                    <li><a href="#!"><i class="material-icons">help_outline</i>FAQs</a></li>
                    <li><a href="webContent.php"><i class="material-icons">content_copy</i>Website Content</a></li>
                    <li><a href="showContact.php"><i class="material-icons">contact_mail</i>Contact Us</a></li>
                    <li><a href="showUserContact.php"><i class="material-icons">contacts</i> User Contacts </a></li>
                    <li class="divider"></li>
                    <li><a href="../admin/myProfile.php"><i class="material-icons">person_outline</i>Profile</a></li>
                    <li><a href="../admin/changePassword.php"><i class="material-icons">security</i>Change Password</a>
                    </li>
                    <li><a href="../logout.php"><i class="material-icons">keyboard_tab</i>Logout</a></li>
                </ul>
                <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons mobileHamburger">menu</i></a>
            </div>
        </nav>
    </div>
</header>
<aside>
    <ul id="slide-out" class="sidenav sidenav-fixed">
        <li class="brand-sidebar blue-grey">
            <a id="logo-container" href="#" class="brand-logo logo-font">iTutor</a>
        </li>
        <li><a href="listUsers.php"><i class="material-icons">supervisor_account</i>Users</a></li>
        <li><a href="listSubjects.php"><i class="material-icons">subject</i>Subjects</a></li>
        <li><a href="LearningRoomList.php"><i class="material-icons">business</i>Learning Places</a></li>
        <li><a href="mockTests.php"><i class="material-icons">assignment</i>Mock Tests</a></li>
        <?php if ($sessionData->roleId == UserRoles::Admin) { ?>
            <li><a href="mockTests.php"><i class="material-icons">assignment</i>Mock Tests</a></li>
            <li><a href="../admin/jobPosts.php"><i class="material-icons">work</i>Job Openings</a></li>
            <li><a href="../admin/jobApplications.php"><i class="material-icons">picture_as_pdf</i>Job
                    Applications</a></li>
        <?php } else if ($sessionData->roleId == UserRoles::Student) { ?>
            <li><a href="../admin/mockTestEnroll.php"><i class="material-icons">assignment</i>Mock Test Enrollment</a></li>
        <?php } ?>
        <li><a href="faqList.php"><i class="material-icons">help_outline</i>FAQs</a></li>
        <li><a href="showContact.php"><i class="material-icons">contact_mail</i>Contact Us</a></li>
        <li><a href="showUserContact.php"><i class="material-icons">contacts</i> User Contacts </a></li>
        <li><a href="webContent.php"><i class="material-icons">content_copy</i>Website Content</a></li>
        <li><a href="tutorAppointmentList.php"><i class="material-icons">access_time</i>Appointments</a></li>
    </ul>
</aside>