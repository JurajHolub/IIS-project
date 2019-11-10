<?php
require "common.php";
require '../Repositories/UserRepository.php';
require '../Factories/PdoDbConnectionFactory.php';

use Repositories\UserRepository;
use Factories\PdoDbConnectionFactory;
use Models\UserModel;

make_header('Login');
?>

<h1>Register</h1>

<?php

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

if (isset($_SESSION['user'])) {
    redirect('register_edit_profile.php');
}
else
{
    $login = $_POST['login'];
    $user_repository = new UserRepository(new PdoDbConnectionFactory);

    if (!is_null($user_repository->getByLogin($login)))
    {
        echo "<p>".$login." already exist!"."</p>";
        redirect('register_page.php');
    }

    $password0 = $_POST['password0'];
    $password1 = $_POST['password1'];

    if ($password0 !== $password1)
    {
        redirect('login_page.php');
    }

    $user = new UserModel();
    $user->login = $login;
    $user->email = get_data('email');
    $user->password = $password0;
    $user->name = get_data('name');
    $user->surname = get_data('surname');
    $user->bank_account = get_data('bank');

    $user_repository->create($user);

    $_SESSION['user'] = $user->login;
    $tmp = $user_repository->getByLogin($login);
    redirect('home.php');
}

make_footer();
?>
