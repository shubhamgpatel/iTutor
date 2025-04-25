<?php

include_once "../database/classes/MockTestContext.php";
$mockTestsContext = new MockTestContext();

$mockTest = $mockTestsContext->getMockTests($_GET['testID'], (isset($_GET['searchTest']) && $_GET['searchTest'] != '') ? $_GET['searchTest'] : null, (isset($_GET['subjectTest']) && $_GET['subjectTest'] != '') ? $_GET['subjectTest'] : null, (isset($_GET['tutorTest']) && $_GET['tutorTest'] != '') ? $_GET['tutorTest'] : null);

include_once "../database/classes/MockTestQuestionContext.php";
$mockTestQuestionContext = new MockTestQuestionContext();
$mockTestQuestions = $mockTestQuestionContext->getMockTestQuestions();

// var_dump($mockTest);
$mockTestQuestions = $mockTestsContext->filterMockTestQuestions($mockTestQuestions, $mockTest['questions'], $mockTest['subject'][0]['id']);

if (isset($_POST['addQuestion'])) {
  $mockTestsContext->addQuestionMockTest($_POST['questionID'], $mockTest['id']);
  header('Location: showMockTest.php?testID=' . $_GET['testID']);
}

if (isset($_GET['deleteQuestion'])) {
  $mockTestsContext->deleteMockTestQuestion($_GET['deleteQuestion'], $mockTest['id']);
  header('Location: showMockTest.php?testID=' . $_GET['testID']);
}

?>
<?php require_once "../includes/adminHeader.php" ?>

<main class="adminmain admin-mock-tests">
  <div class="row">
    <div class="col s12 m12 l12">
      <div class="card">
        <div class="card-content">
        <a href="mockTests.php">Back to List </a>
          <span class="card-title"><?= $mockTest['title']; ?></span>
          <p>Subject: <strong><?= $mockTest['subject'][0]['title']; ?></strong></p>
          <strong class="marks-card"><?= $mockTest['marks']; ?> marks </strong>
          <table class="responsive-table">
            <thead>
              <tr>
                <th>Question</th>
                <th>Marks</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $index = 1;
              foreach ($mockTest['questions'] as $question) {
              ?>
                <tr>
                  <td>
                    <?= $index++; ?>. <?= $question['question']; ?></a>
                    <ol>
                      <?php
                      $options = $mockTestQuestionContext->getMockTestQuestionOptions($question['id']);
                      foreach ($options as $option) {
                      ?>
                        <li><?= $option['option_value']; ?></li>
                      <?php } ?>
                    </ol>
                  </td>
                  <td><?= $question['marks']; ?></td>
                  <td>
                    <a class='waves-effect waves-light modal-trigger' href="#questionDeleteModel<?= $question['id']; ?>"><i class="material-icons red-text">delete</i></a>
                    <div id="questionDeleteModel<?= $question['id']; ?>" class="modal">
                      <div class="modal-content">
                        <h4>Are you sure you want to delete this Question?</h4>
                        <p><?= $question['question']; ?></p>
                      </div>
                      <div class="modal-footer">
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">No</a>
                        <a href="showMockTest.php?deleteQuestion=<?= $question['id'] . "&testID=" . $_GET['testID']; ?>" class="modal-close waves-effect waves-green btn-flat">Yes</a>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php } ?>
              <tr>
                <td colspan="3">
                  <form method="POST">
                    <div class="row">
                      <div class="input-field col s12">
                        <select class="browser-default" name="questionID" required>
                          <option value='' <?= !isset($_GET['tutorTest']) ? "selected" : ""; ?>>---Select Question---</option>
                          <?php
                          foreach ($mockTestQuestions as $question) {
                          ?>
                            <option value="<?= $question['id']; ?>"><?= $question['question']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="input-field col s12">
                        <button class="btn waves-effect waves-light" type="submit" name="addQuestion">Add Question</button>
                      </div>
                    </div>
                  </form>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</main>
<?php require_once "../includes/adminFooter.php" ?>