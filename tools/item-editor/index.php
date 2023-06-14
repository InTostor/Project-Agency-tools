<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once "$root/lib/File.php";

$settings = File::openJson("$root/constants/settings.json");

$actionGroups = File::getAsArray("$root/constants/actions.txt");


$toolSettings = File::openJson(__DIR__."/info.json");

$toolAssociatedStorage = "$root/storage/"."/item-editor/";
if (!file_exists($toolAssociatedStorage))mkdir($toolAssociatedStorage);


if (isset($_GET['file'])){
  $filename = $_GET['file'];
  $item = File::openJson($toolAssociatedStorage.$filename);

}else{
  $item = File::openJson(__DIR__."/baseItem.json");
  $filename = "";
}

if (isset($_POST['filename']) ) {
  if ($_POST['filename'] != $_GET['file']){
    rename($toolAssociatedStorage.$_GET['file'],$toolAssociatedStorage.$_POST['filename']);
  }
  File::stringToFile($toolAssociatedStorage.$_POST['filename'],json_encode($_POST));


  header("Location: ?file=".$_POST['filename']);
}

$fileLink = "/storage/"."/item-editor/"."/".$filename;

$htmlActionGroups = "";


foreach ($actionGroups as $key => $action){
  if (!isset($item['action'][$action])){
    $item['action'][$action] = ["name"=>"","description"=>""];
  }
  $htmlString = "
  <div class=\"row\">
  <input name=\"action[$action]\" value=$action readonly>
  <input type=\"text\" name=\"action[$action][name]\" placeholder=\"Название\"value=\"".$item['action'][$action]['name']."\">
  <input type=\"text\" name=\"action[$action][description]\" placeholder=\"Описание\"value=\"".$item['action'][$action]['description']."\">
  </div>
  ";
  $htmlActionGroups = $htmlActionGroups.$htmlString;
}


include __DIR__."/index.html";