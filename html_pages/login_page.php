<?php
require "common.php";

make_header('Login page');
make_menu('login');


if (isset($_SESSION['user'])) {
    echo "Current user: <strong>" . $_SESSION['user'] . '</strong>  [<a href="logout.php">Logout</a>]';
} else {
    ?>
    <div>
        <p>Login</p>
        <form action="login.php" method="post">
            <input type="text" name="login" id="login" placeholder="Enter Login" required>
            <p>Password</p>
            <input type="password" name="password" id="password" placeholder="Enter Password" required>
            <br>
            <input type="submit" value="Log In"/>
            <input type="button" onclick="location.href='unregistered_registration_page.html';" value="Register" disabled/>
        </form>
    </div>

    <?php
}
?>

</body>