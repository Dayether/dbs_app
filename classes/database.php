<?php

class database{


    function opencon(): PDO{
        return new PDO(
            dsn: 'mysql:host=localhost;
            dbname=dbs_app',
            username: 'root',
            password: '');
    }
    function signupUser($firstname, $lastname, $username, $password){
        $con = $this->opencon();
        try{
// Insert into Users Table
            $con->beginTransaction();
            $stmt = $con->prepare("INSERT INTO Admin (admin_FN, admin_LN, admin_username, admin_password) VALUES(?, ?, ?, ?)");
            $stmt->execute([$firstname, $lastname, $username, $password]);
            $userID = $con->lastInsertID();
            $con->commit();
            return $userID;
        }catch(PDOException $e){
            $con->rollBack();
            return false;
        }
    }

   function isUsernameExists($username) {
$con = $this->opencon();
$stmt = $con->prepare("SELECT COUNT(*) FROM Admin WHERE admin_username = ?");
$stmt->execute([$username]);
$count = $stmt->fetchColumn();
return $count > 0;


   }
}