<?php
/*
 *  Developed by : Priyanka Khadilkar
    This file is being used for the all the database communication
   to the user table (CRUD)
*/
require_once "connect.php";
require_once "models/User.php";

class UserContext extends Database
{
    public function __construct()
    {

    }

    public function Add($User)
    {

        $sql = "INSERT INTO users (first_name, last_name, email,user_password,phone_number,date_of_birth,gender_id,role_id,created_datetime) VALUES (:first_name,:last_name,:email,:user_password,:phone_number,:date_of_birth,:gender_id,:role_id,:created_datetime)";
        $date = date('Y-m-d H:i:s');
        $pdostm = parent::getDb()->prepare($sql);

        $firstName = $User->getFirstName();
        $lastName = $User->getLastName();
        $email = $User->getEmail();
        $password = $User->getPassword();
        $phoneNumber = $User->getPhoneNumber();
        $dateOfBirth = $User->getDateOfBirth();
        $genderId = (int)$User->getGenderId();
        $roleId = (int)$User->getRoleId();
        $pdostm->bindParam(':first_name', $firstName);
        $pdostm->bindParam(':last_name', $lastName);
        $pdostm->bindParam(':email', $email);
        $pdostm->bindParam(':user_password', $password);
        $pdostm->bindParam(':phone_number', $phoneNumber);
        $pdostm->bindParam(':date_of_birth', $dateOfBirth);
        $pdostm->bindParam(':gender_id', $genderId);
        $pdostm->bindParam(':role_id', $roleId);
        $pdostm->bindParam(':created_datetime', $date);

        $numRowsAffected = $pdostm->execute();
        return $numRowsAffected;
    }

    public function Get($id)
    {
        $sql = "select * from users where id = :id";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $pdostm->execute();
        $user = $pdostm->fetch(PDO::FETCH_OBJ);
        return $user;
    }

    public function UpdateProfile($User, $id)
    {

        $sql = "Update users set first_name = :first_name, last_name = :last_name , email = :email ,phone_number = :phone_number ,date_of_birth = :date_of_birth ,updated_datetime= :updated_datetime where id= :id";
        $date = date('Y-m-d H:i:s');
        $pdostm = parent::getDb()->prepare($sql);

        $firstName = $User->getFirstName();
        $lastName = $User->getLastName();
        $email = $User->getEmail();
        $phoneNumber = $User->getPhoneNumber();
        $dateOfBirth = $User->getDateOfBirth();

        $pdostm->bindParam(':first_name', $firstName);
        $pdostm->bindParam(':last_name', $lastName);
        $pdostm->bindParam(':email', $email);
        $pdostm->bindParam(':phone_number', $phoneNumber);
        $pdostm->bindParam(':date_of_birth', $dateOfBirth);
        $pdostm->bindParam(':updated_datetime', $date);
        $pdostm->bindParam(':id', $id);

        $numRowsAffected = $pdostm->execute();
        return $numRowsAffected;
    }

    public function UpdatePassword($password, $id)
    {

        $sql = "Update users set user_password = :user_password,updated_datetime = :updated_datetime where id= :id";
        $date = date('Y-m-d H:i:s');
        $pdostm = parent::getDb()->prepare($sql);

        $pdostm->bindParam(':user_password', $password);
        $pdostm->bindParam(':updated_datetime', $date);
        $pdostm->bindParam(':id', $id);

        $numRowsAffected = $pdostm->execute();
        return $numRowsAffected;
    }

    public function UpdateVerificationCode($email, $verificationCode)
    {
        $sql = "Update users set verification_code = :verification_code where LOWER(email)= :email";
        $pdostm = parent::getDb()->prepare($sql);
        $email = strtolower($email);
        $pdostm->bindParam(':verification_code', $verificationCode);
        $pdostm->bindParam(':email', $email);

        $numRowsAffected = $pdostm->execute();
        return $numRowsAffected;
    }

    public function CheckUserExistWithEmailExceptSelf($email, $userId)
    {
        $sql = "select * from users where LOWER(email) = :email AND id !=:id";
        $pdostm = parent::getDb()->prepare($sql);
        $email = strtolower($email);
        $pdostm->bindParam(':email', $email);
        $pdostm->bindParam(':id', $userId);
        $pdostm->execute();
        $user = $pdostm->fetch(PDO::FETCH_OBJ);
        return $user;
    }


    public function CheckUserExistWithEmail($email)
    {
        $sql = "select * from users where LOWER(email) = :email";
        $pdostm = parent::getDb()->prepare($sql);
        $email = strtolower($email);
        $pdostm->bindParam(':email', $email);
        $pdostm->execute();
        $user = $pdostm->fetch(PDO::FETCH_OBJ);
        return $user;
    }

    public function CheckValidUserCredentials($email, $password)
    {
        $sql = "select * from users where LOWER(email) = :email";
        $pdostm = parent::getDb()->prepare($sql);
        $email = strtolower($email);
        $pdostm->bindParam(':email', $email);
        $pdostm->execute();
        $user = $pdostm->fetch(PDO::FETCH_OBJ);
        $returnUser = null;
        if ($user != null) {
            $isValid_password = password_verify($password, $user->user_password);
            if ($isValid_password) {
                $returnUser = $user;
            }
        }
        return $returnUser;
    }

    public function CheckPasswordIsValid($password, $userId)
    {
        $isValidPassword = false;
        $sql = "select user_password from users where id = :id";
        $pdostm = parent::getDb()->prepare($sql);;
        $pdostm->bindParam(':id', $userId);
        $pdostm->execute();
        $user = $pdostm->fetch();
        $userPassword = $user['user_password'];

        if ($userPassword != null && $userPassword != "") {
            $isValidPassword = password_verify($password, $userPassword);

        }
        return $isValidPassword;
    }

    public function CheckVerificationCodeIsValid($verificationCode, $userId)
    {
        $isValidVerificationCode = false;
        $sql = "select verification_code from users where id = :id";
        $pdostm = parent::getDb()->prepare($sql);;
        $pdostm->bindParam(':id', $userId);
        $pdostm->execute();
        $user = $pdostm->fetch();
        $verification_code = $user['verification_code'];

        if ($verification_code != null && $verification_code == $verificationCode) {
            $isValidVerificationCode = true;
        }
        return $isValidVerificationCode;
    }


}