<?php
$myFile = "/opt/lampp/htdocs/IST210/fake-spotify/album_assets/json_files/artists.json";
$fh = fopen($myFile, 'a');
$stringData = $_POST["data"];
fwrite($fh, json_encode($stringData, JSON_PRETTY_PRINT));
fwrite($fh, ",");
fclose($fh);

$sql = "INSERT INTO Songs(title, artist, album, duration, path) VALUES
                      ('$song_title', $artist_id, $album_id, '$duration', '$insert_path')";
mysqli_query($con, $sql);

?>