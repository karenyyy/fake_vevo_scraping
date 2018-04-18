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
    <link rel="stylesheet" href="homepage_assets/css/plugins.css">
    <link rel="stylesheet" href="homepage_assets/css/style_.css">
    <link rel="stylesheet" href="homepage_assets/fonts/stylesheet.css">
    <link rel="stylesheet" href="homepage_assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="homepage_assets/css/bootstrap.min.css">
    <!--        <link rel="stylesheet" href="homepage_assets/css/bootstrap-theme.min.css">-->


    <!--For Plugins external css-->
    <link rel="stylesheet" href="homepage_assets/css/plugins.css"/>

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

<!--Home page style-->
<div id="background">



    <nav>

        <div class="container">
            <div class="nav-top clearfix">

                <div class="logo">
                    <a  href="" class="navbar-brand">
                        <svg class="logo" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="-13 -13 100 100" version="1.1">
                            <g class="logo__mainGroup">
                                <g class="logo__grayGroup">
                                    <path class="logo__square" fill="none" stroke-width="1" d="M0,0 0,70 70,70 70,0z"/>
                                    <path class="logo__line logo__line-1" fill="none" stroke-width="1" d="M10,0 10,70"/>
                                    <path class="logo__line logo__line-2" fill="none" stroke-width="1" d="M20,0 20,70"/>
                                    <path class="logo__line logo__line-3" fill="none" stroke-width="1" d="M30,0 30,70"/>
                                    <path class="logo__line logo__line-4" fill="none" stroke-width="1" d="M40,0 40,70"/>
                                    <path class="logo__line logo__line-5" fill="none" stroke-width="1" d="M50,0 50,70"/>
                                    <path class="logo__line logo__line-6" fill="none" stroke-width="1" d="M60,0 60,70"/>
                                    <path class="logo__line logo__line-1" fill="none" stroke-width="1" d="M0,10 70,10"/>
                                    <path class="logo__line logo__line-2" fill="none" stroke-width="1" d="M0,20 70,20"/>
                                    <path class="logo__line logo__line-3" fill="none" stroke-width="1" d="M0,30 70,30"/>
                                    <path class="logo__line logo__line-4" fill="none" stroke-width="1" d="M0,40 70,40"/>
                                    <path class="logo__line logo__line-5" fill="none" stroke-width="1" d="M0,50 70,50"/>
                                    <path class="logo__line logo__line-6" fill="none" stroke-width="1" d="M0,60 70,60"/>
                                </g>
                                <g class="logo__colorGroup">
                                    <path class="logo__stroke" fill="none" stroke-width="1" d="M0,70 0,40 50,40 50,60 60,60 60,30 40,30 40,10 10,10 10,20 30,20 30,30 0,30 0,0 50,0 50,20 70,20 70,70 40,70 40,50 10,50 10,60 30,60 30,70 0,70" />
                                    <path class="logo__fill" fill="none" stroke-width="10" d="M30,25 5,25 5,5 45,5 45,25 65,25 65,65 45,65 45,45 5,45 5,65 30,65" />
                                </g>
                            </g>
                        </svg>

                    </a>

                </div>

                <div class="head_top_social pull-right" style="margin: 50px">
                    <ul class="list-inline">
                        <li><a href=""><i class="fa fa-user"></i><?php echo $userLoggedIn->getUsername()?></a></li>
                        <li><a href=""><i class="fa fa-envelope"></i><?php echo $userLoggedIn->getEmail()?></a></li>
                    </ul>
                </div>

                <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button">
                    <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>
                </button>

            </div>
        </div>

        <div class="main-nav navbar-collapse collapse">
            <div class="container">
                <ul class="nav nav-justified">
                    <li><a class="active" href="#recent">HOME</a></li>
                    <li><a href="#lessons">TRENDING NOW</a></li>
                    <li><a href="#service">TOP ALBUMS</a></li>
                    <li><a href="#portfolio">TOP ARTISTS</a></li>
                    <li><a href="#bar">TOP TRACKS</a></li>
                    <li><a href="homepage.php" onclick="logout()">LOG OUT</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <section id="recent" class="lessons">
        <?php
        $string = file_get_contents("album_assets/json_files/recently_searched_single.json");
        $scraped_results = json_decode($string, true);

        echo "<div id=\"mainContent\" style=\"margin: 250px; width: 80%;\" >
       
        <h2 style=\"text-align: center; \">Recently Searched</h2><br>";

        foreach ($scraped_results as $item) {

            $artist = $item[0];
            $song =  $item[1];
            echo "<div class='gridViewItem'>
					<span id=\"hover\" role='link' tabindex='0' onclick='window.open(\"singles.php?artist=$artist&song=$song\")'>
                        <div class='gridViewInfo'>
                            <p class='text' style=\" font-size: 17px; font-weight: 800; margin-left: -10px\">" . $item[0]."<br>" .$item[1]. "</p>
						</div>
						<img src='$item[2]'>
					</span>

				</div>";
        }

        echo "</div>";
        ?>

        </section>

        <section id="lessons" class="lessons">
        <?php
        $string = file_get_contents("album_assets/json_files/vevo_trending.json");
        $scraped_results = json_decode($string, true);

        echo "<div id=\"mainContent\" style=\"margin: 250px; width: 80%\" >
       
        <h2 style=\"text-align: center; \">Trending Now ...</h2><br>";

        foreach ($scraped_results as $item) {

            $artist = $item[0][0];
            $song =  $item[0][1];
            echo "<div class='gridViewItem'>
					<span id=\"hover\" role='link' tabindex='0' onclick='window.open(\"singles.php?artist=$artist&song=$song\")'>
                        <div class='gridViewInfo'>
                            <p class='text' style=\" font-size: 17px; font-weight: 800; margin-left: -10px\">" . $item[0][0]."<br>" .$item[0][1]. "</p>
						</div>
						<img class='image' src='$item[1]'>
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
                var html = "<h2 style=\"text-align: center;\">Top 100 Artists</h2><br>";
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




    <section id="footer_widget" class="footer_widget">
        <div class="container">
            <div class="row">
                <div class="main_widget">

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="single_widget wow fadeIn" data-wow-duration="800ms">
                                <div class="footer_logo">
                                    <svg class="logo" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28" height="28" viewBox="-13 -13 100 100" version="1.1">
                                        <g class="logo__mainGroup">
                                            <g class="logo__grayGroup">
                                                <path class="logo__square" fill="none" stroke-width="1" d="M0,0 0,70 70,70 70,0z"/>
                                                <path class="logo__line logo__line-1" fill="none" stroke-width="1" d="M10,0 10,70"/>
                                                <path class="logo__line logo__line-2" fill="none" stroke-width="1" d="M20,0 20,70"/>
                                                <path class="logo__line logo__line-3" fill="none" stroke-width="1" d="M30,0 30,70"/>
                                                <path class="logo__line logo__line-4" fill="none" stroke-width="1" d="M40,0 40,70"/>
                                                <path class="logo__line logo__line-5" fill="none" stroke-width="1" d="M50,0 50,70"/>
                                                <path class="logo__line logo__line-6" fill="none" stroke-width="1" d="M60,0 60,70"/>
                                                <path class="logo__line logo__line-1" fill="none" stroke-width="1" d="M0,10 70,10"/>
                                                <path class="logo__line logo__line-2" fill="none" stroke-width="1" d="M0,20 70,20"/>
                                                <path class="logo__line logo__line-3" fill="none" stroke-width="1" d="M0,30 70,30"/>
                                                <path class="logo__line logo__line-4" fill="none" stroke-width="1" d="M0,40 70,40"/>
                                                <path class="logo__line logo__line-5" fill="none" stroke-width="1" d="M0,50 70,50"/>
                                                <path class="logo__line logo__line-6" fill="none" stroke-width="1" d="M0,60 70,60"/>
                                            </g>
                                            <g class="logo__colorGroup">
                                                <path class="logo__stroke" fill="none" stroke-width="1" d="M0,70 0,40 50,40 50,60 60,60 60,30 40,30 40,10 10,10 10,20 30,20 30,30 0,30 0,0 50,0 50,20 70,20 70,70 40,70 40,50 10,50 10,60 30,60 30,70 0,70" />
                                                <path class="logo__fill" fill="none" stroke-width="10" d="M30,25 5,25 5,5 45,5 45,25 65,25 65,65 45,65 45,45 5,45 5,65 30,65" />
                                            </g>
                                        </g>
                                    </svg>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="single_widget wow fadeIn" data-wow-duration="800ms">
                                <h4 class="footer_title">CONTACT</h4>
                                <div class="separator3"></div>
                                <ul>
                                    <li><a href=""><i class="fa fa-envelope"></i> info@gmail.com</a></li>
                                    <li><a href=""><i class="fa fa-phone"></i> 0123 456 789 0112</a></li>
                                    <li><a href=""><i class="fa fa-map-marker"></i> placeholder</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="single_widget wow fadeIn" data-wow-duration="800ms">
                                <h4 class="footer_title">LATEST NEWS</h4>
                                <div class="separator3"></div>
                                <ul>
                                    <li class="single_latest_news">
                                        <p class="latest_date">placeholder</p>
                                        <p class="subtitle">placeholder</p>
                                        <p class="details">placeholder</p>
                                    </li>

                                    <li class="single_latest_news">
                                        <p class="latest_date">placeholder</p>
                                        <p class="subtitle">placeholder</p>
                                        <p class="details">placeholder</p>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>



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

