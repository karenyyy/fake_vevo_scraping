<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="homepage_assets/css/font-awesome.min.css">
</head>
<body style='background-color: black; background-image: url("album_assets/images/back3.jpg");'>

<div class="logo" style="margin-left: 200px;">
    <a  href="" class="navbar-brand">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3000 3000" id="spotify--logo">
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

<div class="container" style="background-color: black;">
    <div class="form-group" style="margin-top: 100px">
        <h2 style="text-align: center; font-weight: bolder; color: white; font-family: 'Varela Round', sans-serif">Search for Artist, Song and Albums ...</h2>
        <br>
        <div class="input-group">
            <span class="input-group-addon">Search</span>
            <input type="text" name="search_text" id="search_text"  class="form-control" />
        </div>
    </div>
    <br />
    <div id="result"></div>
</div>

</body>
</html>


<script>
    $(document).ready(function(){

        load_data();

        function load_data(query)
        {
            $.ajax({
                url:"fetch.php",
                method:"POST",
                data:{query:query},
                success:function(data)
                {
                    $('#result').html(data);
                }
            });
        }
        $('#search_text').keyup(function(){
            var search = $(this).val();
            if(search != '')
            {
                load_data(search);
            }
            else
            {
                load_data();
            }
        });
    });



</script>

<style>

    @keyframes scale-to-full {
        0%, 1% {
            transform: scale(0);
        }
        70%, 100% {
            transform: scale(1);
        }
    }
    @keyframes show-bars {
        0%, 30% {
            opacity: 0;
            transform: scaley(0.78);
        }
        70%, 92.8% {
            opacity: 1;
            transform: scaley(1);
        }
        93%, 100% {
            opacity: 0;
            transform: scaley(0.78);
        }
    }
    @keyframes dash {
        0% {
            fill-opacity: 0;
            stroke-width: 1px;
        }
        37% {
            fill-opacity: 0;
        }
        50% {
            stroke-width: 1px;
        }
        100% {
            fill-opacity: 1;
            stroke-dashoffset: 0;
            stroke-width: 0;
        }
    }


    #logo--circle {
        animation: dash 4s infinite, scale-to-full 4s infinite;
        fill: #1ed760;
        stroke: #1ed760;
        stroke-dasharray: 90;
        stroke-dashoffset: 90;
        transform-origin: 84px 50%;
        transition: fill-opacity 0.3s ease, transform 0.1s ease;
    }
    #logo--circle .logo--circle--bar {
        animation: show-bars 4s infinite;
        fill: white;
        opacity: 0;
        transform: scaley(0.78);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }
    #logo--circle #logo--circle--bar-1 {
        animation-delay: 0.25s;
    }
    #logo--circle #logo--circle--bar-2 {
        animation-delay: 0.7s;
    }
    #logo--circle #logo--circle--bar-3 {
        animation-delay: 1s;
    }
    #logo--name path {
        animation: dash 4s infinite;
        fill: #1ed760;
        stroke: #1ed760;
        stroke-dasharray: 600;
        stroke-dashoffset: 600;
        transition: fill-opacity 0.3s ease;
    }



</style>

