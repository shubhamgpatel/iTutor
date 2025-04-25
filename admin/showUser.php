<?php

require_once "../vendor/autoload.php";

$id = "";
$first_name = $last_name = $email = $phone_number = $date_of_birth = $gender = $role = "";
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $u = new UserAdminContext();
  $userdetails = $u->Show($id);
  $first_name = $userdetails->first_name;
  $last_name = $userdetails->last_name;
  $email = $userdetails->email;
  $phone_number = $userdetails->phone_number;
  $date_of_birth = $userdetails->date_of_birth;
  $gender = $userdetails->gender;
  $role = $userdetails->user_role;
}

?>



<?php require_once "../includes/adminHeader.php" ?>
<main class="adminmain admin-mock-tests">
  <div class="section no-pad-bot" id="index-banner">
    <div class="row">
      <div class="col s10 m6 l12">
        <h5 class="breadcrumbs-title">Details of <?= $first_name . " " . $last_name ?></h5>
      </div>
      <div class="row">
        <div class="col s12 m12 l12">
          <div class="card">
            <div class="card-content">
              <div class="row margin-bottom-none">
                <div class="input-field col s12 m12 l6">
                  <section><strong>Firstname:</strong></section>
                  <section><?= $first_name ?></section>
                </div>
                <div class="input-field col s12 m12 l6">
                  <section><strong>Lastname:</strong></section>
                  <section><?= $last_name ?></section>
                </div>
                <div class="input-field col s12">
                  <section><strong>Email:</strong></section>
                  <section><?= $email ?></section>
                </div>
                <div class="input-field col s12">
                  <section><strong>Phone:</strong></section>
                  <section><?= $phone_number ?></section>
                </div>
                <div class="input-field col s12">
                  <section><strong>Date of Birth:</strong></section>
                  <section><?= $date_of_birth ?></section>
                </div>
                <div class="input-field col s12 m12 l12">
                  <section><strong>Gender:</strong></section>
                  <section><?= $gender; ?></section>
                </div>
                <div class="input-field col s12 m12 l12">
                  <section><strong>Role:</strong></section>
                  <section><?= $role; ?></section>
                </div>
                <div class="input-field col s12">
                  <a class="btn waves-effect waves-light " href="updateUser.php?id=<?= $id; ?>">Update</a>
                  <a class="btn waves-effect waves-light  " href="listUsers.php">Back</a>
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