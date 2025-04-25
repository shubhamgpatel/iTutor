<?php

require_once "../vendor/autoload.php";

class UserAdminContext extends Database
{
    public function __construct()
    {
    }

    public function ListAll()
    {
        $sql = "select u.*, g.gender, ur.user_role from users u, gender g, user_roles ur where u.role_id = ur.id AND g.id = u.gender_id";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->execute();

        $userdetails = $pdostm->fetchAll(PDO::FETCH_OBJ);

        return $userdetails;
    }

    public function Add($Userdetail)
    {
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO users (first_name, last_name, email, user_password, phone_number, date_of_birth, gender_id, role_id, created_datetime ) VALUES (:userdetailfirst_name, :userdetaillast_name, :userdetailemail, :userdetailuser_password, :userdetailphone_number, :userdetaildate_of_birth, :userdetailgender_id, :userdetailrole_id, :created_datetime)";

        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':userdetailfirst_name', $Userdetail['first_name']);
        $pdostm->bindParam(':userdetaillast_name', $Userdetail['last_name']);
        $pdostm->bindParam(':userdetailemail', $Userdetail['email']);
        $pdostm->bindParam(':userdetailuser_password', $Userdetail['user_password']);
        $pdostm->bindParam(':userdetailphone_number', $Userdetail['phone_number']);
        $dob = date_create($Userdetail['date_of_birth']);
        $dateFormatted = date_format($dob, "Y-m-d");
        $pdostm->bindParam(':userdetaildate_of_birth', $dateFormatted);
        $pdostm->bindParam(':userdetailgender_id', $Userdetail['gender_id']);
        $pdostm->bindParam(':userdetailrole_id', $Userdetail['role_id']);
        $pdostm->bindParam(':created_datetime', $date);

        $numRowsAffected = $pdostm->execute();
        return $numRowsAffected;
    }

    public function Update($Userdetail, $id)
    {
        // var_dump($id);
        // exit();
        $sql = "Update users set first_name = :userdetailfirst_name, last_name = :userdetaillast_name, email=:userdetailemail, phone_number=:userdetailphone_number, date_of_birth=:userdetaildate_of_birth, gender_id=:userdetailgender_id, role_id=:userdetailrole_id where id= :id";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':userdetailfirst_name', $Userdetail['first_name']);
        $pdostm->bindParam(':userdetaillast_name', $Userdetail['last_name']);
        $pdostm->bindParam(':userdetailemail', $Userdetail['email']);
        $pdostm->bindParam(':userdetailphone_number', $Userdetail['phone_number']);
        $dob = date_create($Userdetail['date_of_birth']);
        $dateFormatted = date_format($dob, "Y-m-d");
        $pdostm->bindParam(':userdetaildate_of_birth', $dateFormatted);
        $pdostm->bindParam(':userdetailgender_id', $Userdetail['gender_id']);
        $pdostm->bindParam(':userdetailrole_id', $Userdetail['role_id']);
        $pdostm->bindParam(':id', $id);
        $numRowsAffected = $pdostm->execute();
        return $numRowsAffected;
    }

    public function Delete($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";

        $pst = parent::getDb()->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;
    }

    public function Get($id)
    {
        $sql = "select * from users where id = :id";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $pdostm->execute();
        $userdetails = $pdostm->fetch(PDO::FETCH_OBJ);
        return $userdetails;
    }

    public function Show($id)
    {
        // var_dump($id);
        // exit();
        $sql = "select u.*, g.gender, ur.user_role from users u, gender g, user_roles ur where u.role_id = ur.id AND g.id = u.gender_id AND u.id = :id";


        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $pdostm->execute();
        $userdetails = $pdostm->fetch(PDO::FETCH_OBJ);
        return $userdetails;
    }
    public function Search($usersearchKey, $userRole)
    {
        $sql = "select u.*, g.gender, ur.user_role from users u, gender g, user_roles ur where u.role_id = ur.id AND g.id = u.gender_id and LOWER(u.first_name) LIKE :usersearchKey";
        if ($userRole != "") {
            $sql .= " AND ur.id = $userRole";
        }
        $pdostm = parent::getDb()->prepare($sql);
        $usersearchKey = '%' . strtolower($usersearchKey) . '%';
        $pdostm->bindParam(':usersearchKey', $usersearchKey);
        $pdostm->execute();

        $userdetails = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $userdetails;
    }
}
