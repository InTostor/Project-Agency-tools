<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once "$root/lib/File.php";

$settings = File::openJson("$root/constants/settings.json");

if ( isset($_GET['d']) ){
  $dir=$_GET['d'];
}else{
  $dir="";
}

$listOfEntries = "";

foreach (new DirectoryIterator("$root/storage/$dir") as $entry){
  if ($entry->isDot())continue;
  if ($entry->isDir()){
    $listOfEntries = $listOfEntries."<li class=\"Directory\"><a class=\"StorageEntry Directory\" href=\"?d=$dir/$entry\">$entry</a></li>";
  }
  if ($entry->isFile()){
    $listOfEntries = $listOfEntries."
    <li class=\"File\">
    <a class=\"StorageEntry File\" href=\"/storage/$dir/$entry\">$entry</a>
    <a href=\"/tools/$dir?file=$entry\">edit</a>
    </li>";
  }
}

include __DIR__."/index.html";