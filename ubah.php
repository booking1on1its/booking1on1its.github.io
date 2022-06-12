<?php

include "koneksi.php";

if (isset($POST['title'])) {
    
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    
    mysqli_query($koneksi, "UPDATE events set title = '$tittle', start_event = '$start', end_event = '$end'
    WHERE id = '$id' ");

}