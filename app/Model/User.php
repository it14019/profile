<?php

namespace App\Model;

use App\Core\Database;

class User
{
    public static function add()
    {
        if (isset($_POST['submit'])) {

            $today = date('Y-m-d H:i:s');
            $password = $_POST['password'];
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number = preg_match('@[0-9]@', $password);
            $emailTaken = Database::database()->has('users', [
                'e_mail' => $_POST['email']
            ]);

            if ($_POST['name'] != '' && $_POST['email'] != '' && !$emailTaken && $password != '' && $uppercase && $lowercase && $number && strlen($password) >= 8) {
                Database::database()->insert('users',
                    [
                        'name' => $_POST['name'],
                        'e_mail' => $_POST['email'],
                        'password' => $hashedPassword,
                        'created_at' => $today
                    ]);
            }
        }
    }

    public static function upsert()
    {
        session_start();

        $user = Database::database()->select('users', 'id[Int]', [
            'e_mail' => $_POST['email']
        ]);
        $userId = (int)$user[0];

        $hasInformation = Database::database()->has('users_information', [
            'user_id' => $userId
        ]);

        if ($hasInformation) {
            Database::database()->update('users_information', [

                'birthdate' => $_POST['birthdate'],
                'gender' => $_POST['gender'],
                'description' => $_POST['description'],
                'animal' => $_POST['animal'],
            ],
                ['user_id' => $userId]);

        } else {
            Database::database()->insert('users_information', [
                'user_id' => $userId,
                'birthdate' => $_POST['birthdate'],
                'gender' => $_POST['gender'],
                'description' => $_POST['description'],
                'animal' => $_POST['animal'],
            ]);
        }

        Database::database()->update('users', [
            'e_mail' => $_POST['email'],
            'name' => $_POST['name'],
        ],
            ['e_mail' => $_SESSION['email']]);
    }

    public static function name()
    {
        $name = Database::database()->select('users', 'name', [
            'e_mail' => $_SESSION['email']
        ]);
        $userName = $name[0];

        return $userName;
    }

    public static function email()
    {
        $mail = Database::database()->select('users', 'e_mail', [
            'e_mail' => $_SESSION['email']
        ]);
        $userMail = $mail[0];

        return $userMail;
    }

    public static function id()
    {
        $id = Database::database()->select('users', 'id[Int]', [
            'e_mail' => $_SESSION['email']
        ]);
        $userId = $id[0];

        return $userId;
    }

    public static function birthDate()
    {
        $birthDate = Database::database()->select('users_information', 'birthdate', [
            'user_id' => User::id()
        ]);
        $userBirthDate = $birthDate[0];

        return $userBirthDate;
    }

    public static function description()
    {
        $description = Database::database()->select('users_information', 'description', [
            'user_id' => User::id()
        ]);
        $userDescription = $description[0];

        return $userDescription;
    }

    public static function gender()
    {
        $gender = Database::database()->select('users_information', 'gender', [
            'user_id' => User::id()
        ]);
        $userGender = $gender[0];

        return $userGender;
    }

    public static function animal()
    {
        $animal = Database::database()->select('users_information', 'animal', [
            'user_id' => User::id()
        ]);
        $userAnimal = $animal[0];

        return $userAnimal;
    }
}