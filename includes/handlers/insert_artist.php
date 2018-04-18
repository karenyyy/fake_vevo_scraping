<?php
include ('../config.php');

$artist_info = $_POST["data"];
$artist_name = $artist_info[0];
$artist_pic = $artist_info[1];
$artist_bio = $artist_info[2];
$artist_name = str_replace("'","\\'", $artist_name);
$artist_bio = str_replace("'","\\'", $artist_bio);

echo $artist_name. $artist_pic, $artist_bio;

if (substr($artist_pic, 0, 4) === "http") {
    $sql = "UPDATE ARTIST SET ArtistPicture='$artist_pic', Biography='$artist_bio' WHERE ArtistName='$artist_name'";
    print_r($sql);

    mysqli_query($con, $sql);
}

if (strlen($artist_name)>0 && substr($artist_pic, 0, 4) === "http") {


    $sql = "SELECT ArtistID FROM ARTIST WHERE ArtistName = '$artist_name'";
    print_r($sql);
    $query = mysqli_query($con, $sql);
    $query_count = mysqli_num_rows($query);

    if (!$query || $query_count === 0) {
        $sql = "INSERT INTO ARTIST(ArtistName, Biography, ArtistPicture) VALUES ('$artist_name','$artist_bio', '$artist_pic')";

        print_r($artist_name);
        print_r($sql);
        mysqli_query($con, $sql);
    }
}

?>