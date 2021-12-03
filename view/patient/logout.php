<?php
require_once "../../model/connect.php";
session_destroy();
header("location:../../index.php");
?>