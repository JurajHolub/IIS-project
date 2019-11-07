<?php
require "common.php";
require 'Repositories/UserRepository.php';
require 'Factories/PdoDbConnectionFactory.php';

use Repositories\UserRepository;
use Factories\PdoDbConnectionFactory;

make_header('Login');
?>

<h1>Login</h1>

<?php
if (isset($_SESSION['user'])) {
    redirect('register_edit_profile.php');
} else {
    if (!isset($_POST['login']) || !isset($_POST['password'])) {
        redirect('login_page.php');
    }
    $login = $_POST['login'];
    $password = $_POST['password'];

    $user_repository = new UserRepository(new PdoDbConnectionFactory);
    $user = $user_repository->getByLogin($login);

    if ($user == null || $user->password != $password) {
        echo "<p>Incorrect login</p>";
    } else {
        $_SESSION['user'] = $user->login;
        redirect('home.php');
    }
}

make_footer();
?>
