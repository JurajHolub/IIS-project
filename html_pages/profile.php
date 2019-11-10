<?php
require "common.php";
require '../Repositories/UserRepository.php';
require '../Factories/PdoDbConnectionFactory.php';

use Repositories\UserRepository;
use Factories\PdoDbConnectionFactory;

$user_repository = new UserRepository(new PdoDbConnectionFactory);
$user = $user_repository->getByLogin($_SESSION['user']);

#TODO refuse change login to already existing
#TODO notify profile update and failure of update

if (empty($_POST['password0']) && empty($_POST['password1']))
{
    $user->login = $_POST['login'];
    $user->name = $_POST['name'];
    $user->surname = $_POST['surname'];
    $user->email = $_POST['email'];
    $user->bank_account = $_POST['bank_account'];
}
else if (!empty($_POST['password0']) && !empty($_POST['password1']) && $_POST['password0'] === $_POST['password1'])
{
    $user->login = $_POST['login'];
    $user->name = $_POST['name'];
    $user->surname = $_POST['surname'];
    $user->email = $_POST['email'];
    $user->bank_account = $_POST['bank_account'];
    $user->password = $_POST['password0'];
}
else
{
    # TODO invalid password change -> notify
}

$user_repository->update($user);
redirect('profile_page.php');

