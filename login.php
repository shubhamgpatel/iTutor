<?php require_once "includes/header.php" ?>

<?php
/*
    Created by : Priyanka Khadilkar
*/
require_once "vendor/autoload.php";

//Initialize the session
$sessionData = Session::getInstance();

$email = "";
$password = "";
$emailErr = "";
$passwordErr = "";
$ErrorMsg = "";

function validateInputs($email, $password)
{
    Global $emailErr, $passwordErr;
    $isEmailValid = false;
    $isPasswordValid = false;

    if ($email == "") {
        $emailErr = "Please enter email.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Please enter valid email.";
    } else {
        $emailErr = "";
        $isEmailValid = true;
    }

    if ($password == "") {
        $passwordErr = "Please enter password";
    } else {
        $passwordErr = "";
        $isPasswordValid = true;
    }

    if ($isEmailValid && $isPasswordValid) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    if (validateInputs($email, $password)) {
        $userContext = new UserContext();
        $userExist = $userContext->CheckValidUserCredentials($email, $password);
        if ($userExist != null) {

            //Assign session value
            $sessionData->userId = $userExist->id;
            $sessionData->firstName = $userExist->first_name;
            $sessionData->lastName = $userExist->last_name;
            $sessionData->roleId = $userExist->role_id;

            header('Location: admin/myProfile.php');
        } else {
            $ErrorMsg = "Please Enter valid email and password.";
        }

    }

}

?>
<div class="container">
    <div class="section">
        <div class="row">
            <div class="col s12 m12 l6  offset-l3">
                <div class="card login-card">
                    <div class="card-content">
                        <span class="card-title">Login</span>
                        <div class="row">
                            <span class="red-text"><?= $ErrorMsg ?></span>
                        </div>
                        <div class="row">
                            <form method="post" class="col s12">
                                <div class="row margin-bottom-none">
                                    <div class="input-field col s12 m">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input name="email" value="<?= $email ?>" id="icon_prefix" type="text"
                                               class="validate">
                                        <label for="icon_prefix">Email</label>
                                        <span class="helper-text red-text"><?= $emailErr ?></span>
                                    </div>
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">lock</i>
                                        <input id="icon_password" value="<?= $password ?>" type="password"
                                               name="password" class="validate">
                                        <label for="icon_password">Password</label>
                                        <span class="helper-text red-text"><?= $passwordErr ?></span>
                                    </div>
                                    <div class="input-field col s12">
                                        <button class="btn waves-effect waves-light" type="submit" name="login">
                                            Login
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                    <div class="input-field col s12">
                                        <a href="forgotPassword.php">Forgot Password?</a>
                                        <a href="register.php" class="right">New Member? Sign Up!</a>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
</div>
<?php require_once "includes/footer.php" ?>