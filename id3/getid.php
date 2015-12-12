<?php 
$TextEncoding = 'UTF-8';

require_once('getid3/getid3.php');

// Initialize getID3 engine
$getID3 = new getID3;

$FullFileName = "جايندرا.mp3";

$ThisFileInfo = $getID3->analyze($FullFileName);

getid3_lib::CopyTagsToComments($ThisFileInfo);
echo "<pre>"; print_r($ThisFileInfo); die();

?>