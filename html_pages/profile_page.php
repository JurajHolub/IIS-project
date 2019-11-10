<?php

require "common.php";
require '../Repositories/UserRepository.php';
require '../Factories/PdoDbConnectionFactory.php';

use Repositories\UserRepository;
use Factories\PdoDbConnectionFactory;

make_header('Edit profile');
require_user();

make_menu('profile');

$user_repository = new UserRepository(new PdoDbConnectionFactory);
$user = $user_repository->getByLogin($_SESSION['user']);
?>
<form action="profile.php" method="post">
    <input type="hidden" name=id" value=<?php echo "\"$user->id\"";?>>
    First name: <input type="text" name="name" value=<?php echo "\"$user->name\""; ?>><br>
    Last name: <input type="text" name="surname" value=<?php echo "\"$user->surname\""; ?>><br>
    Login: <input type="text" name="login" readonly value=<?php echo "\"$user->login\""; ?>><br>
    Email: <input type="text" name="email" value=<?php echo "\"$user->email\""; ?>><br>
    Bank account: <input type="text" name="bank_account" value=<?php echo "\"$user->bank_account\""; ?>><br>
    Old password: <input type="password" name="password0"><br>
    Enter new password: <input type="password" name="password1"><br>
    Reenter new password: <input type="password" name="password2"><br>
    <input type="submit" value="Submit request">
</form>
<?php
if (isset($_SESSION['password_change']))
{
    if ($_SESSION['password_change'] === true)
    {
        echo "<strong>Password successfuly changed!</strong>";
    }
    else
    {
        echo "<strong>Password does not match!</strong>";
    }
    unset($_SESSION['password_change']);
}
if (isset($_SESSION['profile_update']))
{
    if ($_SESSION['profile_update'] === true)
    {
        echo "<strong>Profile updated!</strong>";
    }
    else
    {
        echo "<strong>User with this login already exist!</strong>";
    }
    unset($_SESSION['profile_update']);
}
?>
</body>
</html>