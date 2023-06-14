<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once "$root/lib/File.php";

?>

<header>
  
  <nav>    
    <a class="navlink" href="/" style="height: 48px;display: flex;flex-direction: row;">
      <img src="/resources/images/recycle_bin_empty-4.png">
      <h1 style="margin: auto;"><?=$settings['ProjectName']?></h1>
    </a>
    <div class="dropdown">
      Инструменты
      <div>
        <?php
        foreach ( new DirectoryIterator("$root/tools") as $entry ){
          if ($entry->isDot()) continue; // we are interested only in real entries
          $entryPath = "$root/tools/$entry/";
          // If directory have info.json, it is a valid entry
          if ( file_exists("$entryPath/info.json") ){
            $tool = File::openJson("$entryPath/info.json");
            echo "<a class=\"navlink\" href=\"/tools/$entry\">".$tool['toolname']."</a>";
          }

        }
        ?>
      </div>
    </div>

    <a class="navlink" href="/filebrowser/">Файлы</a>
    <a class="navlink" href="/info" style="right:0"><img src="/resources/images/info.png"></a>



  </nav>
</header>