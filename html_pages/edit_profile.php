<?php

require "common.php";
require 'Repositories/UserRepository.php';
require 'Factories/PdoDbConnectionFactory.php';

use Repositories\UserRepository;
use Factories\PdoDbConnectionFactory;

make_header('Edit profile');
require_user();

make_menu('profile');

$user_repository = new UserRepository(new PdoDbConnectionFactory);
$user = $user_repository->getByLogin($_SESSION['user']);
?>
<form>
    <input type="hidden" name=id" value=<?php echo "\"$user->id\"";?>>
    First name: <input type="text" name="name" value=<?php echo "\"$user->name\""; ?>><br>
    Last name: <input type="text" name="surname" value=<?php echo "\"$user->surname\""; ?>><br>
    Login: <input type="text" name="login" readonly value=<?php echo "\"$user->login\""; ?>><br>
    Email: <input type="text" name="email" value=<?php echo "\"$user->email\""; ?>><br>
    <input type="submit" value="Submit request">
</form>
</body>
</html>