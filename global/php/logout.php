<?php

maintain_session();
session_unset();
session_destroy();
header("Location: login.php");
die;