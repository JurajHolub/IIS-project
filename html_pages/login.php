<?php
require "common.php";
require '../Repositories/UserRepository.php';
require '../Factories/PdoDbConnectionFactory.php';

use Repositories\UserRepository;
use Factories\PdoDbConnectionFactory;

if (isset($_SESSION['user']))
{
    redirect('register_edit_profile.php');
}
else
{
    $login = $_POST['login'];
    $password = $_POST['password'];

    $user_repository = new UserRepository(new PdoDbConnectionFactory);
    $user = $user_repository->getByLogin($login);

    if (!is_null($user) && $user->password === $password)
    {
        $_SESSION['user'] = $user->login;
        redirect('home.php');
    }
    else
    {
        $_SESSION['login_attemp'] = true;
        redirect('login_page.php');
    }
}
