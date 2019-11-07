<?php
require "common.php";

make_header('User profile');

require_user();

make_menu('profile');

?>

<table>
    <tr>
        <th align="left">Name</th>
        <td>Václav</td>
    </tr>
    <tr>
        <th align="left">Surname</th>
        <td>Hnipírdo</td>
    </tr>
    <tr>
        <th align="left">Login</th>
        <td>King</td>
    </tr>
    <tr>
        <th align="left">Email</th>
        <td>mojuzasnymail@gmail.com</td>
    </tr>
    <tr>
        <th align="left">Registered</th>
        <td>2019-07-11</td>
    </tr>
    <tr>
        <th align="left">Bank account</th>
        <td>CZ6508000000192000145399</td>
    </tr>
</table>
<h3>Products:</h3>
<ul>
    <li>Coffee</li>
    <li>Tea</li>
    <li>Milk</li>
</ul>
<br>
<button onclick="location.href='registered_edit_profile.html';">Edit profile</button>
</body>
</html>