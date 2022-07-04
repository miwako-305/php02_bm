<?php
session_start();
$sid = session_id();
echo $sid;
$_SESSION["name"] = "若林美和子";
$_SESSION["age"] = 27;
?>