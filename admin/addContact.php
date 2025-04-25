<?php
/* Developer : Maitri Modi
  * This file is for adding contact details,
   I have not put any link to this page as it is added just once.
   After adding the details admin can edit it any time. 
  *
 */ 
        // require_once '../database/classes/connect.php';
        // require_once '../database/classes/ContactContext.php';
        require_once "../vendor/autoload.php";
        $heading = $description = $emailTitle = $email = $phoneTitle = $phone = $addressTitle = $address = $latitude = $longitude = $userNameTitle = $userPhoneTitle = $userEmailTitle = $subjectTitle = $messageTitle = "";
        $headingErr = $descriptionErr = $emailTitleErr = $emailErr = $phoneTitleErr = $phoneErr = $addressTitleErr = $addressErr = $latitudeErr = $longitudeErr = $userNameTitleErr = $userPhoneTitleErr = $userEmailTitleErr = $subjectTitleErr = $messageTitleErr = "";

        $errFound = false;
        if(isset($_POST["add"])){
            if(empty($_POST["heading"])){
                $headingErr = "Heading is required";
                $errFound = true;
            } else {
                $heading = check_input($_POST["heading"]);
            }
            
            if(empty($_POST["description"])){
                $descriptionErr = "Description is required";
                $errFound = true;
            } else {
                $description = check_input($_POST["description"]);
            }

            if(empty($_POST["email-title"])){
                $emailTitleErr = "Email title is required";
                $errFound = true;
            } else {
                $emailTitle = check_input($_POST["email-title"]);
            }

            if(empty($_POST["email"])){
                $emailErr = "Email is required";
                $errFound = true;
            } else {
                $email = check_input($_POST["email"]);
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $emailErr = "Invalid email format";
                }
            }

            if(empty($_POST["phone-title"])){
                $phoneTitleErr = "Phone title is required";
                $errFound = true;
            } else {
                $phoneTitle = check_input($_POST["phone-title"]);
            }

            if(empty($_POST["phone"])){
                $phoneErr = "Phone is required";
                $errFound = true;
            } else {
                $phone = check_input($_POST["phone"]);
                if(!preg_match('/[0-9]{3}-[0-9]{3}-[0-9]{4}/', $phone)){
                    $phoneErr = "Invalid phone number";
                }
            }

            if(empty($_POST["address-title"])){
                $addressTitleErr = "Address title is required";
                $errFound = true;
            } else {
                $addressTitle = check_input($_POST["address-title"]);
            }

            if(empty($_POST["address"])){
                $addressErr = "Address is required";
                $errFound = true;
            } else {
                $address = check_input($_POST["address"]);
            }

            if(empty($_POST["latitude"])){
                $latitudeErr = "Latitude is required";
            } else {
                $latitude = check_input($_POST["latitude"]);
            }
            
            if(empty($_POST["longitude"])){
                $longitudeErr = "Longitude is required";
                $errFound = true;
            } else {
                $longitude = check_input($_POST["longitude"]);
            }

            if(empty($_POST["user-name-title"])){
                $userNameTitleErr = "User name title is required";
                $errFound = true;
            } else {
                $userNameTitle = check_input($_POST["user-name-title"]);
            }

            if(empty($_POST["user-phone-title"])){
                $userPhoneTitleErr = "User phone title is required";
                $errFound = true;
            } else {
                $userPhoneTitle = check_input($_POST["user-phone-title"]);
            }

            if(empty($_POST["user-email-title"])){
                $userEmailTitleErr = "User email title is required";
                $errFound = true;
            } else {
                $userEmailTitle = check_input($_POST["user-email-title"]);
            }

            if(empty($_POST["subject-title"])){
                $subjectTitleErr = "Subject title is required";
                $errFound = true;
            } else {
                $subjectTitle = check_input($_POST["subject-title"]);
            }

            if(empty($_POST["message-title"])){
                $messageTitleErr = "Message title is required";
                $errFound = true;
            } else {
                $messageTitle = check_input($_POST["message-title"]);
            }
            if(!$errFound){
                $db = Database::getDb();
                $c = new Contact();
                $con = $c->addContact($heading,$description,$emailTitle, $email, $phoneTitle,$phone, $addressTitle, $address, $latitude, $longitude, $userNameTitle, $userPhoneTitle, $userEmailTitle, $subjectTitle, $messageTitle, $db);
    
                if($con){
                    header('Location: showContact.php');
                } else {
                    echo "problem adding contact";
                } 
            }
        }
        function check_input($input){
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
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
                                <span class="card-title">Add Contact Information</span>
                                <div class="row">
                                    <form class="col s12" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                        <div class="row margin-bottom-none">
                                            <div>
                                                <input id="add-contact-title" name="heading" value="<?= $heading;?>" type="text"  class="add-contact-title" placeholder="Contact Heading">
                                                <span class="add-contact-error">* <?php  echo $headingErr;?></span>
                                            </div>
                                            <div class="input-field col s12 add-contact-form">
                                                <input id="add-contact-description" name="description" value="<?= $description;?>" type="text" class="validate  add-contact-element-title">
                                                <label for="add-contact-description">Description</label>
                                                <span class="add-contact-error">* <?php  echo $descriptionErr;?></span>
                                            </div>
                                            <div class="input-field col s12 add-contact-form">
                                                <input id="add-contact-email-title" name="email-title" value="<?= $emailTitle;?>" type="text" class="validate  add-contact-element-title">
                                                <label for="add-contact-email-title">Email Title</label>
                                                <span class="add-contact-error">* <?php  echo $emailTitleErr;?></span>
                                            </div>
                                            <div class="input-field col s12 add-contact-form">
                                                <input id="email" name="email" value="<?= $email;?>" type="text" class="validate">
                                                <label for="email">Email</label>
                                                <span class="helper-text" data-error="wrong" data-success="right">example@xyz.com</span>
                                                <span class="add-contact-error">* <?php  echo $emailErr;?></span>
                                            </div>
                                            <div class="input-field col s12 add-contact-form">
                                                <input id="add-contact-phone-title" name="phone-title" value="<?= $phoneTitle;?>" type="text" class="validate  add-contact-element-title">
                                                <label for="add-contact-phone-title">Phone Title</label>
                                                <span class="add-contact-error">* <?php  echo $phoneTitleErr;?></span>
                                            </div>
                                            <div class="input-field col s12 add-contact-form">
                                                <input id="add-contact-phone" name="phone" value="<?= $phone;?>" type="text" class="validate">
                                                <label for="add-contact-phone">Phone</label>
                                                <span class="helper-text" data-error="wrong" data-success="right">111-111-1111</span>
                                                <span class="add-contact-error">* <?php  echo $phoneErr;?></span>
                                            </div>
                                            <div class="input-field col s12 add-contact-form">
                                                <input id="add-contact-address-title" name="address-title" value="<?= $addressTitle;?>" type="text" class="validate  add-contact-element-title">
                                                <label for="add-contact-address-title">Address Title</label>
                                                <span class="add-contact-error">* <?php  echo $addressTitleErr;?></span>
                                            </div>
                                            <div class="input-field col s12 add-contact-form">
                                                <input id="add-contact-address" name="address" value="<?= $address;?>" type="text" class="validate">
                                                <label for="add-contact-address">Address</label>
                                                <span class="add-contact-error">* <?php  echo $addressErr;?></span>
                                            </div>
                                            <div class="input-field col s12 add-contact-form">
                                                <input id="add-contact-latitude" name="latitude" value="<?= $latitude;?>" type="text" class="validate">
                                                <label for="add-contact-latitude">Latitude</label>
                                                <span class="add-contact-error">* <?php  echo $latitudeErr;?></span>
                                            </div>
                                            <div class="input-field col s12 add-contact-form">
                                                <input id="add-contact-longitude" name="longitude" value="<?= $longitude;?>" type="text" class="validate">
                                                <label for="add-contact-longitude">Longitude</label>
                                                <span class="add-contact-error">* <?php  echo $longitudeErr;?></span>
                                            </div>
                                            <div class="input-field col s12 add-contact-form">
                                                <div class="card">
                                                    <div class="card-content">
                                                        <span class="card-title">Form fields</span>
                                                        <div class="row">
                                                            <form class="col s12 contact-form">
                                                                <div class="row">
                                                                    <div class="input-field col s12 m12 l6">
                                                                        <input id="icon_prefix" name="user-name-title" value="<?= $userNameTitle;?>" type="text" class="validate">
                                                                        <label for="icon_prefix">Name Title</label>
                                                                        <span class="add-contact-error">* <?php  echo $userNameTitleErr;?></span>
                                                                    </div>
                                                                    <div class="input-field col s12 m12 l6">
                                                                        <input id="icon_telephone" name="user-phone-title" value="<?= $userPhoneTitle;?>" type="text" class="validate">
                                                                        <label for="icon_telephone">Telephone Title</label>
                                                                        <span class="add-contact-error">* <?php  echo $userPhoneTitleErr;?></span>
                                                                    </div>
                                                                    <div class="input-field col s12 m12 l6">
                                                                        <input id="icon_email" name="user-email-title" value="<?= $userEmailTitle;?>" type="text" class="validate">
                                                                        <label for="icon_email">Email Title</label>
                                                                        <span class="add-contact-error">* <?php  echo $userEmailTitleErr;?></span>
                                                                    </div>
                                                                    <div class="input-field col s12 m12 l6">
                                                                        <input id="icon_message" name="subject-title" value="<?= $subjectTitle;?>" type="text" class="validate">
                                                                        <label for="icon_message">Subject Title</label>
                                                                        <span class="add-contact-error">* <?php  echo $subjectTitleErr;?></span>
                                                                    </div>
                                                                    <div class="input-field col s12 m12 l6 contact-message">
                                                                        <input id="icon_message" name="message-title" value="<?= $messageTitle;?>" type="text" class="validate">
                                                                        <label for="icon_message">Message Title</label>
                                                                        <span class="add-contact-error">* <?php  echo $messageTitleErr;?></span>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-field col s12 add-contact-form">
                                                <div class="add-contact-flex">
                                                    <div>
                                                        <button class="btn-small waves-effect waves-light contact-submit" type="submit" name="add">Add
                                                        </button>
                                                    </div>
                                                    <div>
                                                    <a class="waves-effect waves-light btn-small add-contact-btn" href="showContact.php">Cancel</a>
                                                    </div>
                                                </div> 
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
    </main>
<?php require_once "../includes/adminFooter.php" ?>