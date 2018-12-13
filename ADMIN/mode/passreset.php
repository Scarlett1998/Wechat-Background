<?php
session_destroy();
setcookie("timelive","-1","86400");
include_once "html/passreset.html";
?>