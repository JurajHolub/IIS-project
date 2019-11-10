<?php
require "common.php";

make_header('Login page');
make_menu('login');

if (isset($_SESSION['user']))
{
    echo "Current user: <strong>" . $_SESSION['user'] . '</strong>  [<a href="logout.php">Logout</a>]';
}
else
{
?>
    <div>
        <form action="login.php" method="post">
            <p>Login</p>
            <input type="text" name="login" id="login" placeholder="Enter Login" required>
            <p>Password</p>
            <input type="password" name="password" id="password" placeholder="Enter Password" required>
            <br>
            <input type="submit" value="Log In"/>
        </form>
    </div>
<?php
}?>

</body>