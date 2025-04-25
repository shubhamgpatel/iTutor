<?php

// include files
// Mock Tests - database interaction
include_once "../database/classes/MockTestContext.php";
$mockTestContext = new MockTestContext();

// Subjects - database interaction
include_once "../database/classes/SubjectContext.php";
$subject = new SubjectContext();

// Tutors - database interaction
include_once "../database/classes/TutorContext.php";
$tutor = new TutorContext();

// fetch subjects
$subjects = $subject->getAllSubjects();

// fetch tutors
$tutors = $tutor->getAllTutors();

// check the page type (Add/Update)
$page = isset($_GET['action']) ? $_GET['action'] : "Add";
$mockTest;
if($page == 'Update') {
  $testID = isset($_GET['testID']) ? $_GET['testID'] : 0;
  // get mock test data if the page is update
  $mockTest = $mockTestContext->getMockTests($testID);
}

// check if the form is submitted
if(isset($_POST['addUpdateMockTest'])) {
  // add/update mock test data
  $mockTestContext->addUpdateMockTest($_POST, ($page == 'Add') ? null : $_POST['testID']);
  header('Location: mockTests.php?tab=tests');
}
?>
<?php require_once "../includes/adminHeader.php" ?>
<main class="adminmain admin-mock-tests">
  <div class="section no-pad-bot" id="index-banner">
    <div class="row">
      <div class="col s12">
        <div class="card">
          <div class="card-content">
            <span class="card-title"><?= $page; ?> Test</span>
            <form method="POST" action="">
              <div class="modal-content">
                <div class="row">
                <div class="input-field col s12 m12 l6">
                  <select class="browser-default" name="tutor" required> 
                  <option value='' selected>---Select Tutor---</option>
                  <?php
                    foreach ($tutors as $tutor) { 
                  ?>
                    <option value="<?= $tutor['id']; ?>" <?= ($page == 'Update' && $mockTest['tutor_id']==$tutor['id']) ? "selected" : ""; ?>><?= htmlspecialchars($tutor['first_name']) . " " . htmlspecialchars($tutor['last_name']); ?></option>
                  <?php } ?>
                  </select>
                </div>
                <div class="input-field col s12 m12 l6">
                  <select class="browser-default" name="subject" required> 
                  <option value='' selected>---Select Subject---</option>
                  <?php
                    foreach ($subjects as $subject) { 
                  ?>
                    <option value="<?= $subject['id']; ?>" <?= ($page == 'Update' && $mockTest['subject_id']==$subject['id']) ? "selected" : ""; ?>><?= htmlspecialchars($subject['title']); ?></option>
                  <?php } ?>
                  </select>
                </div>
                  <div class="input-field col s12">
                    <?php if($page == 'Update') { ?>
                      <input type="hidden" class="validate" value="<?= $mockTest['id']; ?>" name="testID">
                    <?php } ?>
                    <input type="text" class="validate" value="<?= ($page == 'Update') ? htmlspecialchars($mockTest['title']) : ""; ?>" name="title" required>
                    <label for="mockTestQuestionInput" class="serach-label">Enter Test Title *</label>
                  </div>
                  <div class="input-field col s12">
                    <button class="btn waves-effect waves-light" type="submit" name="addUpdateMockTest">Submit
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php require_once "../includes/adminFooter.php" ?>