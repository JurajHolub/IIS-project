<?php
require "common.php";

make_header('Login page');
make_menu('register');

if (isset($_SESSION['user']))
{
    echo "Current user: <strong>" . $_SESSION['user'] . '</strong>  [<a href="logout.php">Logout</a>]';
}
else
{
?>
    <div>
        <form action="register.php" method="post">
            <p>Login</p>
            <input type="text" name="login" placeholder="Enter Login"required>
            <p>Name</p>
            <input type="text" name="name" placeholder="Enter Name">
            <p>Surname</p>
            <input type="text" name="surname" placeholder="Enter Surname">
            <p>Email</p>
            <input type="text" name="email" placeholder="Enter email"required>
            <p>Bank account</p>
            <input type="text" name="bank" placeholder="Enter bank account">
            <p>Password</p>
            <input type="password" name="password0" placeholder="Enter Password"required>
            <br>
            <input type="password" name="password1" placeholder="Repeat Password"required>
            <br>
            <input type="submit" value="Register"/>
        </form>
    </div>
<?php
}?>

</body>
