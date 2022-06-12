<?php

include "koneksi.php";

if (isset($POST['title'])) {
    
    $tittle = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    mysqli_query($koneksi, "INSERT into events VALUES ('', '$tittle', '$start', '$end') ");
    

}