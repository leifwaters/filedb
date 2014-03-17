<html>
    <head>
        <title>FCKeditor - Sample</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="robots" content="noindex, nofollow">
        <link href="../sample.css" rel="stylesheet" type="text/css" />
        <script src="/ckeditor/ckeditor.js"></script>
<script src="/ckeditor/adapters/jquery.js"></script>
    </head>
    <body>
        <h1>FCKeditor - PHP - Sample 1</h1>
        This sample displays a normal HTML form with an FCKeditor with full features 
        enabled.
        <hr>
        

        
    
        <form action="../../../default.php" method="post" name="test" target="_blank" id="test">
<?php
// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// $oFCKeditor->BasePath = '/FCKeditor/' ;    // '/FCKeditor/' is the default value.
$sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath    = '/ckeditor/' ;
$oFCKeditor->Value        = 'Indhold kommer snart' ;
$oFCKeditor->Create() ;
?>
<? 
$filename = "../../../test.txt"; //or a variable 
$fp = fopen($filename, "w"); 
fwrite($fp, $_REQUEST['FCKeditor1']);   
fclose($fp); 
?>             <br>
            <input name="Submit" type="submit" value="Submit">
    </form>
    </body>
</html>