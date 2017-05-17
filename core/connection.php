<?php

    $conn = mysqli_connect('localhost','root', '', 'zippy');

    if(!$conn) {
        echo 'error';
    }