<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fake Spotify</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="album_assets/bootstrap/css/bootstrap.css" />
    <!-- boostrap -->

    <link rel="stylesheet" href="album_assets/animate.css">

    <link rel="stylesheet" href="album_assets/style.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="homepage_assets/js/script.js"></script>
    <script src="homepage_assets/js/jquery-ui.custom.min.js"></script>


</head>
<body>



<?php
if(isset($_GET['artist'])&&isset($_GET['song'])) {
    $artist = $_GET['artist'];
    $artist = str_replace("\"", "",$artist);
    $song = $_GET['song'];
    $song = str_replace("\"", "",$song);

}else{
    header("Location: index.php");
}
include("includes/config.php");
include("includes/classes/User.php");
if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = new User($con, $_SESSION['userLoggedIn']);
}
?>

<script>
    $(document).ready(function () {
        var current =[];
        current.push(<?php echo "'".$artist."'"?>);
        current.push(<?php echo "'".$song."'"?>);
        var path = "http://ws.audioscrobbler.com/2.0/?method=track.getInfo&api_key=e4352f4de078644ba4e562e03f3b23d3&artist=";
            path +=<?php echo "'".$artist."'"?>;
            path +="&track=";
            path +=<?php echo "'".$song."'"?>;
            path +="&format=json";
            $.getJSON(path, function(json) {

                $.each(json.track.album, function(i, item) {

                    if (i==='image') {
                        var html = item[3]['#text'];
                        current.push(html);
                        console.log(html, current);


                        $.post("includes/handlers/save_json.php", {data : current})
                            .done(function (response) {
                                console.log(response);
                            })
                    }

                });

            });

    });

</script>



<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=249078091804020&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>






