<?php require_once "../includes/adminHeader.php" ?>
<?php
/*
    Created by : Priyanka Khadilkar
*/
require_once "../vendor/autoload.php";

$OldPasswordErr = "";
$NewPasswordErr = "";
$ConfirmNewPasswordErr = "";
$OldPassword = "";
$NewPassword = "";
$ConfirmNewPassword = "";
$ErrorMsg = "";

//get session data
$userId = $sessionData->userId;


//Function to validate all inputs
function validateInputs($oldPassword, $newPassword, $confirmNewPassword)
{
    Global $OldPasswordErr, $NewPasswordErr, $ConfirmNewPasswordErr;
    $isOldPasswordValid = false;
    $isNewPasswordValid = false;
    $isConfirmNewPasswordValid = false;


    if ($oldPassword == "") {
        $OldPasswordErr = "Please enter your old password.";
    } else {
        $OldPasswordErr = "";
        $isOldPasswordValid = true;
    }

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


    if ($isOldPasswordValid == true && $isNewPasswordValid == true && $isConfirmNewPasswordValid == true) {
        return true;
    } else {
        return false;
    }


}

//When user clicks "Update" button
if (isset($_POST["changePassword"])) {
    $OldPassword = $_POST["OldPassword"];
    $NewPassword = $_POST["NewPassword"];
    $ConfirmNewPassword = $_POST["ConfirmNewPassword"];


    $isFormValid = validateInputs($OldPassword, $NewPassword, $ConfirmNewPassword);

    //If form is valid then allow user to register
    if ($isFormValid == true) {
        $userContext = new UserContext();
        $isPasswordValid = $userContext->CheckPasswordIsValid($OldPassword, $userId);
        if ($isPasswordValid) {
            $userContext = new UserContext();
            $EncryptedPassword = password_hash($ConfirmNewPassword, PASSWORD_DEFAULT);
            $userUpdated = $userContext->UpdatePassword($EncryptedPassword, $userId);
            if ($userUpdated) {
                $OldPassword = "";
                $NewPassword = "";
                $ConfirmNewPassword = "";
                $ErrorMsg = "<span class='green-text'>Your Password has been changed successfully.</span>";
            }
        } else {
            $ErrorMsg = "<span class='red-text'>Please Enter correct Old password.</span>";
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
                                                <input id="OldPassword" name="OldPassword" value="<?= $OldPassword ?>"
                                                       type="password" class="validate">
                                                <label for="OldPassword">Old Password</label>
                                                <span class="helper-text red-text"><?= $OldPasswordErr ?></span>
                                            </div>
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
                                                        name="changePassword">Update
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
<?php require_once "../includes/adminFooter.php" ?>