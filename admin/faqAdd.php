<?php
require_once "../vendor/autoload.php";

$question = $answer = "";
$questionErr = $answerErr = "";
$err = false;
if (isset($_POST["add"])) {
    if (empty($_POST["question"])) {
        $questionErr = "Question is required";
        $err = true;
    }

    if (empty($_POST["answer"])) {
        $answerErr = "Answer is required";
        $err = true;
    }

    if (!$err) {
        echo "no err";
        $db = Database::getDb();
        $f = new FaqContext();
        $con = $f->Add($_POST);

        if ($con) {
            header('Location: faqList.php');
        } else {
            echo "problem adding faq";
        }
    }
}

?>
<?php require_once "../includes/adminHeader.php" ?>
<main>
    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 m12 l8  offset-l2">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Add FAQ</span>
                            <div class="row">
                                <form class="col s12" method="POST">
                                    <div class="row margin-bottom-none">
                                        <div class="input-field col s12">
                                            <input type="text" id="question" class="validate" name="question">
                                            <label for="question">Question *</label>
                                            <span class="helper-text red-text"> <?php echo $questionErr; ?></span>
                                        </div>
                                        <div class="input-field col s12">
                                            <input type="text" id="answer" class="validate" name="answer">
                                            <label for="answer">Answer *</label>
                                            <span class="helper-text red-text"> <?php echo $answerErr; ?></span>
                                        </div>
                                        <div class="input-field col s12">
                                            <button class="btn waves-effect waves-light" type="submit" name="add">Add
                                            </button>
                                            <a class="btn waves-effect waves-light" href="faqList.php">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once "../includes/adminFooter.php" ?>