<?php $icon_dir=opendir("../icons/uploads/");
require( '../../../../wp-load.php' );

$result = mysql_query("SELECT option_value FROM wp_options WHERE option_name = 'siteurl'");

$sitename = mysql_fetch_row($result);

$sitename = $sitename[0];
	
	while ($iconsArray=readdir($icon_dir)) {
		
		
				
		if (!ereg("^\.{1,2}$", $iconsArray )&& !ereg("\.db", $iconsArray)) {
			$icon_str  = "<li><img src='".$sitename."/wp-content/plugins/wp-admin-icons/icons/uploads/".$iconsArray."' class='iconsImage'></li>";
			
			echo $result[0];
			
			echo $icon_str;
		}
	}
	
?>
