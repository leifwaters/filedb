<?php
require_once("bin/functions.php");
$file = $_GET["document"];
?>
<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="/ckeditor/ckeditor.js"></script>
<script src="/ckeditor/adapters/jquery.js"></script>
<body>
	<form action="/bin/posteddata.php" method="post">
<!--	<label for="fileTitle">File Name:</label>
	<input type="text" name="fileTitle" value="Enter File Name"/>
	<input type="hidden" name="editedBy" value="TEST" />
	-->
		<textarea cols="80" id="fileContents" name="fileContents" height="100%">


<?php

if(isset($file)) { echo file_get_contents($file); }
		
		?>
		</textarea>
				<script>

			CKEDITOR.replace( 'fileContents', {
				fullPage: true,
				allowedContent: true,
				extraPlugins: 'wysiwygarea'
			});
			CKEDITOR.on('instanceReady',
      function( evt )
      {
         var editor = evt.editor;
         editor.execCommand('maximize');
      });

		</script>
	</form>
</body>
