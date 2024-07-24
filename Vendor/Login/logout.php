<?php
session_start();

if(isset($_SESSION["vendor"]))
{
    session_unset();
    session_destroy();
}
header("Location: login.php");