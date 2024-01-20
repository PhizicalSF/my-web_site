<?php
session_start();

include "path.php";

unset($_SESSION['login']) ;
unset($_SESSION['email'] );
unset($_SESSION['admin_status']) ;

header('location: ' . BASE_URL);