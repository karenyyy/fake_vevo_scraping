
<script src="homepage_assets/js/vendor/jquery-1.11.2.min.js"></script>

<!--<script>-->
<!--    // json file artist insert-->
<!--    $(document).ready(function() {-->
<!--        var base_dir = "http://localhost:8090/IST210/fake-spotify/album_assets/json_files/";-->
<!--        let json_array = ['vevo_trending.json', 'vevo_country.json', 'vevo_electronic.json',-->
<!--            'vevo_hip-hop.json', 'vevo_latino.json', 'vevo_pop.json', 'vevo_rbsoul.json', 'vevo_rock.json'];-->
<!--        let entry =[];-->
<!--        for (var i=0; i<json_array.length; i++) {-->
<!--            $.getJSON(base_dir + json_array[i], function (json) {-->
<!--                $.each(json, function(i, item)-->
<!--                {-->
<!---->
<!--                    var path = "http://ws.audioscrobbler.com/2.0/?method=track.getInfo&api_key=e4352f4de078644ba4e562e03f3b23d3&artist=";-->
<!--                    path +=item[0];-->
<!--                    path +="&track=";-->
<!--                    path +=item[1];-->
<!--                    path +="&format=json";-->
<!--                    //console.log(path);-->
<!--                    $.getJSON(path, function(json) {-->
<!--                        entry.push(item[0], item[1], item[2]);-->
<!--                        $.each(json.track.toptags.tag, function(i, tag) {-->
<!--                            if (i===0){-->
<!--                                entry.push(tag['name']);-->
<!--                                //console.log(entry);-->
<!--                                $.post("includes/handlers/insert_song.php", {data: entry})-->
<!--                                    .done(function (response) {-->
<!--                                        console.log(response);-->
<!--                                    });-->
<!--                                entry = []-->
<!--                            }-->
<!--                        });-->
<!---->
<!--                        // $.each(json.track.album, function(i, album) {-->
<!--                        //     if (i==='title') {-->
<!--                        //         //console.log(item);-->
<!--                        //         entry.push(album);-->
<!--                        //         console.log(entry);-->
<!--                        //         $.post("includes/handlers/insert_song.php", {data: entry})-->
<!--                        //             .done(function (response) {-->
<!--                        //                 console.log(response);-->
<!--                        //             });-->
<!--                        //         entry = []-->
<!--                        //     }-->
<!--                        // });-->
<!---->
<!---->
<!--                    });-->
<!---->
<!--                });-->
<!---->
<!--            });-->
<!--        }-->
<!--    });-->
<!--</script>-->


<!--<script>-->
<!--    var genre = ["pop", "hip-hop", "electronic","country","rock","randb","latino"];-->
<!--    var url=[];-->
<!---->
<!--    genre.forEach(-->
<!--        function (value) {-->
<!--            url.push("http://ws.audioscrobbler.com/2.0/?method=tag.gettopalbums&tag=" + value + "&api_key=e4352f4de078644ba4e562e03f3b23d3&format=json");-->
<!--        });-->
<!---->
<!--    // url = ['http://ws.audioscrobbler.com/2.0/?method=tag.gettopalbums&tag=latino&api_key=e4352f4de078644ba4e562e03f3b23d3&format=json'];-->
<!---->
<!--    $(document).ready(function () {-->
<!--        for (let i=0;i<url.length;i++) {-->
<!--            $.getJSON(url[i], function (json) {-->
<!--                var entry = [];-->
<!--                $.each(json.albums.album, function (i, item) {-->
<!--                    var path = "http://ws.audioscrobbler.com/2.0/?method=album.getInfo&api_key=e4352f4de078644ba4e562e03f3b23d3&artist=";-->
<!--                    path += item.artist.name;-->
<!--                    path += "&album=";-->
<!--                    path += item.name;-->
<!--                    path += "&format=json";-->
<!--                    $.getJSON(path, function (json) {-->
<!--                        $.each(json.album.tracks.track, function (i, song) {-->
<!--                            for (i = 0; i < json.album.tracks.track.length; i++) {-->
<!--                                var path = "http://ws.audioscrobbler.com/2.0/?method=track.getInfo&api_key=e4352f4de078644ba4e562e03f3b23d3&artist=";-->
<!--                                path += item.artist.name;-->
<!--                                path += "&track=";-->
<!--                                path += song.name;-->
<!--                                path += "&format=json";-->
<!---->
<!--                                $.getJSON(path, function (json) {-->
<!--                                    $.each(json.track.toptags.tag, function (i, tag) {-->
<!--                                        if (i === 0) {-->
<!--                                            entry.push(item.artist.name, song['name']);-->
<!--                                            entry.push(tag['name']);-->
<!--                                            entry.push(item.name);-->
<!--                                            console.log(entry);-->
<!---->
<!--                                            $.post("includes/handlers/insert_song.php", {data: entry})-->
<!--                                                .done(function (response) {-->
<!--                                                    console.log(response);-->
<!--                                                });-->
<!--                                            entry=[];-->
<!--                                        }-->
<!--                                    });-->
<!---->
<!--                                });-->
<!--                            }-->
<!--                        });-->
<!--                    });-->
<!---->
<!--                });-->
<!--            });-->
<!--        }-->
<!---->
<!--    });-->
<!--</script>-->


<?php
include ('includes/config.php');
$sql = "SELECT * FROM SONG";
$query = mysqli_query($con, $sql);
$array=array();
while ($row= mysqli_fetch_assoc($query)){
    array_push($array, $row);
}
echo json_encode($array);
$fp = fopen('album_assets/json_files/song.json', 'w');
fwrite($fp, json_encode($array, JSON_PRETTY_PRINT));
?>