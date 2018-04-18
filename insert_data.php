<?php
include ('includes/config.php');

$string = file_get_contents("album_assets/json_files/song.json");
$results = json_decode($string, true);
foreach ($results as $item) {
    //echo $item['SongID'], $item['SongTitle'], $item['Genre'], $item['ArtistID'], $item['AlbumID'];
    $songTitle = $item['SongTitle'];
    $Genre = $item['Genre'];
    $ArtistID = $item['ArtistID'];
    $AlbumID = $item['AlbumID'];
    $query = "INSERT INTO SONG(SongTitle, Genre, ArtistID, AlbumID) VALUES ('$songTitle', '$Genre', $ArtistID, $AlbumID)";
    //echo $query;
    //echo "<br><br>";
}


$string = file_get_contents("album_assets/json_files/artist.json");
$results = json_decode($string, true);
foreach ($results as $item) {
    //echo $item['ArtistID'], $item['ArtistName'], $item['Biography'], $item['ArtistPicture'];
    $ArtistName = $item['ArtistName'];
    $Biography = $item['Biography'];
    $ArtistPicture = $item['ArtistPicture'];
    $query = "INSERT INTO ARTIST(ArtistName, Biography, ArtistPicture) VALUES ('$ArtistName', '$Biography', '$ArtistPicture')";
    //echo $query;
    //echo "<br><br>";
}


$string = file_get_contents("album_assets/json_files/album.json");
$results = json_decode($string, true);
foreach ($results as $item) {
    //echo $item['ArtistID'], $item['AlbumName'], $item['Description'], $item['Region'], $item['AlbumCover'];
    $ArtistID = $item['ArtistID'];
    $AlbumName = $item['AlbumName'];
    $Description = $item['Description'];
    $Region = $item['Region'];
    $AlbumCover = $item['AlbumCover'];
    $query = "INSERT INTO ALBUM(ArtistID, AlbumName, Description, Region, AlbumCover) VALUES ($ArtistID, '$AlbumName', '$Description', '$Region', '$AlbumCover')";
    //echo $query;
    //echo "<br><br>";
}



?>