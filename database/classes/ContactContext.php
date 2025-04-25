<?php
    class Contact
    {
        public function getContact($db){
            $sql = "SELECT * FROM contact_us";
            $pdostm = $db->prepare($sql);
            $pdostm->execute();

            $contact = $pdostm->fetchAll(PDO::FETCH_OBJ);
            return $contact;
        }

        public function getContactById($id, $db){
            $sql = "SELECT * FROM contact_us where id = :id";
            $pst = $db->prepare($sql);
            $pst->bindParam(':id',$id);
            $pst->execute();
            return  $pst->fetch(PDO::FETCH_OBJ);
        }

        public function addContact($heading, $description, $email_title, $email, $phone_title, $phone, $address_title, $address, $latitude, $longitude, $user_name_title, $user_phone_title, $user_email_title, $subject_title, $message_title, $db){

            $sql = "INSERT INTO contact_us (heading, description, email_title, email, phone_title, phone, address_title, address, latitude, longitude, user_name_title, user_phone_title, user_email_title, subject_title, message_title)
            VALUES (:heading, :description, :email_title, :email, :phone_title, :phone, :address_title, :address, :latitude, :longitude, :user_name_title, :user_phone_title, :user_email_title, :subject_title, :message_title)";

            $pst = $db->prepare($sql);

            $pst->bindParam(':heading', $heading);
            $pst->bindParam(':description', $description);
            $pst->bindParam(':email_title', $email_title);
            $pst->bindParam(':email', $email);
            $pst->bindParam(':phone_title', $phone_title);
            $pst->bindParam(':phone', $phone);
            $pst->bindParam(':address_title', $address_title);
            $pst->bindParam(':address', $address);
            $pst->bindParam(':latitude', $latitude);
            $pst->bindParam(':longitude', $longitude);
            $pst->bindParam(':user_name_title', $user_name_title);
            $pst->bindParam(':user_phone_title', $user_phone_title);
            $pst->bindParam(':user_email_title', $user_email_title);
            $pst->bindParam(':subject_title', $subject_title);
            $pst->bindParam(':message_title', $message_title);

            $count = $pst->execute();
            return $count;
        }

        public function updateContact($id, $heading, $description, $email_title, $email, $phone_title, $phone, $address_title, $address, $latitude, $longitude, $user_name_title, $user_phone_title, $user_email_title, $subject_title, $message_title,$db){
            $sql = "Update contact_us
                    set heading = :heading,
                    description = :description,
                    email_title = :email_title,
                    email = :email,
                    phone_title = :phone_title,
                    phone = :phone,
                    address_title = :address_title,
                    address= :address,
                    latitude = :latitude,
                    longitude = :longitude,
                    user_name_title = :user_name_title,
                    user_phone_title = :user_phone_title,
                    user_email_title = :user_email_title,
                    subject_title = :subject_title,
                    message_title = :message_title
                    WHERE id = :id
            ";

            $pst = $db->prepare($sql);

            $pst->bindParam(':heading', $heading);
            $pst->bindParam(':description', $description);
            $pst->bindParam(':email_title', $email_title);
            $pst->bindParam(':email', $email);
            $pst->bindParam(':phone_title', $phone_title);
            $pst->bindParam(':phone', $phone);
            $pst->bindParam(':address_title', $address_title);
            $pst->bindParam(':address', $address);
            $pst->bindParam(':latitude', $latitude);
            $pst->bindParam(':heading', $heading);
            $pst->bindParam(':longitude', $longitude);
            $pst->bindParam(':user_name_title', $user_name_title);
            $pst->bindParam(':user_phone_title', $user_phone_title);
            $pst->bindParam(':user_email_title', $user_email_title);
            $pst->bindParam(':subject_title', $subject_title);
            $pst->bindParam(':message_title', $message_title);
            $pst->bindParam(':id', $id);

            $count = $pst->execute();

            return $count;
        }        
    }
?>