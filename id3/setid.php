<?php 
$TextEncoding = 'UTF-8';

require_once('getid3/getid3.php');


// Initialize getID3 engine
$getID3 = new getID3;
$getID3->setOption(array('encoding'=>$TextEncoding));

require_once('getid3/write.php');
// Initialize getID3 tag-writing module
$tagwriter = new getid3_writetags;
//$tagwriter->filename = '/path/to/file.mp3';
$tagwriter->filename = 'جايندرا.mp3';

$tagwriter->tagformats = array('id3v1','id3v2.4','id3v2.3');

//$tagwriter->tagformats = array('id3v1');

// set various options (optional)
$tagwriter->overwrite_tags = true;
//$tagwriter->overwrite_tags = false;
$tagwriter->tag_encoding = $TextEncoding;
//$tagwriter->remove_other_tags = true;

// populate data array
$TagData = array(
    'title'         => array('sorav'),
    'artist'        => array('garg'),
    'album'         => array('garg Hits'),
    'year'          => array('2015'),
    'genre'         => array('garg'),
    'comment'       => array('garg!'),
    'track'         => array('01/16'),
);

// $TagData = array();
// $TagData["title"][] = "hhhhhhhhhh";
// $TagData["comment"][] = "comment";

$tagwriter->tag_data = $TagData;

// write tags
if ($tagwriter->WriteTags()) {
    echo 'Successfully wrote tags<br>';
    if (!empty($tagwriter->warnings)) {
        echo 'There were some warnings:<br>'.implode('<br><br>', $tagwriter->warnings);
    }
} else {
    echo 'Failed to write tags!<br>'.implode('<br><br>', $tagwriter->errors);
} 

?>