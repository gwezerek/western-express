<?php //Feed out icons to the user
$page = $_GET["page"];

function getItemsFromPage($page, $numItems) {

  $offset = ($page - 1) * $numItems;
  $x = 0;


  //icon glob magic
  foreach(glob('../icons/{*.jpg,*.png}', GLOB_BRACE) as $image)  {

      $image = str_replace('../', '/wp-content/plugins/wp-admin-icons/', $image);

      if($x < $offset) {
            $x++;
       }

      elseif($x < $numItems + $offset) {
            echo "<li><img src=\"$image\" alt='Click to set this icon'/></li>";
            $x++;
       }

       else  {
            break;
       }

  }
}


getItemsFromPage($page,448);

?>
