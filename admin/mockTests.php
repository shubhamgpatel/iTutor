<?php
// include files
// Mock Test Questions - database interaction
include_once "../database/classes/MockTestQuestionContext.php";
$mockTestQuestions = new MockTestQuestionContext();

// Mock Tests - database interaction
include_once "../database/classes/MockTestContext.php";
$mockTestsContext = new MockTestContext();

// Subjects - database interaction
include_once "../database/classes/SubjectContext.php";
$subject = new SubjectContext();

// Tutors - database interaction
include_once "../database/classes/TutorContext.php";
$tutor = new TutorContext();

// handle delete requests
if(isset($_GET['deleteQuestion'])) {
  // delete mock test question
  $mockTestQuestions->deleteMockTestQuestion($_GET['deleteQuestion']);
  header('location: mockTests.php?tab=questions');
} else if(isset($_GET['deleteOption'])) {
  // delete option from the question
  $mockTestQuestions->deleteMockTestOption($_GET['deleteOption']);
  header('location: mockTests.php?tab=questions');
} else if(isset($_GET['deleteTest'])){
  // delete mock test
  $mockTestsContext->deleteMockTest($_GET['deleteTest']);
  header('location: mockTests.php?tab=tests');
}

// fetch mock test questions
$mockQuestions = $mockTestQuestions->getMockTestQuestions(null, (isset($_GET['searchQuestion']) && $_GET['searchQuestion'] != '') ? $_GET['searchQuestion'] : null, (isset($_GET['subjectQuestion']) && $_GET['subjectQuestion'] != '') ? $_GET['subjectQuestion'] : null, (isset($_GET['tutorQuestion']) && $_GET['tutorQuestion'] != '') ? $_GET['tutorQuestion'] : null);

// fetch mock tests
$mockTests = $mockTestsContext->getMockTests(null, (isset($_GET['searchTest']) && $_GET['searchTest'] != '') ? $_GET['searchTest'] : null, (isset($_GET['subjectTest']) && $_GET['subjectTest'] != '') ? $_GET['subjectTest'] : null, (isset($_GET['tutorTest']) && $_GET['tutorTest'] != '') ? $_GET['tutorTest'] : null);

// fetch subjects
$subjects = $subject->getAllSubjects();

// fetch tutors
$tutors = $tutor->getAllTutors();

// set the tab back on refresh the page
$tab = 'tests';
if(isset($_GET['tab'])) {
  $tab = $_GET['tab'];
}
?>
<?php require_once "../includes/adminHeader.php" ?>

