<?php

/*function listFolder($path)
{
    //using the opendir function
    $dir_handle = @opendir($path) or die("Unable to open $path");
    
    //Leave only the lastest folder name
    $dirname = end(explode("/", $path));
    
    //display the target folder.

    echo "<li class=\"click\">$dirname</li>";
    echo "<ul>";
    while (false !== ($file = readdir($dir_handle))) 
    {
        if($file!="." && $file!="..")
        {
            if (is_dir($path."/".$file))
            {
                //Display a list of sub folders.
                listFolder($path."/".$file);
                echo "</li>";
			}
			else
			{
			listFiles($path,$file);
			}
		}
	}
		echo "</ul>\n";
		echo "</li>\n";
    
    //closing the directory
    closedir($dir_handle);
}
*/

function listFiles($path) {
	    $dir_handle = @opendir($path) or die("Unable to open $path");
    
    //Leave only the lastest folder name
    $dirname = end(explode("/", $path));
    
    //display the target folder.

//    echo $dirname;
    while (!false == ($file = readdir($dir_handle))) 
    {
        if($file!="." && $file!="..")
        {
            if (is_dir($path."/".$file))
            {
                //Display a list of sub folders.
			}
			else
{
               if (false == is_dir($file)) {
               		
               		echo "$file";
               }

			}
}
}
 
    //closing the directory
    closedir($dir_handle);
}



function createLink($srcdir,$srcfile)
{
$filepath = rawurlencode($srcdir);
$filename = rawurlencode($srcfile);
$fullpathtofile = str_replace("%2F","/",$filepath."/".$filename);

echo '<a href=',$fullpathtofile,'>',$srcfile,'</a>';
}

function listFolder($path)
{
    //using the opendir function
    $dir_handle = @opendir($path) or die("Unable to open $path");
    
    //Leave only the lastest folder name
    $dirname = end(explode("/", $path));
    
    //display the target folder.
echo $dirname;
    while (false !== ($file = readdir($dir_handle))) 
    {
        if($file!="." && $file!="..")
        {
            if (is_dir($path."/".$file))
            {
                //Display a list of sub folders.
               listFolder($path."/".$file);
			}

}
	}
 
    //closing the directory
    closedir($dir_handle);
}

function backupOriginal($file) {
	$backuppath = "/original/" .pathinfo($file, PATHINFO_DIRNAME);
			if(is_dir($backuppath == 'false')) {
			mkdir("c:/wamp/www/original/" .pathinfo($file, PATHINFO_DIRNAME),0777,TRUE);
			}
			rename($file, "c:/wamp/www/original/" .$file);
			}

function displaySpreadsheet($file) {
      $cnx = fopen($file, "r"); 
      echo("<table border='1'>"); // echo the table 
      while (!feof ($cnx)) { // while not end of file 
      $buffer = fgets($cnx); // get contents of file (name) as variable 
      $values = explode(",", $buffer); //explode "," between the values within the  contents 
      echo "<tr>"; 
      for ( $j = 0; $j < count($values); $j++ ) {  // 
      echo("<td>$values[$j]</td>"); 
      } 
      echo"</tr>"; 
      }; 
      echo("</table>"); 
      fclose($cnx); //close filename variable 
}


function convertDocument($file) {
			$path = pathinfo($file, PATHINFO_DIRNAME);
			$command = "soffice --headless -convert-to html:HTML \"$file\"  --outdir \"c:/wamp/www/$path\"";
		exec($command); // Convert file from current format to HTML
		$htmlFilename = pathinfo($file, PATHINFO_DIRNAME). "/" .pathinfo($file, PATHINFO_FILENAME). ".html";
		while (!file_exists($htmlFilename)) {
			
		}
				if(!copy($file, "/original/" .$file)) {echo "file did not copy";}

				header("Location:/editDocument.php?document=$htmlFilename");	
}

		
		?>
