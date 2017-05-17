<?php
    if(!isset($_POST['submit'])) {
        $message = 'please enter valid zippyshare url';
    }else {
        $url = $_POST['zippy-url'];


        preg_match_all( "#http:\/\/www(.*?).zippyshare.com\/v\/([a-zA-Z0-9]*)\/file.html#", $url, $matches, PREG_SET_ORDER );
        $www = $matches[1];
        $file = $matches[2];

        print_r($file);

        function get_title($url){
            $str = file_get_contents($url);
            if(strlen($str)>0){
                $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
                preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
                return $title[1];
            }
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

        <form action="index.php" method="post">
            <input type="text" name="zippy-url" >
            <input type="submit" name="submit" value="Check URL">

        <?php 
            if(isset($url)) {
                $title = str_replace("Zippyshare.com - ","",get_title($url));
                $title = str_replace("4clubbers.mp3","",$title);
                $title = str_replace(".mp3","",$title);
                $title = str_replace("[www.4clubbers.com.pl]","",$title);
                echo "<p name='song-title'>" . $title . "</p>";
        ?>

                <input type="submit" name="addMP3" value="Add MP3">

           <?php } ?>
        </form>
    </div>
</body>
</html>