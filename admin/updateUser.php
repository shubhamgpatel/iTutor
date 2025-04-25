<?php
require_once "../vendor/autoload.php";

$err = false;
$id = "";
$first_name = $last_name = $email = $phone_number = $date_of_birth = $gender_id = $role_id = "";
$first_nameErr = $last_nameErr = $emailErr = $phone_numberErr = $date_of_birthErr = $gender_idErr = $role_idErr = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $u = new UserAdminContext();
    $userdetails = $u->Get($id);
    $first_name = $userdetails->first_name;
    $last_name = $userdetails->last_name;
    $email = $userdetails->email;
    $phone_number = $userdetails->phone_number;
    $date_of_birth = $userdetails->date_of_birth;
    $gender_id = $userdetails->gender_id;
    $role_id = $userdetails->role_id;
}
if (isset($_POST["update"])) {
    if (empty($_POST["first_name"])) {
        $first_nameErr = "First Name is required";
        $err = true;
    }

    if (empty($_POST["last_name"])) {
        $last_nameErr = "Last Name is required";
        $err = true;
    }
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $err = true;
    }

    if (empty($_POST["phone_number"])) {
        $phone_numberErr = "Phone number is required";
        $err = true;
    }

    if (empty($_POST["date_of_birth"])) {
        $date_of_birthErr = "Date of birth is required";
        $err = true;
    }
    if (empty($_POST["gender_id"])) {
        $gender_idErr = "Gender is required";
        $err = true;
    }

    if (empty($_POST["role_id"])) {
        $role_idErr = "Role is required";
        $err = true;
    }

    if (!$err) {
        echo "no err";
        $db = Database::getDb();
        $u = new UserAdminContext();
        $con = $u->Update($_POST, $id);

        if ($con) {
            header('Location: listUsers.php');
        } else {
            echo "problem updating user";
        }
    }
}
?>
<?php require_once "../includes/adminHeader.php" ?>
<main>
    <div class="container">

        <div class="section">
            <div class="row">


                <div class="row">
                    <div class="col s12 m12 l8  offset-l2">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Update details of <?= $first_name . " " . $last_name ?></span>

                                <div class="row">
                                    <form class="col s12" method="POST">
                                        <div class="row margin-bottom-none">
                                            <div>
                                                <p for="sub-update-title">First Name:</p>
                                                <input id="sub-update-title" type="text" class="add-contact-form" placeholder="First Name" name="first_name" value="<?= $first_name ?>">
                                                <span class="helper-text red-text"><?= $first_nameErr ?></span>
                                            </div>
                                            <div>
                                                <p for="sub-update-title">Last Name:</p>
                                                <input id="sub-update-title" type="text" class="add-contact-form" placeholder="Last Name" name="last_name" value="<?= $last_name ?>">
                                                <span class="helper-text red-text"><?= $last_nameErr ?></span>
                                            </div>
                                            <div>
                                                <p for="sub-update-title">Email:</p>
                                                <input id="sub-update-title" type="text" class="add-contact-form" placeholder="Email" name="email" value="<?= $email ?>">
                                                <span class="helper-text red-text"><?= $emailErr ?></span>
                                            </div>
                                            <div>
                                                <p for="sub-update-title">Phone:</p>
                                                <input id="sub-update-title" type="text" class="add-contact-form" placeholder="Phone" name="phone_number" value="<?= $phone_number ?>">
                                                <span class="helper-text red-text"><?= $phone_numberErr ?></span>
                                            </div>
                                            <div>
                                                <p for="sub-update-title">Date of Birth:</p>
                                                <input id="sub-update-title" type="text" class="add-contact-form" placeholder="Date of Birth" name="date_of_birth" value="<?= $date_of_birth ?>">
                                                <span class="helper-text red-text"><?= $date_of_birthErr ?></span>
                                            </div>
                                            <div class="input-field col s12 m6">
                                                <i class="material-icons prefix">wc</i>
                                                <select name="gender_id">
                                                    <option value="" disabled selected>Select Gender</option>
                                                    <option value="1" <?= ($gender_id == '1') ? "selected" : "" ?>>Male</option>
                                                    <option value="2" <?= ($gender_id == '2') ? "selected" : "" ?>>Female</option>
                                                    <option value="3" <?= ($gender_id == '3') ? "selected" : "" ?>>Other</option>
                                                </select>
                                                <label>Gender</label>
                                                <span class="helper-text red-text"> <?php echo $gender_idErr; ?></span>
                                            </div>
                                            <div class="input-field col s12 m6">
                                                <i class="material-icons prefix">wc</i>
                                                <select name="role_id">
                                                    <option value="" disabled selected>Select Role</option>
                                                    <option value="1" <?= ($role_id == "1") ? "selected" : ""; ?>>Admin</option>
                                                    <option value="2" <?= ($role_id == "2") ? "selected" : ""; ?>>Tutor</option>
                                                    <option value="3" <?= ($role_id == "3") ? "selected" : ""; ?>>Student</option>
                                                </select>
                                                <label>Role</label>
                                                <span class="helper-text red-text"> <?php echo $role_idErr ?></span>
                                            </div>
                                            <div class="input-field col s12">
                                                <button class="btn waves-effect waves-light" name="update" type="submit">Update
                                                </button>

                                                <a class="btn waves-effect waves-light " href="listUsers.php">Cancel</a>

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
    </div>
    </div>
</main>
<?php require_once "../includes/adminFooter.php" ?>