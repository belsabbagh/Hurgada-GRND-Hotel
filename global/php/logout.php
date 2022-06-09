<?php
include_once "db-functions.php";
maintain_session();
session_unset();
session_destroy();
header("Location: " . REPOSITORY_PAGES_URL . "login/index.php");
die;