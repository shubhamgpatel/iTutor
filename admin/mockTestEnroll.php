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

// fetch mock tests
$mockTests = $mockTestsContext->getMockTests(null, (isset($_GET['searchTest']) && $_GET['searchTest'] != '') ? $_GET['searchTest'] : null, (isset($_GET['subjectTest']) && $_GET['subjectTest'] != '') ? $_GET['subjectTest'] : null, (isset($_GET['tutorTest']) && $_GET['tutorTest'] != '') ? $_GET['tutorTest'] : null);

// fetch subjects
$subjects = $subject->getAllSubjects();

// fetch tutors
$tutors = $tutor->getAllTutors();

// set the tab back on refresh the page
$tab = 'mockTests';
if(isset($_GET['tab'])) {
  $tab = $_GET['tab'];
}
?>
<?php 
require_once "../includes/adminHeader.php";
// fetch mock test questions
$mockTestResult = $mockTestsContext->getMockTestResult($sessionData->userId);
?>

<main class="adminmain admin-mock-tests">
  <div class="section no-pad-bot" id="index-banner">
    <div class="row">
      <div class="col s12">
        <ul class="tabs">
          <li class="tab col s6 m5 l4"><a <?= ($tab == 'mockTests') ? "class='active'" : ""; ?> href="#MockTest">All Mock Tests</a></li>
          <li class="tab col s6 m5 l4"><a <?= ($tab == 'attempts') ? "class='active'" : ""; ?> href="#MockTestAttempts">Mock Test Attempts</a></li>
        </ul>
      </div>
      <div id="MockTest" class="col s12">
        <div class="row">
          <form action="" method="GET">
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
                              <td><a href="attemptMockTest.php?testID=<?= $mockTest['id']; ?>"><?= $mockTest['title']; ?></a></td>
                              <td><?= $mockTest['subject'][0]['title']; ?></td>
                              <td><?= $mockTest['marks']; ?></td>
                              <td>
                                  
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
      <div id="MockTestAttempts" class="col s12">
        <div class="row" id="mockTestsList">
          <?php 
          foreach ($mockTestResult as $result) {
          ?>
          <div class='col s12'>
            <div class='card'>
              <div class='card-content'><span class='card-title'><?= $result['title']; ?>
                  <p class='floatright tiny-text'><?= $result['optained_marks']; ?> Marks</p>
                  <p class='tiny-text'>Date: <?= $result['created_datetime']; ?></p></span>
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