<!-- overlay -->
<div class="container overlay">

    <!-- home banner starts -->
    <div id="home" class="homeinfo">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="fronttext" style="margin-top: -80px;">
                    <h2 class="bgcolor  animated fadeInUpBig" style="float: left"><span class="glyphicon glyphicon-headphones"></span><?php echo " ".$song?></h2><br>
                        <img onclick="window.open('homepage.php')" src="album_assets/images/dj.png" class="graphics hidden-xs  animated fadeInRightBig" alt="dj" style="float: right; margin-top: -150px">
                        <h3 class="bgcolor  animated fadeInUpBig" style="margin-top: 90px; width: 25%; text-align: center"><span class="glyphicon glyphicon-user"></span><?php echo " ".$artist?></h3><br>
                        <p class="animated fadeInUp" id="bio" style="margin-top: -10px"><span style="font-size: x-large; font-weight: bolder">Biography</span><br></p><br>
                        <p class="animated fadeInUp"><span style="font-size: x-large; font-weight: bolder; " id="album" >Album:  </span><br></p><br>
                        <p class="animated fadeInUp"><span style="font-size: x-large; font-weight: bolder; " id="genre">Genre:  </span><br></p>
                </div>
            </div>

        </div>
    </div>
    <!-- home banner ends -->



    <!-- blockblack -->
    <div class="blockblack">


        <?php
        $url = scraper(implode("+", explode(" ",$artist." ".$song)));
        $embed = explode("v=", $url)[1];
        $embed = 'https://www.youtube.com/embed/'.$embed;
        $sql = "UPDATE SONG SET SongUrl='$embed' WHERE SongTitle='$song'";
        mysqli_query($con, $sql);
        ?>

        <!-- About Starts -->
        <div id="about" class="spacer">
            <h3><span class="glyphicon glyphicon-music"></span>
                <a href=<?php echo $url?>><?php echo $song?></a>
                <span style="font-size: x-large"> by </span><?php echo $artist?><span></h3>
            <div class="container" style="margin-left: 70px">

            <iframe width="940" height="660" src=<?php echo $embed?>?autoplay=1&loop=1&autoreplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        </div>
        <!-- About Ends -->

        <!-- latest release starts-->
        <div id="album" class="releases spacer">
            <h3><span class="glyphicon glyphicon-heart"></span> You Might Also Like ...</h3>
            <div class="row">

                <?php
                function scraper($query) {
                    $curl = curl_init();
                    $scrape_site = "https://www.youtube.com";
                    $url = "https://www.youtube.com/results?search_query=".$query;
                    //print_r($url);

                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                    $result = curl_exec($curl);

                    preg_match("!href=\"\/watch\?[a-z]=[A-Za-z0-9-]+\"!", $result, $match);

                    //print_r(explode("href=", $match[0][0])[1]);
                    if (sizeof($match)===0){
                        $mv_link="";
                    } else {
                        $mv_link = $scrape_site.trim(explode("href=", $match[0])[1],"\"");
                    }

                    return $mv_link;
                }
                echo "<div id='add'></div>";
                ?>

                <script>
                    $(document).ready(function() {
                        var path = "http://ws.audioscrobbler.com/2.0/?method=track.getsimilar&limit=12&artist=";
                        path +=<?php echo "'".$artist."'"?>;
                        path +="&track=";
                        path +=<?php echo "'".$song."'"?>;
                        path +="&api_key=e4352f4de078644ba4e562e03f3b23d3&format=json";
                        $.getJSON(path, function(json) {
                            var html = "";
                            var image_path;
                            $.each(json.similartracks.track, function(i, item) {
                                html += "<div class=\"col-sm-3 col-xs-12\"><div class=\"album\">";
                                image_path=JSON.stringify(item.image[3]).replace("#", "").split(",")[0].split("\":\"")[1].replace("\"", "");
                                html +="<img onclick='window.open(\"singles.php?artist=" +item.artist.name+"&song="+item.name+"\")' src=\""+image_path+"\" class=\"img-responsive\" alt=\"music theme\">"+"<div class=\"albumdetail\"><h5>";
                                html +=item.artist.name+"</h5>";
                                html +="<a href=\""+"singles.php?artist="+item.artist.name+"&song="+item.name+"\" target = '_blank'><span class=\"glyphicon glyphicon-headphones\"></span>";
                                html +=" "+item.name+"</a></div></div></div>"

                            });

                            $('#add').append(html);
                        });
                    });

                    $(document).ready(function() {
                        var path = "http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=";
                        path +=<?php echo "'".$artist."'"?>;
                        path +="&api_key=e4352f4de078644ba4e562e03f3b23d3&format=json";
                        $.getJSON(path, function(json) {
                            var html = "";

                            $.each(json.artist.bio, function(i, item) {
                                if (i==='summary'){
                                    html += item+"<br>"
                                }
                            });

                            $('#bio').append(html);
                        });

                        var path = "http://ws.audioscrobbler.com/2.0/?method=track.getInfo&api_key=e4352f4de078644ba4e562e03f3b23d3&artist=";
                        path +=<?php echo "'".$artist."'"?>;
                        path +="&track=";
                        path +=<?php echo "'".$song."'"?>;
                        path +="&format=json";
                        $.getJSON(path, function(json) {
                            var html = "";
                            var albumname ="";
                            $.each(json.track.toptags.tag, function(i, item) {
                                html += " "+item['name']+","
                            });

                            $.each(json.track.album, function(i, item) {
                                if (i==='title') {
                                    albumname += "<a href='http://localhost:8090/IST210/fake-spotify/album.php?artist=";
                                    albumname +=<?php echo "'".$artist."'"?>;
                                    albumname +="&album=";
                                    albumname +=item+"'>"+ item + "</a>"
                                }
                            });

                            $('#genre').append(html);
                            $('#album').append(albumname);
                        });
                    });
                </script>


            </div>
        </div>
        <!-- latest release ends-->



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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="homepage_assets/js/jquery-ui.custom.min.js"></script>
<!-- boostrap -->
<script src="album_assets/bootstrap/js/bootstrap.js" type="text/javascript" ></script>
<script src="album_assets/scripts/plugins.js" type="text/javascript"></script>
<script src="album_assets/scripts/script.js" type="text/javascript"></script>



</body>


</html>