<main class="adminmain admin-mock-tests">
  <div class="section no-pad-bot" id="index-banner">
    <div class="row">
    <form action="" method="GET">
      <div class="col s12">
        <ul class="tabs">
          <li class="tab col s6 m5 l4"><a <?= ($tab == 'tests') ? "class='active'" : ""; ?> href="#MockTest">Mock Tests</a></li>
          <li class="tab col s6 m5 l4"><a <?= ($tab == 'questions') ? "class='active'" : ""; ?> href="#MockTestQuestions">Mock Test Questions</a></li>
        </ul>
      </div>
      <div id="MockTest" class="col s12">
        <div class="row">
          <div class="input-field col s12 m12 l4">
            <input id="mock_test_search" type="text" class="validate search-box" name="searchTest" value="<?= isset($_GET['searchTest']) ? $_GET['searchTest'] : ""; ?>">
            <label for="mock_test_search" class="serach-label">Search Mock Test...</label>
          </div>
          <div class="input-field col s12 m12 l3">
            <select class="browser-default" name="tutorTest">
              <option value='' <?= !isset($_GET['tutorTest']) ? "selected" : ""; ?>>---Select Tutor---</option>
              <?php
                foreach ($tutors as $tutor) { 
              ?>
                <option value="<?= $tutor['id']; ?>" <?= (isset($_GET['tutorTest']) && $_GET['tutorTest'] == $tutor['id']) ? "selected" : ""; ?>><?= $tutor['first_name'] . " " . $tutor['last_name']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="input-field col s12 m12 l3">
            <select class="browser-default" name="subjectTest">
            <option value='' <?= !isset($_GET['subjectTest']) ? "selected" : ""; ?>>---Select Subject---</option>
            <?php
              foreach ($subjects as $subject) { 
            ?>
              <option value="<?= $subject['id']; ?>" <?= (isset($_GET['subjectTest']) && $_GET['subjectTest'] == $subject['id']) ? "selected" : ""; ?>><?= $subject['title']; ?></option>
            <?php } ?>
            </select>
          </div>
          <div class="input-field col s12 m12 l2">
            <button class="btn waves-effect waves-light" type="submit" name="action">Search
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
                              <th>Title</th>
                              <th>Subject</th>
                              <th>Marks</th>
                              <th></th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php 
                            foreach($mockTests as $mockTest) {
                          ?>
                          <tr>
                              <td><a href="showMockTest.php?testID=<?= $mockTest['id']; ?>"><?= $mockTest['title']; ?></a></td>
                              <td><?= $mockTest['subject'][0]['title']; ?></td>
                              <td><?= $mockTest['marks']; ?></td>
                              <td>
                                  <a href="addUpdateMockTest.php?action=Update&testID=<?= $mockTest['id']; ?>"><i class="material-icons blue-text">create</i></a>
                                  <a class='waves-effect waves-light modal-trigger' href="#testDeleteModel<?= $mockTest['id']; ?>"><i class="material-icons red-text">delete</i></a>
                                  <div id="testDeleteModel<?= $mockTest['id']; ?>" class="modal">
                                    <div class="modal-content">
                                      <h4>Are you sure you want to delete this Test?</h4>
                                      <p><?= $mockTest['title']; ?></p>
                                    </div>
                                    <div class="modal-footer">
                                      <a href="#!" class="modal-close waves-effect waves-green btn-flat">No</a>
                                      <a href="mockTests.php?deleteTest=<?= $mockTest['id']; ?>" class="modal-close waves-effect waves-green btn-flat">Yes</a>
                                    </div>
                                  </div>
                              </td>
                          </tr>
                          <?php } ?>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="direction-top">
            <a title="Add Mock Test" href="addUpdateMockTest.php?action=Add" class="btn-floating btn-large green floatright">
              <i class="large material-icons">add</i>
            </a>
          </div>
        </div>
      </div>
      <div id="MockTestQuestions" class="col s12">
        <div class="row">
        <form action="" method="GET">
          <div class="input-field col s12 m12 l4">
            <input type="hidden" value="questions" name="tab">
            <input id="mock_test_questions_search" type="text" name="searchQuestion" class="validate search-box" value="<?= isset($_GET['searchQuestion']) ? $_GET['searchQuestion'] : ""; ?>">
            <label for="mock_test_questions_search" class="serach-label">Search Mock Test Questions...</label>
          </div>
          <div class="input-field col s12 m12 l3">
            <select class="browser-default" name="tutorQuestion">
              <option value='' <?= !isset($_GET['tutorQuestion']) ? "selected" : ""; ?>>---Select Tutor---</option>
              <?php
                foreach ($tutors as $tutor) { 
              ?>
                <option value="<?= $tutor['id']; ?>" <?= (isset($_GET['tutorQuestion']) && $_GET['tutorQuestion'] == $tutor['id']) ? "selected" : ""; ?>><?= $tutor['first_name'] . " " . $tutor['last_name']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="input-field col s12 m12 l3">
            <select class="browser-default" name="subjectQuestion">
            <option value='' <?= !isset($_GET['subjectQuestion']) ? "selected" : ""; ?>>---Select Subject---</option>
            <?php
              foreach ($subjects as $subject) { 
            ?>
              <option value="<?= $subject['id']; ?>" <?= (isset($_GET['subjectQuestion']) && $_GET['subjectQuestion'] == $subject['id']) ? "selected" : ""; ?>><?= $subject['title']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="input-field col s12 m12 l2">
            <button class="btn waves-effect waves-light" type="submit" name="action">Search
              <i class="material-icons right">search</i>
            </button>
          </div>
        </form>
        </div>
        <a title="Add Mock Test Question" href="addUpdateMockTestQuestion.php?action=Add" class="btn-floating btn-large green floatright floating-btn">
          <i class="large material-icons">add</i>
        </a>
        <a class='waves-effect waves-light modal-trigger hidden' href='#questionAddUpdate' id='linkQuestionAddUpdate'>s</a>
        <div class="row" id="mockTestsList">
          <?php 
          foreach ($mockQuestions as $mockQuestion) {
          ?>
          <div class='col s12'>
            <div class='card'>
              <div class='card-content'><span class='card-title'><?= $mockQuestion['question']; ?>
                  <p class='floatright tiny-text'><?= $mockQuestion['marks']; ?> Marks</p></span>
                <table>
                <?php 
                $index = 0;
                foreach ($mockQuestion['options'] as $option) {
                  $index++;
                ?>
                  <tr>
                    <td><?= $index; ?></td>
                    <td><?= $option['option_value']; ?> <?= $option['isAnswer'] ? "<span class='new badge' data-badge-caption='Answer'></span>" : ""; ?></td>
                    <td><a href='addUpdateMockTestOption.php?action=Update&optionID=<?= $option['id']; ?>&questionID=<?= $mockQuestion['id']; ?>'>Edit</a></td>
                    <td>
                      <a class='waves-effect waves-light modal-trigger' href="#optionDeleteModel<?= $option['id']; ?>">Delete</a>
                      <div id="optionDeleteModel<?= $option['id']; ?>" class="modal">
                        <div class="modal-content">
                          <h4>Are you sure you want to delete this Option?</h4>
                          <p><?= $option['option_value']; ?></p>
                        </div>
                        <div class="modal-footer">
                          <a href="#!" class="modal-close waves-effect waves-green btn-flat">No</a>
                          <a href="mockTests.php?deleteOption=<?= $option['id']; ?>" class="modal-close waves-effect waves-green btn-flat">Yes</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php } ?>
                </table>
              </div>
              <div class='card-action'>
                <a class='waves-effect waves-light modal-trigger' href='addUpdateMockTestOption.php?action=Add&questionID=<?= $mockQuestion['id']; ?>'>Add Option</a>
                <a class='waves-effect waves-light' href='addUpdateMockTestQuestion.php?action=Update&questionID=<?= $mockQuestion['id']; ?>'>Edit</a>
                <a class='waves-effect waves-light modal-trigger' href='#questionDeleteModel<?= $mockQuestion['id']; ?>'>Delete</a></div>
                <div id="questionDeleteModel<?= $mockQuestion['id']; ?>" class="modal">
                  <div class="modal-content">
                    <h4>Are you sure you want to delete this Question?</h4>
                    <p><?= $mockQuestion['question']; ?></p>
                  </div>
                  <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">No</a>
                    <a href="mockTests.php?deleteQuestion=<?= $mockQuestion['id']; ?>" class="modal-close waves-effect waves-green btn-flat">Yes</a>
                  </div>
                </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>

  </div>

  <!-- Modal Structure -->
  <div id="optionAddUpdate" class="modal">
    <form>
      <div class="modal-content">
        <h4>Add Option</h4>
        <p>How to create a variable in PHP?</p>
        <div class="row">
          <div class="input-field col s12">
            <input id="optionValue" type="text" class="validate">
            <label for="optionValue" class="serach-label">Enter Option value</label>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Add Option</a>
      </div>
    </form>
  </div>

  <!-- Modal Structure -->
  <div id="questionAddUpdate" class="modal">
    <form method="POST" onsubmit="addMockTestQuestionAPI(this.value, event)" id="questionAddUpdateForm">
      <div class="modal-content">
        <h4><span id="questionAddUpdateAction"></span> Question</h4>
        <div class="row">
          <div class="input-field col s12">
            <input id="mockTestQuestionInput" type="text" class="validate">
            <label for="mockTestQuestionInput" class="serach-label">Enter Question</label>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
        <a href="#" class="modal-close waves-effect waves-green btn-flat" onclick="document.getElementById('questionAddUpdateForm').submit();">Submit</a>
      </div>
    </form>
  </div>
</main>
<?php require_once "../includes/adminFooter.php" ?>