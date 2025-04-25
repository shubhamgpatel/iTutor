<?php require_once "includes/header.php" ?>
<?php
/*
Created by : Priyanka Khadilkar
This file is for forgot password.
*/

require_once "vendor/autoload.php";

$EmailErr = "";
$Email = "";
$ErrorMsg = "";


//Function to validate all inputs
function validateEmail($email)
{
    Global $EmailErr;
    $isValidEmail = false;

    if ($email == "") {
        $EmailErr = "Please enter email.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $EmailErr = "Please enter valid email.";
    } else {
        $emailErr = "";
        $isValidEmail = true;
    }
    return $isValidEmail;
}

//Generate Random verification code for
function generateRandomString($length = 8)
{
    $characters = '0123456789abcdefghijklmnopqrs092u3tuvwxyzaskdhfhf9882323ABCDEFGHIJKLMNksadf9044OPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

//When user clicks "Update" button
if (isset($_POST["ForgotPassword"])) {
    $Email = $_POST["email"];

    $isFormValid = validateEmail($Email);

    //If form is valid then allow user to forgot password
    if ($isFormValid == true) {
        $userContext = new UserContext();
        $userExist = $userContext->CheckUserExistWithEmail($Email);
        if ($userExist != null) {
            $userContext = new UserContext();
            $verificationCode = generateRandomString();
            $userUpdated = $userContext->UpdateVerificationCode($Email, $verificationCode);
            if ($userUpdated) {
                $link = ConstantStr::ResetPasswordlink . "?code=" . $verificationCode . "&id=" . $userExist->id;
                $emailBody = EmailUtility::ForgotPasswordTemplate($userExist->first_name, $link);
                $isEmailSent = EmailUtility::SendEmail($Email, $userExist->first_name, "iTutor - Reset Password", $emailBody, true);
                if ($isEmailSent) {
                    $ErrorMsg = "<span class='green-text'>Password reset link has been sent to your email.</span>";
                }
            }
        } else {
            $ErrorMsg = "<span class='red-text'>Please Enter correct Old password.</span>";
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
                            <span class="card-title">Forgot Password</span>
                            <div class="row">
                                <?= $ErrorMsg ?>
                            </div>
                            <div class="row">
                                <form method="post" class="col s12">
                                    <div class="row margin-bottom-none">
                                        <div class="input-field col s12 m">
                                            <i class="material-icons prefix">account_circle</i>
                                            <input id="icon_prefix" value="<?= $Email ?>" name="email" type="email"
                                                   class="validate">
                                            <label for="icon_prefix">Email</label>
                                            <span class="helper-text red-text"><?= $EmailErr ?></span>
                                        </div>
                                        <div class="input-field col s12">
                                            <button class="btn waves-effect waves-light" type="submit"
                                                    name="ForgotPassword">Send Email
                                                <i class="material-icons right">send</i>
                                            </button>
                                        </div>
                                        <div class="input-field col s12">
                                            <a href="login.php">Back to Login!</a>
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