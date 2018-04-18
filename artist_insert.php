
<script src="homepage_assets/js/vendor/jquery-1.11.2.min.js"></script>

<?php

?>

<!--<script>-->
<!--    // top artist insert-->
<!--$(document).ready(function() {-->
<!--    $.getJSON("http://ws.audioscrobbler.com/2.0/?method=chart.gettopartists&limit=100&api_key=e4352f4de078644ba4e562e03f3b23d3&format=json&callback=?", function(json) {-->
<!--        $.each(json.artists.artist, function(i, item) {-->
<!--            //console.log(item.name, item.url);-->
<!--            var path = "http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=";-->
<!--            path += item.name;-->
<!--            path += "&api_key=e4352f4de078644ba4e562e03f3b23d3&format=json";-->
<!--            $.getJSON(path, function (json) {-->
<!--                $.each(json.artist.bio, function (i, bio) {-->
<!--                    if (i === 'summary') {-->
<!--                        //console.log(item.name, item.image[3]['#text'], bio);-->
<!--                        var entry = [item.name, item.image[3]['#text'], bio];-->
<!--                        $.post("includes/handlers/insert_artist.php", {data: entry})-->
<!--                            .done(function (response) {-->
<!--                                console.log(response);-->
<!--                            })-->
<!--                    }-->
<!--                })-->
<!--            });-->
<!--        });-->
<!--    });-->
<!--    console.log(artist_array);-->
<!--});-->
<!--</script>-->

<!---->
<?php
//include ('includes/config.php');
//$sql = "SELECT * FROM SONG";
//$query = mysqli_query($con, $sql);
//$array=array();
//while ($row= mysqli_fetch_assoc($query)){
//    array_push($array, $row);
//}
//echo json_encode($array);
//$fp = fopen('album_assets/json_files/song.json', 'w');
//fwrite($fp, json_encode($array, JSON_PRETTY_PRINT));
//?>

<?php
$string = file_get_contents("album_assets/json_files/song.json");
$scraped_results = json_decode($string, true);
foreach ($scraped_results as $item) {
    print_r($item);
    echo "<br><br>";
}
?>

<!---->
<!--<script>-->
<!--    // json file artist insert-->
<!--    $(document).ready(function() {-->
<!--        var base_dir = "http://localhost:8090/IST210/fake-spotify/album_assets/json_files/";-->
<!--        // let json_array = ['vevo_trending.json', 'vevo_country.json', 'vevo_electronic.json',-->
<!--        //     'vevo_hip-hop.json', 'vevo_latino.json', 'vevo_pop.json', 'vevo_rbsoul.json', 'vevo_rock.json'];-->
<!--        let json_array = ['null_artist.json'];-->
<!--        let entry =[];-->
<!--        for (var i=0; i<json_array.length; i++) {-->
<!--            $.getJSON(base_dir + json_array[i], function (json) {-->
<!--                $.each(json, function(i, item)-->
<!--                {-->
<!--                    var path = "http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=";-->
<!--                    path += item;-->
<!--                    path += "&api_key=e4352f4de078644ba4e562e03f3b23d3&format=json";-->
<!--                    $.getJSON(path, function (json) {-->
<!--                        entry.push(item);-->
<!--                        $.each(json.artist.image, function (i, info) {-->
<!--                            if (i === 3) {-->
<!--                                var image = info['#text'];-->
<!--                                entry.push(image);-->
<!--                            }-->
<!---->
<!--                        });-->
<!--                        $.each(json.artist.bio, function (i, info) {-->
<!--                            if (i === 'summary') {-->
<!--                                entry.push(info)-->
<!--                            }-->
<!--                        });-->
<!--                        //console.log(entry);-->
<!--                        $.post("includes/handlers/insert_artist.php", {data: entry})-->
<!--                            .done(function (response) {-->
<!--                                console.log(response);-->
<!--                            });-->
<!--                        entry = []-->
<!--                    });-->
<!---->
<!--                });-->
<!---->
<!--            });-->
<!--        }-->
<!--    });-->
<!--</script>-->




<!---->
<!--<script>-->
<!--    var genre = ["pop", "hip-hop", "electronic","country","rock","randb","latino"];-->
<!--    var url=[];-->
<!---->
<!--    genre.forEach(-->
<!--        function (value) {-->
<!--            url.push("http://ws.audioscrobbler.com/2.0/?method=tag.gettopalbums&tag=" + value + "&api_key=e4352f4de078644ba4e562e03f3b23d3&format=json");-->
<!---->
<!--        });-->
<!---->
<!--    $(document).ready(function () {-->
<!--        for (let i=0;i<url.length;i++) {-->
<!--            $.getJSON(url[i], function (json) {-->
<!--                $.each(json.albums.album, function (i, item) {-->
<!--                    //console.log(i, item.artist.name, item.image[3]['#text']);-->
<!--                    var path = "http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=";-->
<!--                    path += item.artist.name;-->
<!--                    path += "&api_key=e4352f4de078644ba4e562e03f3b23d3&format=json";-->
<!--                    $.getJSON(path, function (json) {-->
<!--                        $.each(json.artist.bio, function (i, bio) {-->
<!--                            if (i === 'summary') {-->
<!--                                //console.log(item.name, item.image[3]['#text'], bio);-->
<!--                                var entry = [item.artist.name, item.image[3]['#text'], bio];-->
<!--                                //console.log(entry);-->
<!--                                $.post("includes/handlers/insert_artist.php", {data: entry})-->
<!--                                    .done(function (response) {-->
<!--                                        console.log(response);-->
<!--                                    });-->
<!--                            }-->
<!--                        })-->
<!--                    });-->
<!--                });-->
<!---->
<!--            });-->
<!--        }-->
<!---->
<!--    });-->
<!--</script>-->