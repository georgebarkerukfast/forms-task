<?php
session_start();
session_destroy();
setcookie("barker_logged_in","",time()-1);
header('Location: index.php');
?>