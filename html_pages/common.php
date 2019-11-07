<?php

session_start();

function make_header($title)
{
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="../styles/default_style.css">
        <title><?php echo $title; ?></title>
    </head>
    <body>
    <?php
}

function make_footer()
{
    ?>
    <footer>&copy; FIT 2018</footer>
    </body>
    </html>
    <?php
}

?>

<?php
function make_menu($active_elemnt)
{
    ?>
    <div class="topnav">
        <a
            <?php if ($active_elemnt == "home") echo 'class="active"'; ?>
                href="home.php">Home</a>
        <?php
        if (isset($_SESSION['user'])) {
            ?>
            <a
                <?php if ($active_elemnt == "profile") echo 'class="active"'; ?>
                    href="edit_profile.php">My profile</a>

            <a
                    href="logout.php">Log Out</a>
            <?php
        } else {
            ?>
            <a
                <?php if ($active_elemnt == "login") echo 'class="active"'; ?>
                    href="login_page.php">Log In</a>
            <?php
        }
        ?>

    </div>
    <?php
}

?>


<?php
function redirect($dest)
{
    $script = $_SERVER["PHP_SELF"];
//    if (strpos($dest, '/')) {
//        $path = $dest;
//    } else {
        $path = substr($script, 0, strrpos($script, '/')) . "/$dest";
//    }
    $name = $_SERVER["SERVER_NAME"];
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: http://$name$path");
}

function require_user()
{
    if (!isset($_SESSION['user'])) {
        echo "<h1>Access forbidden</h1>";
        make_footer();
        exit();
    }
}
