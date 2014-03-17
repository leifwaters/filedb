<?php
$file = $_GET["document"];
?>
<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="/ckeditor/ckeditor.js"></script>
<script src="/ckeditor/adapters/jquery.js"></script>
<body>
	<form action="/bin/posteddata.php" method="post">
		<textarea cols="80" id="editor1" name="editor1" height="100%">

		<?php

/*if(isset($file)) {
		$ext = pathinfo($file, PATHINFO_EXTENSION);
		$path = pathinfo($file, PATHINFO_DIRNAME);

		if($ext == ".html") {
		
*/			echo file_get_contents($file);
/*		}
	
		else
	
		{
			$command = "soffice --headless -convert-to html:HTML \"$file\"  --outdir \"c:/wamp/www/$path\"";
			echo $file;
			exec($command);
		
			/*$backuppath = "/documents/original/" .pathinfo($file, PATHINFO_DIRNAME);
			if(!is_dir($backuppath)) {
			mkdir("c:/wamp/www/documents/original/" .pathinfo($file, PATHINFO_DIRNAME),0777,TRUE);
			}
			rename($file, "c:/wamp/www/documents/original/" .$path. "/");
		
			$file = pathinfo($file, PATHINFO_DIRNAME). "/" .pathinfo($file, PATHINFO_FILENAME). ".html";
	//	}
	//		else
	//		{
			header('Location:/editDocument.php?document=$file');
			}
	}
			//	}
				

*/			
		?>
		</textarea>
				<script>

			CKEDITOR.replace( 'editor1', {
				fullPage: true,
				allowedContent: true,
				extraPlugins: 'wysiwygarea'
			});
			CKEDITOR.on('instanceReady',
      function( evt )
      {
         var editor = evt.editor;
         //editor.execCommand('maximize');
      });

		</script>
	</form>
</body>
