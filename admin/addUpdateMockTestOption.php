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
$option;
if($page == 'Update') {
  // get specific option data to update
  $option = $mockTestQuestions->getMockTestQuestionOptions(0, $_GET['optionID']);
}

// check if the form is submitted
if(isset($_POST['addUpdateMockTestOption'])) {
  // add/update option
  $mockTestQuestions->addUpdateMockTestOption($_POST, ($page == 'Add') ? null : $_POST['optionID']);
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
            <span class="card-title"><?= $page; ?> Option</span>
            <form method="POST" action="">
              <div class="modal-content">
                <div class="row">
                  <div class="input-field col s12">
                  <input type="hidden" class="validate" value="<?= $_GET['questionID']; ?>" name="questionID">
                    <?php if($page == 'Update') { ?>
                      <input type="hidden" class="validate" value="<?= $option['id']; ?>" name="optionID">
                    <?php } ?>
                    <input type="text" id="mockTestOptionInput" class="validate" value="<?= ($page == 'Update') ? htmlspecialchars($option['option_value']) : ""; ?>" name="optionValue" required>
                    <label for="mockTestOptionInput" class="serach-label">Enter Option Value *</label>
                  </div>
                  <?php if($page == 'Update') { ?>
                    <div class="input-field col s12">
                      <p>
                        <label>
                          <input type="checkbox" name="isAnswer" class="filled-in" <?= $option['isAnswer'] ? "checked='checked'" : ""; ?> />
                          <span>This is the correct answer!</span>
                        </label>
                      </p>
                    </div>
                  <?php } ?>
                  <div class="input-field col s12">
                    <button class="btn waves-effect waves-light" type="submit" name="addUpdateMockTestOption">Submit
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