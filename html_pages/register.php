<?php
require "common.php";
require '../Repositories/UserRepository.php';
require '../Factories/PdoDbConnectionFactory.php';

use Repositories\UserRepository;
use Factories\PdoDbConnectionFactory;
use Models\UserModel;

function get_data($data)
{
    if (isset($_POST[$data]))
    {
        return $_POST[$data];
    }
    else
    {
        return '';
    }
}

$user_repository = new UserRepository(new PdoDbConnectionFactory);
$login = $_POST['login'];
$password0 = $_POST['password0'];
$password1 = $_POST['password1'];
if (!is_null($user_repository->getByLogin($login)))
{
    $_SESSION['registration_fail'] = 'login';
    redirect('register_page.php');
}
else if ($password0 !== $password1)
{
    $_SESSION['registration_fail'] = 'password';
    redirect('register_page.php');
}
else
{
    $user = new UserModel();
    $user->login = $login;
    $user->email = get_data('email');
    $user->password = $password0;
    $user->name = get_data('name');
    $user->surname = get_data('surname');
    $user->bank_account = get_data('bank');

    $user_repository->create($user);

    $_SESSION['user'] = $user->login;
    redirect('home.php');
}

