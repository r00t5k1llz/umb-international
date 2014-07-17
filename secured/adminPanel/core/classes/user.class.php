<?php
class Users {
    // Establish a connection with database
    public  $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function userExists($username){

        $query = $this->db->prepare("SELECT COUNT(`id`) FROM `tbl_users` WHERE `username`= ?");
        $query->bindValue(1, $username);

        try{

            $query->execute();
            $rows = $query->fetchColumn();

            if($rows == 1){
                return true;
            }else{
                return false;
            }

        } catch (PDOException $e){
            die($e->getMessage());
        }

    }

    public function emailExists($email) {

        $query = $this->db->prepare("SELECT COUNT(`id`) FROM `tbl_users` WHERE `email`= ?");
        $query->bindValue(1, $email);

        try{

            $query->execute();
            $rows = $query->fetchColumn();

            if($rows == 1){
                return true;
            }else{
                return false;
            }

        } catch (PDOException $e){
            die($e->getMessage());
        }

    }

    public function register($username, $password, $email, $role){

        $time 		= time();
        $ip 		= $_SERVER['REMOTE_ADDR'];
        $email_code = sha1($username + microtime());
        $password   = sha1($password);

        $query 	= $this->db->prepare("INSERT INTO `tbl_users` (`username`, `password`, `email`, `user_level`, `ip`, `time`, `email_code`) VALUES (?, ?, ?, ?, ?, ?, ?) ");

        $query->bindValue(1, $username);
        $query->bindValue(2, $password);
        $query->bindValue(3, $email);
        $query->bindValue(4, $role);
        $query->bindValue(5, $ip);
        $query->bindValue(6, $time);
        $query->bindValue(7, $email_code);

        try{
            $query->execute();

            // mail($email, 'Please activate your account', "Hello " . $username. ",\r\nThank you for registering with us. Please visit the link below so we can activate your account:\r\n\r\nhttp://www.example.com/activate.php?email=" . $email . "&email_code=" . $email_code . "\r\n\r\n-- Example team");
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function AddUser($username, $password, $email, $account_name,  $country, $account_type, $account_number, $balance){

        $time 		= time();
        $ip 		= $_SERVER['REMOTE_ADDR'];
        //$email_code = sha1($username + microtime());
        $password   = sha1($password);

        $query 	= $this->db->prepare("INSERT INTO `tbl_users` (`username`, `password`, `user_level`, `email`, `time`,
        `confirmed`, `ip`, `suspended`, `full_name`, `country`, `account_name`, `account_type`, `account_no`, `balance`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");

        $query->bindValue(1, $username);
        $query->bindValue(2, $password);
        $query->bindValue(3, 1);
        $query->bindValue(4, $email);
        $query->bindValue(5, $time);
        $query->bindValue(6, 1);
        $query->bindValue(7, $ip);
        $query->bindValue(8, 1);
        $query->bindValue(9, $account_name);
        $query->bindValue(10, $country);
        $query->bindValue(11, $account_name);
        $query->bindValue(12, $account_type);
        $query->bindValue(13, $account_number);
        $query->bindValue(14, $balance);

        try{
            $query->execute();

            // mail($email, 'Please activate your account', "Hello " . $username. ",\r\nThank you for registering with us. Please visit the link below so we can activate your account:\r\n\r\nhttp://www.example.com/activate.php?email=" . $email . "&email_code=" . $email_code . "\r\n\r\n-- Example team");
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function updateUser($suspend, $balance, $accept, $id){

        //$h_password   = sha1($password);

        $query 	= $this->db->prepare("UPDATE `tbl_users` SET `suspended` = ?, `balance` = ?, `accept` = ? WHERE `id` = ? ");

        $query->bindValue(1, $suspend);
        $query->bindValue(2, $balance);
        $query->bindValue(3, $accept);
        $query->bindValue(4, $id);

        try{
            $query->execute();
            if($query){
                return true;
            }else{
                return false;
            }

        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function activate($email, $email_code) {

        $query = $this->db->prepare("SELECT COUNT(`id`) FROM `tbl_users` WHERE `email` = ? AND `email_code` = ? AND `confirmed` = ?");

        $query->bindValue(1, $email);
        $query->bindValue(2, $email_code);
        $query->bindValue(3, 0);

        try{

            $query->execute();
            $rows = $query->fetchColumn();

            if($rows == 1){

                $query_2 = $this->db->prepare("UPDATE `tbl_users` SET `confirmed` = ? WHERE `email` = ?");

                $query_2->bindValue(1, 1);
                $query_2->bindValue(2, $email);

                $query_2->execute();
                return true;

            }else{
                return false;
            }

        } catch(PDOException $e){
            die($e->getMessage());
        }

    }


    public function emailConfirmed($username) {

        $query = $this->db->prepare("SELECT COUNT(`id`) FROM `tbl_users` WHERE `username`= ? AND `confirmed` = ?");
        $query->bindValue(1, $username);
        $query->bindValue(2, 1);

        try{

            $query->execute();
            $rows = $query->fetchColumn();

            if($rows == 1){
                return true;
            }else{
                return false;
            }

        } catch(PDOException $e){
            die($e->getMessage());
        }

    }

    public function login($username, $password) {

        $query = $this->db->prepare("SELECT `password`, `id` FROM `tbl_users` WHERE `username` = ?");
        $query->bindValue(1, $username);

        try{

            $query->execute();
            $data 				= $query->fetch();
            $stored_password 	= $data['password'];
            $id   				= $data['id'];

            if($stored_password === sha1($password)){
                return $id;
            }else{
                return false;
            }

        }catch(PDOException $e){
            die($e->getMessage());
        }

    }

    public function userdata($id) {

        $query = $this->db->prepare("SELECT * FROM `tbl_users` WHERE `id`= ?");
        $query->bindValue(1, $id);

        try{

            $query->execute();

            return $query->fetch();

        } catch(PDOException $e){

            die($e->getMessage());
        }

    }

    public function getAllUsers() {

        $query = $this->db->prepare("SELECT * FROM `tbl_users` ORDER BY `id` ASC");

        try{
            $query->execute();
        }catch(PDOException $e){
            die($e->getMessage());
        }

        return $query->fetchAll();

    }

    public function getAdmins() {

        $query = $this->db->prepare("SELECT `id`,`username`,`full_name`,`time` FROM `tbl_users` WHERE `user_level`= ? ORDER BY `id` ASC");
        $query->bindValue(1, 5);
        try{
            $query->execute();

        }catch(PDOException $e){
            die($e->getMessage());
        }

        return $query->fetchAll();
    }


    public function accountSuspended($username){
        $query = $this->db->prepare("SELECT COUNT(`id`) FROM `tbl_users` WHERE `username`= ? AND `suspended` = ?");
        $query->bindValue(1, $username);
        $query->bindValue(2, 1);

        try{

            $query->execute();
            $rows = $query->fetchColumn();

            if($rows == 1){
                return true;
            }else{
                return false;
            }

        } catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function isAdmin($username){
        $query = $this->db->prepare("SELECT COUNT(`id`) FROM `tbl_users` WHERE `username`= ? AND `user_level` = ?");
        $query->bindValue(1, $username);
        $query->bindValue(2, 5);

        try{

            $query->execute();
            $rows = $query->fetchColumn();

            if($rows == 1){
                return true;
            }else{
                return false;
            }

        } catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function deleteUser($id){
        $query = $this->db->exec("DELETE FROM `tbl_users` WHERE `id` = $id");

        try{

            if($query){
                //echo $query . " user successfully deleted.";
                // Set for confirmation and redirect user to user list page
                $_SESSION['userDeleted'] = "User successfully deleted.";
                // Redirect user
                header('location: users.php');
            }else{
                echo "User already deleted. You are been redirected...";
                // Redirect user if form is empty
                header('refresh: 5; url=users.php');
            }

        } catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function passPassword($id){
        $sql = "SELECT `password` FROM `tbl_users` WHERE `id` = $id";
        $query = $this->db->query($sql);
        try{

            $fetch = $query->fetch();
            if($fetch){
                return $fetch['password'];
            }else{
                return false;
            }
        }catch (PDOException $e){
            die($e->getMessage());
        }
    }

    public function updatePassword($password,$id){
        //$sql = "UPDATE `tbl_users` SET `password` = $password WHERE `id` = $id";
        $enc_password = sha1($password);
        $query = $this->db->prepare("UPDATE `tbl_users` SET `password` = ? WHERE `id` = ?");
        $query->bindValue(1, $enc_password);
        $query->bindValue(2, $id);

        try{
            $query->execute();
            if($query){
              return true;
            }else {
                return false;
            }
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

}