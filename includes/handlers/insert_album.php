<?php
include ('../config.php');

$album_info = $_POST["data"];
$artist_name = $album_info[0];
$album_name = $album_info[1];
$album_cover = $album_info[2];
$album_bio = $album_info[3];
$artist_name = str_replace("'","\\'", $artist_name);
$album_name = str_replace("'","\\'", $album_name);

echo $artist_name, $album_name;

if (strlen($album_bio)>0) {
    $album_bio = str_replace("'", "\\'", $album_bio);
}

$sql = "SELECT ArtistID FROM ARTIST WHERE ArtistName = '$artist_name'";
$query = mysqli_query($con, $sql);
$artist_exist = mysqli_num_rows($query);
if ($artist_exist===0){
    $sql = "INSERT INTO ARTIST(ArtistName) VALUES ('$artist_name')";
    print_r($sql);
    mysqli_query($con, $sql);
}
$sql = "SELECT ArtistID FROM ARTIST WHERE ArtistName = '$artist_name'";
$query = mysqli_query($con, $sql);
$artist_id = mysqli_fetch_array($query);
$artist_id = $artist_id['ArtistID'];



if (strlen($album_name)>0 && strlen($artist_name)>0 && substr($album_cover, 0, 4) === "http") {
    $sql = "SELECT AlbumID FROM ALBUM WHERE AlbumName = '$album_name'";
    $query = mysqli_query($con, $sql);
    $query_count = mysqli_num_rows($query);

    if (!$query || $query_count === 0) {
        if (strlen($album_bio)===0) {
            $sql = "INSERT INTO ALBUM(ArtistID, AlbumName, AlbumCover) VALUES ($artist_id, '$album_name', '$album_cover')";
        }else{
            $sql = "INSERT INTO ALBUM(ArtistID, AlbumName, Description, AlbumCover) VALUES ($artist_id, '$album_name','$album_bio', '$album_cover')";
        }

        print_r($sql);
        mysqli_query($con, $sql);
    }


}

?>