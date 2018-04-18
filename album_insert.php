<script src="homepage_assets/js/vendor/jquery-1.11.2.min.js"></script>

<script>
    // json file artist insert
    $(document).ready(function() {
        var base_dir = "http://localhost:8090/IST210/fake-spotify/album_assets/json_files/";
        let json_array = ['vevo_trending.json', 'vevo_country.json', 'vevo_electronic.json',
            'vevo_hip-hop.json', 'vevo_latino.json', 'vevo_pop.json', 'vevo_rbsoul.json', 'vevo_rock.json'];
        let entry =[];
        for (var i=0; i<json_array.length; i++) {
            $.getJSON(base_dir + json_array[i], function (json) {
                $.each(json, function(i, item)
                {
                    var path = "http://ws.audioscrobbler.com/2.0/?method=track.getInfo&api_key=e4352f4de078644ba4e562e03f3b23d3&artist=";
                    path +=item[0];
                    path +="&track=";
                    path +=item[1];
                    path +="&format=json";
                    $.getJSON(path, function(json) {
                        $.each(json.track.album, function(i, album) {
                            if (i==='title') {
                                entry.push(item[0], album);
                                var path = "http://ws.audioscrobbler.com/2.0/?method=album.getInfo&api_key=e4352f4de078644ba4e562e03f3b23d3&artist=";
                                path +=item[0];
                                path += "&album=";
                                path +=album;
                                path += "&format=json";
                                console.log(path);
                                $.getJSON(path, function (json) {
                                    $.each(json.album.image, function(i, img) {
                                        if (i===3) {
                                            entry.push(img['#text']);
                                        }
                                    });
                                    $.each(json.album.wiki, function(i, bio) {
                                        if (i==='summary'){
                                            entry.push(bio);
                                            console.log(entry);
                                            $.post("includes/handlers/insert_album.php", {data: entry})
                                                .done(function (response) {
                                                    console.log(response);
                                                });
                                            entry=[];
                                        }
                                    });
                                });

                            }
                        });

                    });

                });

            });
        }
    });
</script>

<!---->
<script>
    var genre = ["pop", "hip-hop", "electronic","country","rock","randb","latino"];
    var url=[];

    genre.forEach(
        function (value) {
            url.push("http://ws.audioscrobbler.com/2.0/?method=tag.gettopalbums&tag=" + value + "&api_key=e4352f4de078644ba4e562e03f3b23d3&format=json");
        });

    $(document).ready(function () {
        for (let i=0;i<url.length;i++) {
            $.getJSON(url[i], function (json) {
                var entry = [];
                $.each(json.albums.album, function (i, item) {
                    var path = "http://ws.audioscrobbler.com/2.0/?method=album.getInfo&api_key=e4352f4de078644ba4e562e03f3b23d3&artist=";
                    path +=item.artist.name;
                    path += "&album=";
                    path +=item.name;
                    path += "&format=json";
                    $.getJSON(path, function (json) {
                        $.each(json.album.wiki, function(i, bio) {
                            if (i==='summary'){
                                entry = [item.artist.name,item.name, item.image[3]['#text'], bio];
                                //console.log(entry);
                                $.post("includes/handlers/insert_album.php", {data: entry})
                                    .done(function (response) {
                                        console.log(response);
                                    });
                            }
                        });
                    });
                });


            });
        }

    });
</script>