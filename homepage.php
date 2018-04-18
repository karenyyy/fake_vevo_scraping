<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Fake Spotify</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" type="text/css" href="homepage_assets/css/style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="homepage_assets/js/script.js"></script>
    <script src="homepage_assets/js/jquery-ui.custom.min.js"></script>
    <script src="homepage_assets/js/mainpage.js"></script>
    <link rel="stylesheet" href="homepage_assets/css/navmenu/styles.css">
    <link rel="stylesheet" href="homepage_assets/css/portfolio.jquery.css">
    <link rel="stylesheet" href="homepage_assets/css/fonticons.css">
    <link rel="stylesheet" href="homepage_assets/css/style_.css">
    <link rel="stylesheet" href="homepage_assets/fonts/stylesheet.css">
    <link rel="stylesheet" href="homepage_assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="homepage_assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="homepage_assets/css/bootstrap-theme.min.css">


    <!--For Plugins external css-->
    <link rel="stylesheet" href="homepage_assets/css/plugins.css" />

    <!--Theme custom css -->
    <link rel="stylesheet" href="homepage_assets/css/style_.css">

    <!--Theme Responsive css-->
    <link rel="stylesheet" href="homepage_assets/css/responsive.css" />

    <script src="homepage_assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>


</head>

<?php
include("includes/config.php");
include("includes/classes/User.php");
if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = new User($con, $_SESSION['userLoggedIn']);
}
?>


