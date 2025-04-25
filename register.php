<?php require_once "includes/header.php" ?>

<?php
/*
    Created by : Priyanka Khadilkar
    This file is to register for students users only
*/
require_once "vendor/autoload.php";

$fNameErr = "";
$lNameErr = "";
$emailErr = "";
$passwordErr = "";
$confirmPasswordErr = "";
$phoneNumberErr = "";
$dateOfBirthErr = "";
$genderErr = "";
$firstname = "";
$lastname = "";
$email = "";
$password = "";
$confirmPassword = "";
$phoneNumber = "";
$dateOfBirth = "";
$gender = "";
$userExistMsg = "";


//Function to validate all inputs
function validateInputs($firstname, $lastname, $email, $password, $confirmPassword, $phoneNumber, $dateOfBirth, $gender)
{
    Global $fNameErr, $lNameErr, $emailErr, $passwordErr, $confirmPasswordErr, $phoneNumberErr, $dateOfBirthErr, $genderErr;
    $isFirstNameValid = false;
    $isLastNameValid = false;
    $isEmailValid = false;
    $isPasswordValid = false;
    $isConfirmPasswordValid = false;
    $isPhoneNumberValid = false;
    $isDateOfBirthValid = false;
    $isGenderValid = false;
    $phoneNumberPattern = "/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/";

    if ($firstname == "") {
        $fNameErr = "Please enter first name.";
    } else {
        $fNameErr = "";
        $isFirstNameValid = true;
    }

    if ($lastname == "") {
        $lNameErr = "Please enter last name.";
    } else {
        $lNameErr = "";
        $isLastNameValid = true;
    }

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

    if ($confirmPassword == "") {
        $confirmPasswordErr = "Please enter confirm password";
    } else if ($password != $confirmPassword) {
        $confirmPasswordErr = "Password does not match.";
    } else {
        $confirmPasswordErr = "";
        $isConfirmPasswordValid = true;
    }

    if ($phoneNumber == "") {
        $phoneNumberErr = "Please enter your contact number.";
    } else if (!preg_match($phoneNumberPattern, $phoneNumber)) {
        $phoneNumberErr = "Please enter valid contact number.";
    } else {
        $phoneNumberErr = "";
        $isPhoneNumberValid = true;
    }

    if ($dateOfBirth == "") {
        $dateOfBirthErr = "Please select date of birth";
    } else {
        $dateOfBirthErr = "";
        $isDateOfBirthValid = true;
    }

    if ($gender == "") {
        $genderErr = "Please select your gender";
    } else {
        $isGenderValid = true;
        $genderErr = "";
    }

    if ($isFirstNameValid == true && $isLastNameValid == true && $isEmailValid == true && $isPasswordValid == true && $isConfirmPasswordValid == true
        && $isPhoneNumberValid == true && $isDateOfBirthValid == true && $isGenderValid == true) {
        return true;
    } else {
        return false;
    }


}

//When user clicks "Register" button
if (isset($_POST["registerBtn"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $phoneNumber = $_POST["phoneNumber"];
    $dateOfBirth = $_POST["dateOfBirth"];
    if (isset($_POST["Gender"])) {
        $gender = $_POST["Gender"];
    }

    $isFormValid = validateInputs($firstname, $lastname, $email, $password, $confirmPassword, $phoneNumber, $dateOfBirth, $gender);

    //If form is valid then allow user to register
    if ($isFormValid == true) {
        $userContext = new UserContext();
        $userExist = $userContext->CheckUserExistWithEmail($email);
        if ($userExist == null) {
            $roleId = UserRoles::Student;
            //Encrypt Password
            $encryptPassword = password_hash($confirmPassword, PASSWORD_DEFAULT);

            $user = new User($firstname, $lastname, $email, $encryptPassword, $phoneNumber, $dateOfBirth, $gender, $roleId);
            $userContext = new UserContext();
            $userAdded = $userContext->Add($user);
            if ($userAdded) {
                header('Location: login.php');
            } else {
                echo "problem inserting data";
            }
        } else {
            $userExistMsg = "User is already exists with same email id.Please select another email id.";
        }
    }
}

?>
    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 m12 l8  offset-l2">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Register</span>
                            <div class="row">
                                <span class="red-text"><?= $userExistMsg ?></span>
                            </div>
                            <div class="row">

                                <form method="post" class="col s12">
                                    <div class="row margin-bottom-none">
                                        <div class="input-field col s12 m12 l6">
                                            <i class="material-icons prefix">account_circle</i>
                                            <input id="firstname" value="<?= $firstname ?>" name="firstname" type="text"
                                                   class="validate">
                                            <label for="firstname">Firstname</label>
                                            <span class="helper-text red-text"><?= $fNameErr ?></span>
                                        </div>
                                        <div class="input-field col s12 m12 l6">
                                            <i class="material-icons prefix">account_circle</i>
                                            <input id="lastname" value="<?= $lastname ?>" name="lastname" type="text"
                                                   class="validate">
                                            <label for="lastname">Lastname</label>
                                            <span class="helper-text red-text"><?= $lNameErr ?></span>
                                        </div>
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">mail</i>
                                            <input id="email" value="<?= $email ?>" name="email" type="email"
                                                   class="validate">
                                            <label for="email">Email</label>
                                            <span class="helper-text red-text"><?= $emailErr ?></span>
                                        </div>
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">lock</i>
                                            <input id="password" value="<?= $password ?>" name="password"
                                                   type="password" class="validate">
                                            <label for="password">Password</label>
                                            <span class="helper-text red-text"><?= $passwordErr ?></span>
                                        </div>
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">lock</i>
                                            <input id="confirmPassword" value="<?= $confirmPassword ?>"
                                                   name="confirmPassword" type="password"
                                                   class="validate">
                                            <label for="confirmPassword">Confirm Password</label>
                                            <span class="helper-text red-text"><?= $confirmPasswordErr ?></span>
                                        </div>
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">phone</i>
                                            <input id="contact" value="<?= $phoneNumber ?>" name="phoneNumber"
                                                   type="text" class="validate">
                                            <label for="contact">Contact</label>
                                            <span class="helper-text red-text"><?= $phoneNumberErr ?></span>
                                        </div>
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">date_range</i>
                                            <input id="dateOfBirth" value="<?= $dateOfBirth ?>" name="dateOfBirth"
                                                   type="text"
                                                   class="validate datepicker registerdatepicker">
                                            <label for="dateOfBirth">Date of Birth</label>
                                            <span class="helper-text red-text"><?= $dateOfBirthErr ?></span>
                                        </div>
                                        <div class="input-field col s12 m12 l12">
                                            <i class="material-icons prefix">wc</i>
                                            <select value="<?= $gender ?>" name="Gender">
                                                <option value="" disabled selected>Select Gender</option>
                                                <option value="1" <?php if (isset($gender) && $gender == "1") echo "selected"; ?>>Male</option>
                                                <option value="2" <?php if (isset($gender) && $gender == "2") echo "selected"; ?>>Female</option>
                                                <option value="2" <?php if (isset($gender) && $gender == "3") echo "selected"; ?>>Other</option>
                                            </select>
                                            <label>Gender</label>
                                            <span class="helper-text red-text"><?= $genderErr ?></span>
                                        </div>
                                        <div class="input-field col s12">
                                            <button class="btn waves-effect waves-light" type="submit"
                                                    name="registerBtn">Register
                                                <i class="material-icons right">person</i>
                                            </button>
                                        </div>
                                        <div class="col s12">
                                            <a href="login.php" class="right">Already Registered? Log in!</a>
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