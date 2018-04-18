<?php
//fetch.php
include ('includes/config.php');

$output = '';
if(isset($_POST["query"])) {
    $search = mysqli_real_escape_string($con, $_POST["query"]);
    //$search = $_POST['query'];
    $query1 = "
  SELECT * FROM ARTIST 
  WHERE ArtistName LIKE '%$search%'
  OR ArtistID IN (SELECT ArtistID FROM ALBUM WHERE AlbumName LIKE '%$search%')
  OR ArtistID IN (SELECT ArtistID FROM SONG WHERE SongTitle LIKE '%$search%')";


    $query2 = "
  SELECT * FROM SONG
  WHERE SongTitle LIKE '%$search%'
    OR Genre LIKE '%$search%'
    OR ArtistID IN (SELECT ArtistID FROM ARTIST WHERE ArtistName LIKE '%$search%')
    OR AlbumID IN (SELECT AlbumID FROM ALBUM WHERE AlbumName LIKE '%$search%')";

    $query3 = "
  SELECT * FROM ALBUM
  WHERE AlbumName LIKE '%$search%'
  OR ArtistID IN (SELECT ArtistID FROM ARTIST WHERE ArtistName LIKE '%$search%')";



    $result1 = mysqli_query($con, $query1);
    if (mysqli_num_rows($result1) > 0) {
        $output .= '
   
  <div class="table-responsive">
   <table class="table table bordered"  style="color: white">
   <tr class="header">
      <th colspan="6"><h2 style="color: white; font-weight: bolder; text-align: center">Artist</h2><span class="fa fa-tasks" style="float: right"></span></th>
    </tr>
    <tr>
     <th>Artist</th>
     <th>ArtistPicture</th>
     <th>Biography</th>
    </tr>
 ';
        while ($row = mysqli_fetch_array($result1)) {
            $output .= '
   <tr>
    <td>' . $row["ArtistName"] . '</td>
    <td>' . '<img src=' . $row["ArtistPicture"] . '>' . '</td>
    <td>' . $row["Biography"] . '</td>
   </tr>
  ';
        }
    }


    $result2 = mysqli_query($con, $query2);


    if (mysqli_num_rows($result2) > 0) {
        $output .= '

  <div class="table-responsive">
   <table class="table table bordered" style="color: white">
    <tr  class="header">
      <th colspan="6"><h2 style="color: white; font-weight: bolder; text-align: center">Song</h2><span class="fa fa-tasks" style="float: right"></span></th>
    </tr>
    <tr>
     <th>Song</th>
     <th>Artist</th>
     <th>Album</th>
     <th>Album/Song Cover</th>
     <th>Genre</th>
    </tr>
 ';
        while ($row = mysqli_fetch_array($result2)) {
            $artist_id = $row['ArtistID'];
            $sql = "SELECT ArtistName FROM ARTIST WHERE ArtistID = $artist_id";
            $artist_name = mysqli_query($con, $sql);
            $artist_name = mysqli_fetch_array($artist_name);
            $artist_name = $artist_name['ArtistName'];

            $album_id = $row['AlbumID'];
            $sql = "SELECT AlbumName FROM ALBUM WHERE AlbumID = $album_id";
            $album_name = mysqli_query($con, $sql);
            $album_name = mysqli_fetch_array($album_name);
            $album_name = $album_name['AlbumName'];

            $song_cover = $row['SongCover'];

            $output .= '
                   <tr>
                    <td>' . $row["SongTitle"] . '</td>
                    <td>' . $artist_name . '</td>
                    <td>' . $album_name . '</td>
                    <td>' . '<img src=' . $song_cover . '>' . '</td>
                    <td>' . $row["Genre"] . '</td>
                   </tr>
  ';
        }
    }

    $result3 = mysqli_query($con, $query3);


    if (mysqli_num_rows($result3) > 0) {
        $output .= '
  <div class="table-responsive">
   <table class="table table bordered" style="color: white">
   <tr  class="header">
      <th colspan="6"><h2 style="color: white; font-weight: bolder; text-align: center">Album</h2><span class="fa fa-tasks" style="float: right"></span></th>
    </tr>
    <tr>
     <th>Album</th>
     <th>Artist</th>
     <th>AlbumCover</th>
     <th>Description</th>
    </tr>
 ';
        while ($row = mysqli_fetch_array($result3)) {
            $artist_id = $row['ArtistID'];
            $sql = "SELECT ArtistName FROM ARTIST WHERE ArtistID = $artist_id";
            $artist_name = mysqli_query($con, $sql);
            $artist_name = mysqli_fetch_array($artist_name);
            $artist_name = $artist_name['ArtistName'];

            $output .= '
                   <tr>
                    <td>' . $row["AlbumName"] . '</td>
                    <td>' . $artist_name . '</td>
                    <td>' . '<img src=' . $row["AlbumCover"] . '>' . '</td>
                    <td>' . $row["Description"] . '</td>
                   </tr>
  ';
        }

    }
    echo $output;
}

?>

<style>
    tr.header
    {
        cursor:pointer;
        font-family: 'Varela Round', sans-serif;
    }
    td {
        font-family: 'Varela Round', sans-serif;
    }

</style>

<link rel="stylesheet" href="homepage_assets/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
<script>
    $('.header').click(function(){
        $(this).nextUntil('tr.header').slideToggle(100, function(){
        });
    });
</script>