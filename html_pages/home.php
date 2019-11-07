<?php

require "common.php";

make_header('Home page');

make_menu('home');


?>
<script>
    function orderElems() {
        if (document.getElementById("ordering").value == "asc")
        {
            document.getElementById("ordering").value = "desc";
            document.getElementById("ordering").innerHTML = "&#x2B07;";
        }
        else
        {
            document.getElementById("ordering").value = "asc";
            document.getElementById("ordering").innerHTML = "&#x2B06;";
        }
    }
</script>

<div style="padding-left:16px">
    <input type="text" placeholder="Search..">
    <button>Search</button>
</div>

<div style="padding-left:16px">
    <button type="button" onclick="orderElems()" value="asc" id="ordering">&#x2B06;</button>
    <select>
        <option>Release date</option>
        <option>Update date</option>
        <option>State</option>
        <option>Priority</option>
    </select>
</div>

<table border="1">
    <tr>
        <th>Date</th>
        <th>Priority</th>
        <th>Title</th>
        <th>State</th>
    </tr>
    <tr>
        <td>2019-10-06</td>
        <td align="center">7</td>
        <td><a href="unregistered_ticket_detail.html">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></td>
        <td>in progress</td>
    </tr>
    <tr>
        <td>2019-10-06</td>
        <td align="center">7</td>
        <td><a href="unregistered_ticket_detail.html">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></td>
        <td>in progress</td>
    </tr>
    <tr>
        <td>2019-10-06</td>
        <td align="center">7</td>
        <td><a href="unregistered_ticket_detail.html">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></td>
        <td>in progress</td>
    </tr>
    <tr>
        <td>2019-10-06</td>
        <td align="center">7</td>
        <td><a href="unregistered_ticket_detail.html">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></td>
        <td>in progress</td>
    </tr>
</table>


</body>