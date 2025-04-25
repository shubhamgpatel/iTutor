<?php
    class UserContact
    {
        
        public function getAllUserContacts($db){
            $sql = "SELECT * FROM user_contact";
            $pdostm = $db->prepare($sql);
            $pdostm->execute();

            $user_contact = $pdostm->fetchAll(PDO::FETCH_OBJ);
            return $user_contact;
        }

        public function getUserContactById($id, $db){
            $sql = "SELECT * FROM user_contact where id = :id";
            $pst = $db->prepare($sql);
            $pst->bindParam(':id',$id);
            $pst->execute();
            return  $pst->fetch(PDO::FETCH_OBJ);
        }

        public function addUserContact($name, $phone, $email, $subject, $message, $db){
            $sql = "INSERT INTO user_contact (name, phone,email,subject,message)
            VALUES (:name, :phone, :email, :subject, :message)";

            $pst = $db->prepare($sql);

            $pst->bindParam(':name', $name);
            $pst->bindParam(':phone', $phone);
            $pst->bindParam(':email', $email);
            $pst->bindParam(':subject', $subject);
            $pst->bindParam(':message', $message);
            
            $count = $pst->execute();
            return $count;
        }

        public function deleteUserContact($id,$db){
            $sql = "DELETE FROM user_contact WHERE id = :id";

            $pst = $db->prepare($sql);
            $pst->bindParam(':id',$id);
            $count = $pst->execute();
            return $count;
        }

        public function updateUserContact($id, $name, $phone, $email, $subject, $message ,$db){
            $sql = "UPDATE user_contact
                    set name = :name,
                    phone = :phone,
                    email = :email,
                    subject = :subject,
                    message = :message
                    WHERE id = :id
            ";

            $pst = $db->prepare($sql);

            $pst->bindParam(':name', $name);
            $pst->bindParam(':phone', $phone);
            $pst->bindParam(':email', $email);
            $pst->bindParam(':subject', $subject);
            $pst->bindParam(':message', $message);
            $pst->bindParam(':id', $id);

            $count = $pst->execute();

            return $count;
        }  
        
        public function Search($name,$db)
        {
            $sql = "SELECT * FROM user_contact WHERE name LIKE :name";
            $pst = $db->prepare($sql);
            $searchKey = '%' . strtolower($name) . '%';
            $pst->bindParam(':name',$searchKey);
            $pst->execute();

            $contact = $pst->fetchAll(PDO::FETCH_OBJ);
            return $contact;
        }
    }
?>