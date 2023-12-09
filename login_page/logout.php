<?php
//start the session
require_once '../includes/config_session.inc.php'; 

//unset the data
session_unset();

// destroy the session 
session_destroy();

header('Location: login.php');

exit();