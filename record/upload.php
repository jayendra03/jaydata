<?php

//echo "<pre>"; print_r($_SERVER); die("hji");

mysql_connect('localhost','root','');
mysql_select_db('record');

foreach(array('video', 'audio') as $type) {
    if (isset($_FILES["${type}-blob"])) {

        $fileName = $_POST["${type}-filename"];
        $uploadDirectory = "uploads/$fileName";
        $upd = $uploadDirectory;
        $date = date("Y-m-d H:i:s");
        
        
        if (!move_uploaded_file($_FILES["${type}-blob"]["tmp_name"], $uploadDirectory)) {
            echo("problem moving uploaded file");
        }
        chmod($uploadDirectory, 0777);
        mysql_query(" INSERT INTO record (`song_id`, `record`, `created_date`) VALUES (1,'$upd','$date')");

        echo($uploadDirectory);
    }
}



 ?>