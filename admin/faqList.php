<?php require_once "../includes/adminHeader.php" ?>
<?php
require_once "../vendor/autoload.php";


$db = Database::getDb();
$f = new FaqContext();
$faqs = $f->ListAll();

if (isset($_POST["delete"])) {
  $faqId = $_POST["faqId"];

  $db = Database::getDb();
  $f = new FaqContext();
  $numRowsAffected = $f->Delete($faqId);
  if ($numRowsAffected) {
    $f = new FaqContext();
    $faqs = $f->ListAll();
  } else {
    echo "problem deleting data";
  }
}

if (isset($_POST["searchFaq"])) {
  $faqsearchkey = $_POST["faqsearchkey"];
  $f = new FaqContext();
  $faqs = $f->Search($faqsearchkey);
}

?>


<main class="adminmain admin-mock-tests">
  <div class="section no-pad-bot" id="index-banner">
    <div class="row">
      <div class="col s10 m6 l12">
        <h5 class="breadcrumbs-title">FAQs</h5>
      </div>
      <div class="row">
        <form method="POST">
          <div class="input-field col s12 m12 l4">
            <input id="faqsearchkey" name="faqsearchkey" type="text" class="validate search-box">
            <label for="faqsearchkey" class="serach-label">Search faq...</label>
          </div>

          <div class="input-field col s12 m12 l2">
            <button class="btn waves-effect waves-light" type="submit" name="searchFaq">Search
              <i class="material-icons right">search</i>
            </button>
          </div>
          <div class="direction-top">
            <a title="Add Leaning Material" href="faqAdd.php" class="btn-floating btn-large green floatright">
              <i class="large material-icons">add</i>
            </a>
          </div>
        </form>
      </div>
      <?php
      foreach ($faqs as $faq) {
      ?>
        <div class="row">
          <div class="col s12 m12 l12">
            <div class="card">
              <div class="card-content">

                <div>
                  <div class="section">
                    <div>
                      <h5><?= $faq->question; ?></h5>
                      <p class="small-text"><?= $faq->answer; ?></p>
                    </div>
                    <div class="faqActions">
                      <a href="faqUpdate.php?id=<?= $faq->id; ?>"><i class="material-icons blue-text">create</i></a>
                      <?PHP
                      $modalId = "modal" . $faq->id;
                      ?>
                      <a class="modal-trigger" href="#<?= $modalId ?>" name="delete"><i class="material-icons red-text">delete</i></a>
                      <div id="<?= $modalId ?>" class="modal">
                        <div class="modal-content">
                          <h4><?= $faq->question; ?></h4>
                          <p>Are you sure you want to delete this faq?</p>
                        </div>
                        <form method="post">
                          <div class="modal-footer">
                            <input type="hidden" name="faqId" value="<?= $faq->id ?>">
                            <a class="modal-close waves-effect waves-red btn-flat">No</a>
                            <button class="btn waves-effect waves-light" type="submit" name="delete">Yes</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="divider"></div>

                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>

</main>

<?php require_once "../includes/adminFooter.php" ?>