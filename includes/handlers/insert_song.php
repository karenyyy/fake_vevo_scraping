<?php

include ("../../album_assets/scraping/youtube_scrape.php");
include ('../config.php');


$song_info = $_POST["data"];
$artist_name = $song_info[0];
$song_name = $song_info[1];
$song_cover = $song_info[2];
$song_genre = $song_info[3];

//$song_genre = $song_info[2];
//$album_name = $song_info[3];

$song_name = str_replace("'","''", $song_name);
//$album_name = str_replace("'","''", $album_name);



//$song_url = single_song_scrape(implode("+", explode(" ",$artist_name." ".$song_name)));
//$song_url = "https://www.youtube.com/embed/".explode("v=", $song_url)[1];
//echo $artist_name, $song_name, $song_genre, $album_name;

$sql = "SELECT ArtistID FROM ARTIST WHERE ArtistName = '$artist_name'";
$query = mysqli_query($con, $sql);
$artist_exist = mysqli_num_rows($query);
if ($artist_exist===0){
    $sql = "INSERT INTO ARTIST(ArtistName) VALUES ('$artist_name')";
    //print_r($sql);
    mysqli_query($con, $sql);
}
$sql = "SELECT ArtistID FROM ARTIST WHERE ArtistName = '$artist_name'";
$query = mysqli_query($con, $sql);
$artist_id = mysqli_fetch_array($query);
$artist_id = $artist_id['ArtistID'];


//$sql = "SELECT AlbumID FROM ALBUM WHERE AlbumName = '$album_name'";
//$query = mysqli_query($con, $sql);
//$album_exist = mysqli_num_rows($query);
//if ($album_exist===0){
//    $sql = "INSERT INTO ALBUM(AlbumName) VALUES ('$album_name')";
//    //print_r($sql);
//    mysqli_query($con, $sql);
//}
//$sql = "SELECT AlbumID FROM ALBUM WHERE AlbumName= '$album_name'";
//$query = mysqli_query($con, $sql);
//$album_id = mysqli_fetch_array($query);
//$album_id = $album_id['AlbumID'];


if (strlen($song_name)>0 && strlen($artist_name)>0) {
    $sql = "SELECT SongID FROM SONG WHERE SongTitle = '$song_name'";
    //print_r($sql);
    $query = mysqli_query($con, $sql);
    $query_count = mysqli_num_rows($query);

    if (!$query || $query_count === 0) {
        $sql = "INSERT INTO SONG(SongTitle, Genre, ArtistID, AlbumID, SongCover) VALUES ('$song_name', '$song_genre', '$artist_id', 0, '$song_cover')";
        //print_r($sql);
        //mysqli_query($con, $sql);
    }
}

$sql = "SELECT AlbumID FROM SONG WHERE SongCover IS NULL";
$query = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

    $album_id = $row['AlbumID'];
    echo $album_id;
    $sql = "SELECT AlbumCover FROM ALBUM WHERE AlbumID= $album_id";
    $query = mysqli_query($con, $sql);
    $album_cover = mysqli_fetch_array($query);
    $album_cover = $album_cover['AlbumCover'];
    $sql = "UPDATE SONG SET SongCover='$album_cover' WHERE AlbumID = $album_id";
    print_r($sql);
    mysqli_query($con, $sql);
}



