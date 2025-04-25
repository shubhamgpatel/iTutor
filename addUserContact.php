<?php require_once "includes/header.php"?>
<?php
/*
    Created by: Maitri Modi
    This file if for adding the users filing the form of contact us page
*/

    require_once "vendor/autoload.php";
    $ErrorMsg = "";

    // require_once "database/classes/connect.php";
    // require_once "database/classes/ContactContext.php";
    // require_once "database/classes/UserContactContext.php";

    $db = Database::getDb();
    $c = new Contact();
    $contacts = $c->getContact($db);
    $errFound = false;
    foreach($contacts as $contact){
?>
<main>
<div>
    <div class="container contact-container">
        <h2 class="orange-text"><?= $contact->heading?></h2>
        <div class="row">
            <div class="col s12 m12 l8">
                <p class="contact-description"><?= $contact->description?></p>
                <?php
                    $name = $telephone = $email = $subject = $message = "";
                    $nameErr = $telephoneErr = $emailErr = $subjectErr = $messageErr = "";

                    function check_input($input){
                        $input = trim($input);
                        $input = stripslashes($input);
                        $input = htmlspecialchars($input);
                        return $input;

                    }
                    if($_SERVER["REQUEST_METHOD"] == "POST"){

                        if(empty($_POST["name"])){
                            $nameErr = "Name is required";
                            $errFound = true;
                        } else{
                            $name = check_input($_POST["name"]);
                            if(!preg_match("/^[a-zA-Z ]*$/", $name)){
                                $nameErr = "Only letters and white space";
                                $errFound = true;
                            }
                        }

                        if(empty($_POST["telephone"])){
                            $telephoneErr = "Telephone is required";
                            $errFound = true;
                        } else{
                            $telephone = check_input($_POST["telephone"]);
                            if(!preg_match('/[0-9]{3}-[0-9]{3}-[0-9]{4}/', $telephone)){
                                $telephoneErr = "Invalid phone number (111-111-1111)";
                                $errFound = true;
                            }
                        }

                        if(empty($_POST["email"])){
                            $emailErr = "Email is required";
                            $errFound = true;
                        } else{
                            $email = check_input($_POST["email"]);
                            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                $emailErr = "Invalid email format";
                                $errFound = true;
                            }
                        }

                        if(empty($_POST["subject"])){
                            $subjectErr = "Subject is required";
                            $errFound = true;
                        } else{
                            $subject = check_input($_POST["subject"]);
                        }

                        if(empty($_POST["message"])){
                            $messageErr = "Message is required";
                            $errFound = true;
                        } else{
                            $message = check_input($_POST["message"]);
                        }

                        if(!$errFound){
                            $db = Database::getDb();
                            $uc = new UserContact();
                            $user_contact = $uc->addUserContact($name,$telephone,$email,$subject,$message,$db);
                            echo $user_contact;
                            if($user_contact){
                                $emailBody = EmailUtility::ThankUserTemplate($name);
                                $isEmailSent = EmailUtility::SendEmail($email,$name,"iTutor - Contact",$emailBody,true);
                                if($isEmailSent){
                                    $ErrorMsg = "<span class='green-text'>You will be contacted shortly.For updates check your email.</span>";
                                }
                            } else {
                                echo "problem adding user contact";
                            }
                        }
                    }

                   
                ?>
               <div class="card login-card">
                    <div class="card-content">
                        <span class="card-title">Fill this form</span>
                        <?= $ErrorMsg ?>
                        <div class="row">
                            <form class="col s12 contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <div class="row">
                                    <div class="input-field col s12 m12 l6">
                                        <input id="user_name" name="name" value="<?= $name;?>" type="text" class="validate">
                                        <label for="user_name"><?= $contact->user_name_title?></label>
                                        <span class="add-contact-error">* <?php  echo $nameErr;?></span>
                                    </div>
                                    <div class="input-field col s12 m12 l6">
                                        <input id="user_telephone" name="telephone" value="<?= $telephone;?>" type="text" class="validate">
                                        <label for="user_telephone"><?= $contact->user_phone_title?></label>
                                        <span class="add-contact-error">* <?php  echo $telephoneErr;?></span>
                                    </div>
                                    <div class="input-field col s12 m12 l6">
                                        <input id="user_email" name="email" value="<?= $email;?>" type="text" class="validate">
                                        <label for="user_email"><?= $contact->user_email_title?></label>
                                        <span class="add-contact-error">* <?php  echo $emailErr;?></span>
                                    </div>
                                    <div class="input-field col s12 m12 l6">
                                        <input id="subject" name="subject" value="<?= $subject;?>"type="text" class="validate">
                                        <label for="subject"><?= $contact->subject_title?></label>
                                        <span class="add-contact-error">* <?php  echo $subjectErr;?></span>
                                    </div>
                                    <div class="input-field col s12 m12 l6 contact-message">
                                        <input id="message" name="message" value="<?= $message;?>" type="text" class="validate">
                                        <label for="message"><?= $contact->message_title?></label>
                                        <span class="add-contact-error">* <?php  echo $messageErr;?></span>
                                    </div>
                                    <div>
                                        <a class="waves-effect waves-light btn-small add-contact-btn" href="index.php">Cancel</a>
                                        <button class="btn waves-effect waves-light contact-submit" type="submit" name="action">Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m12 l4">
                <div class="contact-basic">
                    <div class="contact-basic-padding">
                        <label class="orange-text"><?= $contact->email_title?></label>
                        <p><?= $contact->email?></p>
                    </div>
                    <div class="contact-basic-padding">
                        <label class="orange-text"><?= $contact->phone_title?></label>
                        <p><?= $contact->phone?></p>
                    </div>
                    <div class="contact-basic-padding">
                        <label class="orange-text"><?= $contact->address_title?> </label>
                        <p><?= $contact->address?></p>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>

    </div>


</div>

</div>
</main>
<?php require_once "includes/footer.php" ?>