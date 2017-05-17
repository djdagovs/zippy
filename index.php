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
        

        <?php
            $query = "SELECT * FROM music ORDER BY ID DESC";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($x = mysqli_fetch_assoc($result)) {
                    $id = $x['ID'];
                    $title = $x['title'];
                    $www = $x['www'];
                    $file = $x['file'];
                    $user = $x['added_by']; ?>

                    <div class="mp3">
                        <h1>#<?php echo $id; ?> <?php echo $title; ?></h1>
                        <script type="text/javascript">
                            var zippywww="<?php echo $www; ?>";
                            var zippyfile="<?php echo $file; ?>";
                            var zippytext="#00B9A5";
                            var zippyback="#00B9A5";
                            var zippyplay="#00B9A5";
                            var zippywidth=600;
                            var zippyauto=false;
                            var zippyvol=80;
                            var zippywave = "#00B9A5";
                            var zippyborder = "#00B9A5";
                        </script>
                        <script type="text/javascript" src="http://api.zippyshare.com/api/embed_new.js"></script>
                    </div>
                <?php }
            }
        ?>


    </div>
</body>
</html>