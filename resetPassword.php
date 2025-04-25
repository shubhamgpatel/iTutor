<?php require_once "includes/header.php" ?>
<?php

require_once "vendor/autoload.php";

$NewPasswordErr = "";
$ConfirmNewPasswordErr = "";
$NewPassword = "";
$ConfirmNewPassword = "";
$ErrorMsg = "";
$verificationCode = "";
$userId = "";

if (isset($_GET["code"])) {
    $verificationCode = $_GET["code"];
}

if (isset($_GET["id"])) {
    $userId = $_GET["id"];
}

//Function to validate all inputs
function validateInputs($newPassword, $confirmNewPassword)
{
    Global $NewPasswordErr, $ConfirmNewPasswordErr;
    $isNewPasswordValid = false;
    $isConfirmNewPasswordValid = false;

    if ($newPassword == "") {
        $NewPasswordErr = "Please enter your new password.";
    } else {
        $NewPasswordErr = "";
        $isNewPasswordValid = true;
    }

    if ($confirmNewPassword == "") {
        $ConfirmNewPasswordErr = "Please confirm your new password.";
    } else if ($newPassword != $confirmNewPassword) {
        $ConfirmNewPasswordErr = "Password does not match.";
    } else {
        $ConfirmNewPasswordErr = "";
        $isConfirmNewPasswordValid = true;
    }


    if ($isNewPasswordValid == true && $isConfirmNewPasswordValid == true) {
        return true;
    } else {
        return false;
    }


}

//When user clicks "Update" button
if (isset($_POST["resetPassword"])) {
    $NewPassword = $_POST["NewPassword"];
    $ConfirmNewPassword = $_POST["ConfirmNewPassword"];

    $isFormValid = validateInputs($NewPassword, $ConfirmNewPassword);

    //If form is valid then allow user to register
    if ($isFormValid == true && $verificationCode != "" && $userId != "") {
        $userContext = new UserContext();
        $isPasswordValid = $userContext->CheckVerificationCodeIsValid($verificationCode, $userId);
        if ($isPasswordValid) {
            $userContext = new UserContext();
            $EncryptedPassword = password_hash($ConfirmNewPassword, PASSWORD_DEFAULT);
            $userUpdated = $userContext->UpdatePassword($EncryptedPassword, $userId);
            $ErrorMsg = "<span class='green-text'>Your Password is reset successfully.Please go to <a href='forgotPassword.php'>Login</a> page</span>";
        } else {
            $ErrorMsg = "<span class='red-text'>Reset Password link is not valid.Please go to <a href='forgotPassword.php'>Forgot Password</a> page</span>";
        }
    }
}
?>
    <main>
        <div class="container">
            <div class="section">
                <div class="row">
                    <div class="col s12 m12 l8  offset-l2">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Change Password</span>
                                <div class="row"><?= $ErrorMsg ?></div>
                                <div class="row">
                                    <form method="post" class="col s12">
                                        <div class="row margin-bottom-none">
                                            <div class="input-field col s12">
                                                <i class="material-icons prefix">lock</i>
                                                <input id="NewPassword" name="NewPassword" value="<?= $NewPassword ?>"
                                                       type="password" class="validate">
                                                <label for="NewPassword">New Password</label>
                                                <span class="helper-text red-text"><?= $NewPasswordErr ?></span>
                                            </div>
                                            <div class="input-field col s12">
                                                <i class="material-icons prefix">lock</i>
                                                <input id="confirmPassword" name="ConfirmNewPassword"
                                                       value="<?= $ConfirmNewPassword ?>" type="password"
                                                       class="validate">
                                                <label for="confirmPassword">Confirm New Password</label>
                                                <span class="helper-text red-text"><?= $ConfirmNewPasswordErr ?></span>
                                            </div>
                                            <div class="input-field col s12">
                                                <button class="btn waves-effect waves-light" type="submit"
                                                        name="resetPassword">Reset
                                                </button>
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
<?php require_once "includes/footer.php" ?>