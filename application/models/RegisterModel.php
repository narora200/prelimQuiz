<?php

class RegisterModel {

    public static function registerNewUser($name, $email, $userName,  $phone) {

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO info (name, email, username, phone, level, datetime) VALUES (:name, :email, :username, :phone, :level, NOW())";
        $query = $database->prepare($sql);
        $query->execute(array(
            'name' => $name,
            ':email' => $email,
            ':username' => $userName,
            ':password' => $phone,
            ':level' => 0,
            ));

        $count =  $query->rowCount();
        if ($count == 1) {
            return true;
        }

        return false;
    }

    public static function formValidation($userName, $email) {
        if (self::validateUserName($userName) AND self::validateEmail($email)) {
            return true;
        }

        return false;
    }

    public static function validateUserName($userName) {
        if (empty($userName)) {
            return false;
        }

        if (!preg_match('/^[a-zA-Z0-9]{2,64}$/', $userName)) {
            return false;
        }

        return true;
    }

    public static function validateEmail($email) {
        if (empty($email)) {
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

}