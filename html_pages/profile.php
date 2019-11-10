<?php
require "common.php";
require '../Repositories/UserRepository.php';
require '../Factories/PdoDbConnectionFactory.php';

use Repositories\UserRepository;
use Factories\PdoDbConnectionFactory;

$user_repository = new UserRepository(new PdoDbConnectionFactory);
$user = $user_repository->getByLogin($_SESSION['user']);

if (empty($_POST['password0']) && empty($_POST['password1']) && empty($_POST['password2']))
{
    if (!is_null($user_repository->getByLogin($_POST['login'])))
    {
        $_SESSION['profile_update'] = false;
        redirect('profile_page.php');
    }
    else
    {
        $_SESSION['profile_update'] = true;
    }
    $user->login = $_POST['login'];
    $user->name = $_POST['name'];
    $user->surname = $_POST['surname'];
    $user->email = $_POST['email'];
    $user->bank_account = $_POST['bank_account'];
}
else if (!empty($_POST['password0']) && !empty($_POST['password1'])
    && $_POST['password1'] === $_POST['password2'] && $user->password === $_POST['password0'])
{
    $user->login = $_POST['login'];
    $user->name = $_POST['name'];
    $user->surname = $_POST['surname'];
    $user->email = $_POST['email'];
    $user->bank_account = $_POST['bank_account'];
    $user->password = $_POST['password1'];
    $_SESSION['password_change'] = true;
}
else
{
    $_SESSION['password_change'] = false;
}

$user_repository->update($user);
redirect('profile_page.php');

