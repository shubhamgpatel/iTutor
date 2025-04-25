<?php
require_once "../vendor/autoload.php";


$id = "";
$question = "";
$answer = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $f = new FaqContext();
    $faqs = $f->Get($id);
    $question = $faqs->question;
    $answer = $faqs->answer;
}
if (isset($_POST["update"])) {
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
        $con = $f->Update($_POST, $id);

        if ($con) {
            header('Location: faqList.php');
        } else {
            echo "problem updtaing faq";
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
                            <span class="card-title">Update FAQ</span>
                            <div class="row">
                                <form class="col s12" method="POST" action="">
                                    <div class="row margin-bottom-none">
                                        <div class="input-field col s12">
                                            <input type="text" id="question" class="validate" name="question" value="<?= $question ?>">
                                            <label for="question">Question</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <input type="text" id="answer" class="validate" name="answer" value="<?= $answer ?>">
                                            <label for="answer">Answer</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <button class="btn waves-effect waves-light" name="update" type="submit">Update
                                            </button>
                                            <a class="btn waves-effect waves-light" href="faqList.php">Cancel</a>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
<?php require_once "../includes/adminFooter.php" ?>