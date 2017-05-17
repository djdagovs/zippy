<?php
    require 'ZippyshareFile.php';
    include 'core/connection.php';
    function get_title($url){
        $str = file_get_contents($url);
        if(strlen($str)>0){
            $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
            preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
            return $title[1];
        }
    } 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>zippy</title>
    <link rel="stylesheet" href="css/style.css">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">
</head>
<body>
    
    <div class="header">
        TEST
    </div>

    <div class="box">
        <p>Check ZippyShare URL</p>

        <form action="add.php" method="post">
            <input type="text" name="zippy-url" >
            <input type="submit" name="submit" value="Check URL">

        <?php 
            if (isset($_POST['zippy-url'])) {
                $file = new ZippyshareFile($_POST['zippy-url']);
                $www =  $file->getWWW();
                $fileID =  $file->getFile();
                $title = $file->downloadTitle();
                $added_by = "zog";

                $query = "INSERT INTO music (title, www, file, added_by) VALUES ('$title', '$www', '$fileID', '$added_by')";
                $result = mysqli_query($conn, $query);

                if(!$result){
                    echo 'beng';
                }

                echo '<p>' . $title . '</p>';
             } ?>
        </form>
    </div>
</body>
</html>