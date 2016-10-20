<?php
$estCon = new mysqli("foo", "root", "bar", "pi"); // Configure HOST, USER, PASS, DB in this order
if(mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
