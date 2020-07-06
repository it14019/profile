<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Database;
use App\Model\User;

class ApplicationController
{
    public function show()
    {
        View::show('index.html');
    }

    public function store()
    {
        User::add();
        header('Location: /');
    }

    public function update()
    {
        User::upsert();
        header('Location: /profile/edit');
    }

    public function showEditProfile()
    {
        session_start();

        $userName = User::name();
        $userMail = User::email();
        $userBirthDate = User::birthDate();
        $userDescription = User::description();
        $userGender = User::gender();
        $userAnimal = User::animal();

        View::show('edit-profile.html', [
            'userName' => $userName,
            'userMail' => $userMail,
            'userBirthDate' => $userBirthDate,
            'userDescription' => $userDescription,
            'userGender' => $userGender,
            'userAnimal' => $userAnimal
        ]);
    }

    public function showProfile()
    {
       session_start();

         $_SESSION['email'] = $_POST['email'];

        $name = Database::database()->select('users', 'name', [
            'e_mail' => $_POST['email']
        ]);
        $userName = $name[0];

        $password = Database::database()->select('users', 'password', [
            'e_mail' => $_POST['email']
        ]);
        $userPassword = $password[0];

        if (password_verify($_POST['password'], $userPassword)) {
            View::show('profile.html', [
                'userName' => $userName
            ]);
        } else {
            header('Location: /');
        }
    }

    public function logout()
    {
        session_destroy();
        session_unset();
        header('Location: /');
    }
}