<body data-spy="scroll" data-target=".navbar-collapse">
<nav>
<!--Home page style-->
<div id="background">

    <div class="logo" style="margin-left: 200px; margin-top: 5px">
        <a  href="" class="navbar-brand">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" id="spotify--logo">
                    <g id="logo--circle">
                        <path id="logo--circle_1_" d="M84,0.3L84,0.3C37.7,0.3,0.3,37.8,0.3,84c0,46.3,37.5,83.7,83.7,83.7
        c46.3,0,83.7-37.5,83.7-83.7C167.7,37.8,130.2,0.3,84,0.3z"/>
                        <path class="logo--circle--bar" id="logo--circle--bar-1" d="M41.7,114.7c29.2-6.7,53.9-3.9,73.6,8.1c2.5,1.5,5.7,0.7,7.2-1.7
        c1.5-2.5,0.7-5.7-1.7-7.2c-22.1-13.5-49.4-16.6-81.3-9.3c-2.8,0.6-4.6,3.4-3.9,6.2C36,113.6,38.8,115.4,41.7,114.7z"/>
                        <path class="logo--circle--bar" id="logo--circle--bar-2" d="M130.5,89.3c-25.8-15.9-63.7-20.4-94.1-11.1c-3.4,1-5.4,4.7-4.4,8.1
        c1,3.4,4.7,5.4,8.1,4.3c26.6-8.1,60.9-4.1,83.4,9.8c3.1,1.9,7.1,0.9,9-2.2v0C134.5,95.2,133.6,91.2,130.5,89.3z"/>
                        <path class="logo--circle--bar" id="logo--circle--bar-3" d="M144.3,71.8c2.2-3.7,1-8.5-2.7-10.7C110.5,42.6,61.3,40.9,31.7,49.8
        c-4.1,1.3-6.5,5.6-5.2,9.8c1.3,4.1,5.6,6.5,9.8,5.2c25.8-7.8,70.3-6.3,97.3,9.7h0C137.2,76.7,142.1,75.5,144.3,71.8z"/>
                    </g>

                </svg>
        </a>

    </div>


        <div class="container">
            <div class="nav-top clearfix">

                <div class="head_top_social pull-right" style="margin: 50px">
                    <ul class="list-inline" style="margin-top: -35px; margin-right: -350px">
                        <li>
                            <div class="searchContainer">
                                <input type="text" style="font-size: large; font-weight: bold" class="searchInput" id="albumsearch" placeholder="search: artist, album ...">
                                <span class="fa fa-search" style="margin-top: -18px; margin-right: -30px"></span>
                            </div>
                        </li>

                        <li>
                            <div class="searchContainer">
                                <input type="text" style="font-size: large; font-weight: bold" class="searchInput"  id="singlesearch" placeholder="search: artist, song ...">
                                <span class="fa fa-search" style="margin-top: -18px; margin-right: -30px"></span>
                            </div>
                        </li>

                    </ul>
                </div>

                <script>
                    $(function() {
                        $("#albumsearch").keypress(function(e) {
                            if (e.which==13) {
                                var val = $("#albumsearch").val();
                                val = val.replace("'","\\'");
                                window.open("album.php?artist=" + val.split(",")[0].trim() + "&album=" + val.split(",")[1].trim());
                            }
                        });
                    });

                    $(function() {
                        $("#singlesearch").keypress(function(e) {
                                if (e.which==13) {
                                    var val = $("#singlesearch").val();
                                    val = val.replace("'","\\'");
                                    window.open("http://localhost:8090/IST210/fake-spotify/singles.php?artist=" + val.split(",")[0].trim() + "&song=" + val.split(",")[1].trim());
                                }
                            });
                    })
                </script>

                <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button">
                    <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>
                </button>

            </div>
        </div>

        <div class="main-nav navbar-collapse collapse">
            <div class="container">
                <ul class="nav nav-justified">
                    <li><a class="active" href="#home">HOME</a></li>
                    <li><a href="#lessons">TRENDING NOW</a></li>
                    <li><a href="#service">TOP ALBUMS</a></li>
                    <li><a href="#portfolio">TOP ARTISTS</a></li>
                    <li><a href="#bar">TOP TRACKS</a></li>
                    <li><a href="register.php">LOG IN</a></li>
                    <li><a href="search.php">SEARCH</a></li>
                </ul>
            </div>
        </div>
    </nav>



    <section id="home" class="home text-right">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-4">
                        <div class="main_home_content">
                            <div class="single_home">
                                <div class="main_home wow fadeInUp" data-wow-duration="700ms">
                                    <h1>WELCOME TO OUR </h1>
                                    <h1 class="subtitle">FAKE SPOTIFY</h1>

                                </div>
                            </div>

                            <div class="single_home">
                                <div class="main_home wow fadeInUp" data-wow-duration="700ms">
                                    <h1>EXPLORE MUSIC FROM</h1>
                                    <h1 class="subtitle">the Latest Albums, Artists and Genres</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>






    <section id="lessons" class="lessons">
        <?php
        $string = file_get_contents("album_assets/json_files/vevo_trending.json");
        $scraped_results = json_decode($string, true);

        echo "<div id=\"mainContent\" style=\"margin: 250px; width: 80%\" >
       
        <h2 style=\"text-align: center; \">Trending Now ...</h2><br>";

        foreach ($scraped_results as $item) {

            $artist = $item[0];
            $song =  $item[1];
            echo "<div class='gridViewItem'>
					<span id=\"hover\" role='link' tabindex='0' onclick='window.open(\"singles.php?artist=$artist&song=$song\")'>
                        <div class='gridViewInfo'>
                            <p class='text' style=\" font-size: 17px; font-weight: 800; margin-left: -10px\">" . $item[0]."<br>" .$item[1]. "</p>
						</div>
						<img class='image' src='$item[2]'>
					</span>

				</div>";

        }

        echo "</div>";
        ?>
        <script>
            var genre = ["pop", "hip-hop", "electronic","country","rock","randb","latino"];
            var url=[];
            var container=[];

            genre.forEach(
                function (value) {
                    url.push("http://ws.audioscrobbler.com/2.0/?method=tag.gettopalbums&tag=" + value + "&api_key=e4352f4de078644ba4e562e03f3b23d3&format=json");
                    container.push("#mainContent_" + value);
                });

            $(document).ready(function () {
                for (let i=0;i<url.length;i++) {
                    $.getJSON(url[i], function (json) {
                        var html = "<div id=\"mainContent\">";
                        html += "<div class=\"gridViewContainer\">";
                        if (genre[i]==="randb"){
                            genre[i]="r & b";
                        }
                        html +="<h2 style='text-align: center;margin-top: -20px'>"+genre[i].toUpperCase()+"</h2><br>";
                        var image_path;
                        $.each(json.albums.album, function (i, item) {
                            html += "<div class=\"gridViewItem\">";
                            html += "<span id=\"hover\" role=\"link\" tabindex=\"0\" onclick='window.open(\"album.php?artist=" +item.artist.name+"&album="+item.name+"\")'>";
                            image_path = JSON.stringify(item.image[3]).replace("#", "").split(",")[0].split("\":\"")[1].replace("\"", "");
                            html += "<img src=\"" + image_path + "\">";
                            html += "<br><br><br><p class='text' style=\" font-size: 17px; text-align:center; font-weight: 800;  margin-left: -20px\">" + item.name.length<20?item.name:item.name.slice(0,20) +"</p>";
                            html += "<div class='gridViewInfo' style='style=\"font-size:15px; font-weight: bold;'></div></span></div>";

                        });

                        html += "</div>";
                        $(container[i]).append(html);
                    });
                }

            });
        </script>

    </section>


    <section id="service" class="service">
        <div class="main-nav navbar-collapse collapse">
            <div id="bar_album" class="main-nav navbar-collapse collapse">
                <div style="margin: 200px; margin-bottom: -120px; width: 80%; background-color: black">
                    <ul class="nav nav-justified">
                        <li><a id="showpop" >POP</a></li>
                        <li><a id="showhip-hop" >HIP-HOP</a></li>
                        <li><a id="showelectronic" >ELECTRONIC</a></li>
                        <li><a id="showcountry" >COUNTRY</a></li>
                        <li><a id="showrock" >ROCK</a></li>
                        <li><a id="showrandb" >R & B</a></li>
                        <li><a id="showlatino" >LATINO</a></li>
                    </ul>
                </div>
            </div>
            <div style="margin: 200px; margin-bottom: -50px; width: 80%; background-color: black">
            </div>
            <div>
                <div id="mainContent_pop" style="margin-top: -200px; margin: 250px; width: 80%;"></div>
                <div id="mainContent_hip-hop" style="margin-top: -200px; margin: 250px; width: 80%;"></div>
                <div id="mainContent_electronic" style="margin-top: -200px; margin: 250px; width: 80%;"></div>
                <div id="mainContent_country" style="margin-top: -200px; margin: 250px; width: 80%;"></div>
                <div id="mainContent_rock" style="margin-top: -200px; margin: 250px; width: 80%;"></div>
                <div id="mainContent_randb" style="margin-top: -200px; margin: 250px; width: 80%;"></div>
                <div id="mainContent_latino" style="margin-top: -200px; margin: 250px; width: 80%;"></div>
            </div>
    </section>


    <script>
        $(document).ready(function() {
            $.getJSON("http://ws.audioscrobbler.com/2.0/?method=chart.gettopartists&limit=100&api_key=e4352f4de078644ba4e562e03f3b23d3&format=json&callback=?", function(json) {
                var html = "";
                html += "<div class=\"gridViewContainer\">";
                var image_path;
                $.each(json.artists.artist, function(i, item) {
                    html += "<div class=\"gridViewItem\">";
                    html +="<input type='submit' id='btn' style='color: black; margin: 3px 25px; font-weight: bold' name='recommend' value='" + item.name + "'>";
                    html += "<span role=\"link\" tabindex=\"0\" onclick=window.open(\"" +item.url +"\")>";
                    image_path=JSON.stringify(item.image[4]).replace("#", "").split(",")[0].split("\":\"")[1].replace("\"", "");
                    html += "<br><br>"+"<div class=\"ball\" style=\"box-shadow: inset 0px 0px 0px; background-image: url("+image_path+"); width: 210px; height: 210px;\"></div>";
                    html += "<p class='text'>" +"<br><br><br></p>";
                    html += "<div class='gridViewInfo' style=\"font-size:15px; font-weight: bold; margin: 0 0 30px; \">"  + "<br><br><br><br><br><br>" + "Play count : " +item.listeners + "</div></span></div>";

                });

                $('#mainContent_').append(html);
            });
        });
    </script>

    <section id="portfolio" class="portfolio">
        <div class="main-nav navbar-collapse collapse">
            <div style="margin: 200px; margin-bottom: -50px; width: 80%; background-color: black">
            </div>
            <div>
                <form id="similarForm" action="similarArtists.php" method="POST">
                    <div id="mainContent_" style="margin-top: -200px; margin: 250px; width: 80%;">
                    </div>
            </div>
    </section>




    <section id="blog" class="news">
        <div id="navigation">
            <div id="bar" class="main-nav navbar-collapse collapse">
                <div style="margin: 200px; margin-bottom: -50px; width: 80%; background-color: black">
                    <ul class="nav nav-justified">
                        <li><a id="show_pop" >POP</a></li>
                        <li><a id="show_hip-hop" >HIP-HOP</a></li>
                        <li><a id="show_electronic" >ELECTRONIC</a></li>
                        <li><a id="show_country" >COUNTRY</a></li>
                        <li><a id="show_rock" >ROCK</a></li>
                        <li><a id="show_randb" >R & B</a></li>
                        <li><a id="show_latino" >LATINO</a></li>

                    </ul>
                </div>
            </div>
            <div style="margin-top: -180px">
                <div id="tabs-pop" class="pop_container">
                    <?php
                    $string = file_get_contents("album_assets/json_files/vevo_pop.json");
                    $scraped_results = json_decode($string, true);
                    echo "<form id=\"similarForm\" action=\"similarArtists.php\" method=\"POST\">
        <div id=\"mainContent\" style=\"margin: 250px; width: 80%\" >

        <h2 style=\"text-align: center; \">POP</h2><br>";

                    foreach ($scraped_results as $item) {
                        $artist = $item[0];
                        $song =  $item[1];
                        echo "<div class='gridViewItem'>
					<span role='link' tabindex='0' onclick='window.open(\"singles.php?artist=$artist&song=$song\")'>
						<div class='gridViewInfo'>
                            <p class='text' style=\" font-size: 17px; font-weight: 800; margin-left: -10px\">" . $item[0]."<br>" .$item[1]. "</p>
						</div>
						<img class='image' src='$item[2]'>
					</span>

				</div>";

                    }

                    echo "</div></form>";
                    ?>

                </div>
                <div id="tabs-hip-hop" class="hip-hop_container">
                    <?php
                    $string = file_get_contents("album_assets/json_files/vevo_hip-hop.json");
                    $scraped_results = json_decode($string, true);
                    echo "<form id=\"similarForm\" action=\"similarArtists.php\" method=\"POST\">
        <div id=\"mainContent\" style=\"margin: 250px; width: 80%\" >
       
        <h2 style=\"text-align: center; \">HIP-HOP</h2><br>";

                    foreach ($scraped_results as $item) {
                        echo "<div class='gridViewItem'>
					<span id=\"hover\" role='link' tabindex='0' onclick='window.open(\"singles.php?artist=$item[0]&song=$item[1]\")'>
                        <div class='gridViewInfo'>
                            <p class='text' style=\" font-size: 17px; font-weight: 800; margin-left: -10px\">" . $item[0]."<br>" .$item[1]. "</p>
						</div>
						<img class='image' src='$item[2]'>
					</span>

				</div>";

                    }

                    echo "</div></form>";
                    ?>

                </div>
                <div id="tabs-electronic" class="electronic_container">
                    <?php
                    $string = file_get_contents("album_assets/json_files/vevo_electronic.json");
                    $scraped_results = json_decode($string, true);
                    echo "<form id=\"similarForm\" action=\"similarArtists.php\" method=\"POST\">
                    <div id=\"mainContent\" style=\"margin: 250px; width: 80%\" >
                   
                    <h2 style=\"text-align: center; \">ELECTRONIC</h2><br>";

                    foreach ($scraped_results as $item) {
                        echo "<div class='gridViewItem'>
					<span id=\"hover\" role='link' tabindex='0' onclick='window.open(\"singles.php?artist=$item[0]&song=$item[1]\")'>
                        <div class='gridViewInfo'>
                            <p class='text' style=\" font-size: 17px; font-weight: 800; margin-left: -10px\">" . $item[0]."<br>" .$item[1]. "</p>
						</div>
						<img class='image' src='$item[2]'>
					</span>

				</div>";

                    }

                    echo "</div></form>";
                    ?>

                </div>
                <div id="tabs-country" class="country_container">
                    <?php
                    $string = file_get_contents("album_assets/json_files/vevo_country.json");
                    $scraped_results = json_decode($string, true);
                    echo "<form id=\"similarForm\" action=\"similarArtists.php\" method=\"POST\">
        <div id=\"mainContent\" style=\"margin: 250px; width: 80%\" >
       
        <h2 style=\"text-align: center; \">COUNTRY</h2><br>";

                    foreach ($scraped_results as $item) {
                        echo "<div class='gridViewItem'>
					<span id=\"hover\" role='link' tabindex='0' onclick='window.open(\"singles.php?artist=$item[0]&song=$item[1]\")'>
                        <div class='gridViewInfo'>
                            <p class='text' style=\" font-size: 17px; font-weight: 800; margin-left: -10px\">" . $item[0]."<br>" .$item[1]. "</p>
						</div>
						<img class='image' src='$item[2]'>
					</span>

				</div>";

                    }

                    echo "</div></form>";
                    ?>

                </div>
                <div id="tabs-rock" class="rock_container">
                    <?php
                    $string = file_get_contents("album_assets/json_files/vevo_rock.json");
                    $scraped_results = json_decode($string, true);
                    echo "<form id=\"similarForm\" action=\"similarArtists.php\" method=\"POST\">
        <div id=\"mainContent\" style=\"margin: 250px; width: 80%\" >
       
        <h2 style=\"text-align: center; \">ROCK</h2><br>";

                    foreach ($scraped_results as $item) {
                        echo "<div class='gridViewItem'>
					<span id=\"hover\" role='link' tabindex='0' onclick='window.open(\"singles.php?artist=$item[0]&song=$item[1]\")'>
                        <div class='gridViewInfo'>
                            <p class='text' style=\" font-size: 17px; font-weight: 800; margin-left: -10px\">" . $item[0]."<br>" .$item[1]. "</p>
						</div>
						<img class='image' src='$item[2]'>
					</span>

				</div>";

                    }

                    echo "</div></form>";
                    ?>

                </div>
                <div id="tabs-rb" class="randb_container">
                    <?php
                    $string = file_get_contents("album_assets/json_files/vevo_rbsoul.json");
                    $scraped_results = json_decode($string, true);
                    echo "<form id=\"similarForm\" action=\"similarArtists.php\" method=\"POST\">
        <div id=\"mainContent\" style=\"margin: 250px; width: 80%\" >
       
        <h2 style=\"text-align: center; \">R & B</h2><br>";

                    foreach ($scraped_results as $item) {
                        echo "<div class='gridViewItem'>
					<span id=\"hover\" role='link' tabindex='0' onclick='window.open(\"singles.php?artist=$item[0]&song=$item[1]\")'>
                        <div class='gridViewInfo'>
                            <p class='text' style=\" font-size: 17px; font-weight: 800; margin-left: -10px\">" . $item[0]."<br>" .$item[1]. "</p>
						</div>
						<img class='image' src='$item[2]'>
					</span>

				</div>";

                    }

                    echo "</div></form>";
                    ?>

                </div>
                <div id="tabs-latino" class="latino_container">
                    <?php
                    $string = file_get_contents("album_assets/json_files/vevo_latino.json");
                    $scraped_results = json_decode($string, true);
                    echo "<form id=\"similarForm\" action=\"similarArtists.php\" method=\"POST\">
        <div id=\"mainContent\" style=\"margin: 250px; width: 80%\" >
       
        <h2 style=\"text-align: center; \">LATINO</h2><br>";

                    foreach ($scraped_results as $item) {
                        echo "<div class='gridViewItem'>
					<span id=\"hover\" role='link' tabindex='0' onclick='window.open(\"singles.php?artist=$item[0]&song=$item[1]\")'>
                        <div class='gridViewInfo'>
                            <p class='text' style=\" font-size: 17px; font-weight: 800; margin-left: -10px\">" . $item[0]."<br>" .$item[1]. "</p>
						</div>
						<img class='image' src='$item[2]'>
					</span>

				</div>";

                    }

                    echo "</div></form>";
                    ?>

                </div>
            </div>
        </div>
    </section>




    <footer id="footer" class="footer">

        <div class="container">
            <div class="row">

                <div class="col-md-12 col-sm-12">
                    <div class="copyright_text text-center">
                        <p class=" wow fadeInRight" data-wow-duration="1s">Made with <i class="fa fa-heart"></i> by <a href="#">Group 08</a>2018. All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="blogdetail" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>


                <div class="container" style="background-color: black">
                    <br />
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Search</span>
                            <input type="text" name="search_text" id="search_text"  class="form-control" />
                        </div>
                    </div>
                    <br />
                    <div id="result"></div>
                </div>


            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!-- START SCROLL TO TOP  -->

    <div class="scrollup">
        <a href="#"><i class="fa fa-chevron-up"></i></a>
    </div>

    <script src="homepage_assets/js/vendor/jquery-1.11.2.min.js"></script>
    <script src="homepage_assets/js/vendor/bootstrap.min.js"></script>

    <script src="homepage_assets/js/jquery.easypiechart.min.js"></script>
    <script src="homepage_assets/js/portfolio.jquery.js"></script>
    <script src="homepage_assets/js/jquery.mixitup.min.js"></script>
    <script src="homepage_assets/js/jquery.easing.1.3.js"></script>
    <script src="homepage_assets/js/jquery.slicknav.min.js"></script>
    <!--This is link only for gmaps-->
    <script src="http://maps.google.com/maps/api/js"></script>
    <script src="homepage_assets/js/gmaps.min.js"></script>

    <script>
        var map = new GMaps({
            el: '.ourmaps',
            scrollwheel: false,
            lat: -12.043333,
            lng: -77.028333
        });
    </script>



    <script src="homepage_assets/js/plugins.js"></script>
    <script src="homepage_assets/js/main.js"></script>
</div>
</body>

</html>

