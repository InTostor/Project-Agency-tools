<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once "$root/lib/File.php";

$settings = File::openJson("$root/constants/settings.json");

include "$root/index.html";