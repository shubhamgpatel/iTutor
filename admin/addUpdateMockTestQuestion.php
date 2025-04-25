<?php

// include files
// Mock Test Questions - database interaction
include_once "../database/classes/MockTestQuestionContext.php";
$mockTestQuestions = new MockTestQuestionContext();

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
$mockQuestion;
if($page == 'Update') {
  $questionID = isset($_GET['questionID']) ? $_GET['questionID'] : 0;
  // get mock test question data if the page is update
  $mockQuestion = $mockTestQuestions->getMockTestQuestions($questionID);
}

// check if the form is submitted
if(isset($_POST['addUpdateMockTestQuestion'])) {
  // add/update mock test question
  $mockTestQuestions->addUpdateMockTestQuestion($_POST, ($page == 'Add') ? null : $_POST['questionID']);
  header('Location: mockTests.php?tab=questions');
}
?>
<?php require_once "../includes/adminHeader.php" ?>
<main class="adminmain admin-mock-tests">
  <div class="section no-pad-bot" id="index-banner">
    <div class="row">
      <div class="col s12">
        <div class="card">
          <div class="card-content">
            <span class="card-title"><?= $page; ?> Question</span>
            <form method="POST" action="">
              <div class="modal-content">
                <div class="row">
                <div class="input-field col s12 m12 l6">
                  <select class="browser-default" name="tutor" required> 
                  <option value='' selected>---Select Tutor---</option>
                  <?php
                    foreach ($tutors as $tutor) { 
                  ?>
                    <option value="<?= $tutor['id']; ?>" <?= ($page == 'Update' && $mockQuestion['tutor_id']==$tutor['id']) ? "selected" : ""; ?>><?= htmlspecialchars($tutor['first_name']) . " " . htmlspecialchars($tutor['last_name']); ?></option>
                  <?php } ?>
                  </select>
                </div>
                <div class="input-field col s12 m12 l6">
                  <select class="browser-default" name="subject" required> 
                  <option value='' selected>---Select Subject---</option>
                  <?php
                    foreach ($subjects as $subject) { 
                  ?>
                    <option value="<?= $subject['id']; ?>" <?= ($page == 'Update' && $mockQuestion['subject_id']==$subject['id']) ? "selected" : ""; ?>><?= htmlspecialchars($subject['title']); ?></option>
                  <?php } ?>
                  </select>
                </div>
                  <div class="input-field col s12">
                    <?php if($page == 'Update') { ?>
                      <input type="hidden" class="validate" value="<?= $mockQuestion['id']; ?>" name="questionID">
                    <?php } ?>
                    <input type="text" class="validate" value="<?= ($page == 'Update') ? htmlspecialchars($mockQuestion['question']) : ""; ?>" name="questionValue" required>
                    <label for="mockTestQuestionInput" class="serach-label">Enter Question *</label>
                  </div>
                  <div class="input-field col s12">
                    <input id="marks" type="number" class="validate" value="<?= ($page == 'Update') ? $mockQuestion['marks'] : ""; ?>" name="marks" required>
                    <label for="marks" class="serach-label">Marks *</label>
                  </div>
                  <div class="input-field col s12">
                    <button class="btn waves-effect waves-light" type="submit" name="addUpdateMockTestQuestion">Submit
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