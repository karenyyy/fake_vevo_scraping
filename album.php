<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fake Spotify</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="album_assets/bootstrap/css/bootstrap.css" />
    <!-- boostrap -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="album_assets/animate.css">
    <link rel="stylesheet" href="album_assets/style.css">

</head>
<body>

<?php
if(isset($_GET['artist'])&&isset($_GET['album'])) {
    $artist = $_GET['artist'];
    $artist = str_replace("%C2%A0", " ",$artist);

    $album = $_GET['album'];
    $album = str_replace("%C2%A0", " ",$album);

    $insert_array = array();
    $fp = fopen('album_assets/json_files/recently_searched_album.json', 'a');
    array_push($insert_array, $artist, $album, 'album.php?artist='.$artist.'&album='.$album);
    fwrite($fp, json_encode($insert_array, JSON_PRETTY_PRINT));
    fwrite($fp, ",");
}else{
    header("Location: homepage.php");
}
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=249078091804020&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<!-- Header Starts -->
<div class="navbar-wrapper ">
    <div class="container">

        <div class="navbar navbar-inverse navbar-fixed-top animated fadeInDown" role="navigation" id="top-nav">
            <div class="container">

            </div>
        </div>

    </div>
</div>
<!-- #Header Starts -->







<!-- overlay -->
<div class="container overlay">


    <!-- home banner starts -->
    <div id="home" class="homeinfo">
        <div class="row">
            <div class="col-sm-6 col-xs-12" style="margin-top: -30px">
                <div class="fronttext">
                    <h2 class="bgcolor  animated fadeInUpBig"><span class="glyphicon glyphicon-headphones"></span> <?php echo $album ?></h2><br>
                    <img onclick="window.open('homepage.php')" src="album_assets/images/dj.png" class="graphics hidden-xs  animated fadeInRightBig" alt="dj" style="float: right; margin-top: -200px; margin-right: -580px">
                </div>
            </div>

            <div class="col-sm-5 col-xs-12 col-sm-offset-1">
            </div>

        </div>
    </div>
    <!-- home banner ends -->



    <!-- blockblack -->
    <div class="blockblack" style="margin-top: -20px">

        <!-- About Starts -->
        <div id="about" class="spacer">
            <h3><span class="glyphicon glyphicon-music"></span><?php echo " ".$album?></h3>
            <div class="row">
                <div class="col-lg-4 col-sm-4  col-xs-12" id="album_info">
                </div>
                <div class="col-lg-5 col-sm-8  col-xs-12">
                    <blockquote id="bio" style="font-size: larger" contenteditable="true"></blockquote>
                </div>

            </div>
        </div>
        <!-- About Ends -->

        <div id="about" class="spacer">
            <h3><span class="glyphicon glyphicon-user"></span> <?php echo $artist?></h3>
            <div class="row">
                <div class="col-lg-4 col-sm-4  col-xs-12" id="artist_info">
                </div>
                <div class="col-lg-5 col-sm-8  col-xs-12">
                    <blockquote id="artist_bio" style="font-size: larger" contenteditable="true"></blockquote>
                </div>

            </div>
        </div>


        <script>
            $(document).ready(function() {
                var path = "http://ws.audioscrobbler.com/2.0/?method=album.getInfo&api_key=e4352f4de078644ba4e562e03f3b23d3&artist=";
                path +=<?php echo "'" . $artist . "'"?>;
                path += "&album=";
                path +=<?php echo "'" . $album . "'"?>;
                path += "&format=json";
                console.log(path);
                $.getJSON(path, function (json) {
                    var html = "<img src=\"";
                    $.each(json.album, function (i, item) {
                        if (i === 'image') {
                            html += item[3]['#text'];
                            html += "\"class=\"img-responsive\" />";
                        }
                    });

                    $('#album_info').append(html);
                });


                $.getJSON(path, function(json) {
                    var html = "";

                    $.each(json.album.wiki, function(i, item) {
                        if (i==='summary'){
                            html += item+"<br>"
                        }
                    });

                    $('#bio').append(html);
                });

                $.getJSON(path, function(json) {
                    var html = "";
                    var html2 = "";
                    $.each(json.album.tracks.track, function(i, item) {
                        if (i<json.album.tracks.track.length/2) {
                            html += "<li><div class=\"row\"><div class=\"col-xs-12 col-sm-3 col-lg-4\"><a style=\"font-size: xx-large; text-align: center\" href=\"";
                            html += item['url'] + "\" data-toggle=\"modal\" data-target=\"#blogdetail\" >";
                            html += item['@attr']['rank'] + "</a></div><div class=\"col-xs-12  col-sm-6 col-lg-5 \"><h5><a target='_blank' style=\"font-size: x-large; text-align: center\" href=\"singles.php?artist=";
                            html += <?php echo "'" . $artist . "'"?>+"&song="+item['name']+"\">";
                            html += item['name'] + "</a></h5><div class=\"col-xs-12  col-sm-3 col-lg-3 date\">";
                            if (item['duration']%60<10) {
                                html += parseInt(item['duration'] / 60) + ":0" + item['duration'] % 60 + "</div></div></li>"
                            }else {
                                html += parseInt(item['duration'] / 60) + ":" + item['duration'] % 60 + "</div></div></li>"
                            }
                        }else {
                            html2 += "<li><div class=\"row\"><div class=\"col-xs-12 col-sm-3 col-lg-4\"><a style=\"font-size: xx-large; text-align: center\" href=\"";
                            html2 += item['url'] + "\" data-toggle=\"modal\" data-target=\"#blogdetail\">";
                            html2 += item['@attr']['rank'] + "</a></div><div class=\"col-xs-12  col-sm-6 col-lg-5 \"><h5><a target='_blank' style=\"font-size: x-large; text-align: center\" href=\"singles.php?artist=";
                            html2 += <?php echo "'" . $artist . "'"?>+"&song="+item['name']+"\">";
                            html2 += item['name'] + "</a></h5><div class=\"col-xs-12  col-sm-3 col-lg-3 date\">";
                            if (item['duration']%60<10) {
                                html2 += parseInt(item['duration'] / 60) + ":0" + item['duration'] % 60 + "</div></div></li>"
                            }else {
                                html2 += parseInt(item['duration'] / 60) + ":" + item['duration'] % 60 + "</div></div></li>"
                            }
                        }
                    });
                    $('#playlist').append(html);
                    $('#playlist2').append(html2);
                });
            });

            $(document).ready(function() {
                var path = "http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=";
                path +=<?php echo "'" . $artist . "'"?>;
                path += "&api_key=e4352f4de078644ba4e562e03f3b23d3&format=json";
                $.getJSON(path, function (json) {
                    var html = "<img src=\"";
                    $.each(json.artist, function (i, item) {
                        if (i === 'image') {
                            html += item[3]['#text'];
                            html += "\"class=\"img-responsive\" />";
                        }
                    });

                    $('#artist_info').append(html);
                });

                $.getJSON(path, function (json) {
                    var html = "";
                    $.each(json.artist.bio, function (i, item) {
                        if (i === 'summary') {
                            html += item+"<br>";
                        }
                    });

                    $('#artist_bio').append(html);
                });

                $.getJSON(path, function(json) {
                    var html = "";
                    $.each(json.artist.similar.artist, function(i, item) {
                        html += "<div class=\"col-sm-3 col-xs-12\"><div class=\"album\">";
                        console.log(i, item['url'], item['name']);
                        html +="<img src=\""+item['image'][3]['#text']+"\" class=\"img-responsive\" alt=\"music theme\">"+"<div class=\"albumdetail\"><a style='font-size: large' target='_blank' href=\"";
                        html +=item['url']+"\">"+item['name'];
                        html +="</div></div></div>"

                    });

                    $('#add').append(html);
                });

            });
        </script>



        <!--Blog Event Starts-->
        <div id="blogevent"  class="blogevent spacer">
            <div class="row">
                <h3><span class="glyphicon glyphicon-play"></span> PlayList</h3>
                <!-- events -->
                <div class="col-md-6 col-xs-12">
                    <div class="events">

                        <ul id="playlist">
                        </ul>
                    </div>
                </div>
                <!-- events -->

                <!-- blog -->
                <div class="col-md-5 col-xs-12">
                    <div class="events">
                        <ul class="row" id="playlist2">


                        </ul>
                    </div>

                </div>
                <!-- blog -->

            </div>
        </div>
        <!--Blog Events Ends-->

        <div id="album" class="releases spacer">
            <h3><span class="glyphicon glyphicon-heart"></span> You Might Also Like...</h3>
            <div class="row" id="add"></div>
        </div>





    </div>
    <!-- blockblack -->

</div>
<!-- overlay -->



<!-- background slider -->
<div id="myCarousel" class="carousel slide hidden-xs">
    <div class="carousel-inner">
        <div class="active item"><img src="album_assets/images/back1.jpg" alt="" /></div>
        <div class="item"><img src="album_assets/images/back2.jpg" alt="" /></div>
        <div class="item"><img src="album_assets/images/back3.jpg" alt="" /></div>
    </div>
</div>
<!-- background slider -->





<script src="http://code.jquery.com/jquery-1.7.1.min.js" type="text/javascript" ></script>

<script src="homepage_assets/js/jquery-ui.custom.min.js"></script>
<!-- boostrap -->
<script src="album_assets/bootstrap/js/bootstrap.js" type="text/javascript" ></script>
<script src="album_assets/scripts/plugins.js" type="text/javascript"></script>
<script src="album_assets/scripts/script.js" type="text/javascript"></script>

</body>
</html>
