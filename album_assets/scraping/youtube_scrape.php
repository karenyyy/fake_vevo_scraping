<?php

function single_song_scrape($query){
    $curl = curl_init();
    $scrape_site = "https://www.youtube.com";
    $url = "https://www.youtube.com/results?search_query=".$query;
    print_r($url);

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


function playlist_scraper($scrape_site, $url, $p, $delimiter)
{

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, 0);

    $result = curl_exec($curl);
    //print_r($result);
    preg_match_all($p, $result, $match);

    $mv_link = $scrape_site . trim(explode($delimiter."=", $match[0][1])[1], "\"");

    $playlist = explode("list=", $mv_link)[1];
    $playlist = "https://www.youtube.com/playlist?list=" . $playlist;

    curl_close($curl);
    return $playlist;

}


function song_scraper($scrape_site, $url, $p, $delimiter)
{
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, 0);

    $result = curl_exec($curl);
    preg_match_all($p, $result, $match);

    $song_array = array();

    $i=2;
    while (sizeof($song_array)<18) {
        $mv_link = $scrape_site . trim(explode($delimiter . "=", $match[0][$i])[1], "\"");

        array_push($song_array, $mv_link);
        $i+=2;
    }

    curl_close($curl);
    return $song_array;

}


function scrape_tags_per_song($url, $p){

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, 0);

    $result = curl_exec($curl);
    print_r($result);
    preg_match_all($p, $result, $match);
    $tags_array = array();
    $i=0;
    while (sizeof($tags_array)<30) {
        $tags = explode("-video-id=", $match[0][$i])[0];
        preg_match_all("!\".*\"!", $tags, $tags_match);
        array_push($tags_array, str_replace("\"", "",$tags_match[0][0]));
        $i+=1;
    }
    return $tags_array;

}

function scrape_image_per_song($tags, $p, $delimiter){
    $search_string = $tags;
    $url = "https://www.youtube.com/results?search_query=".$search_string;

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, 0);

    $result = curl_exec($curl);
    preg_match_all($p, $result, $match);
    return str_replace("\"", "", explode($delimiter, $match[0][0])[1]);

}


function main(){
    $scrape_site = "https://www.youtube.com";
    $search_string = "billboard+top+50+this+week";
    $url = "https://www.youtube.com/results?search_query=".$search_string;


    $pattern = "!href=\"\/watch\?[a-z]=[A-Za-z0-9]+&amp;list=[A-Za-z0-9]+\"!";

    $pattern2 = "!href=\"\/watch\?[a-z]=[A-Za-z0-9-]+(&amp;|index=[0-9]*|list=[A-Za-z0-9-]+|[a-z]+=[a-z0-9]+)*\"!";

    $pattern3 = "!data-title=\"(.*)\"!";

    $pattern4 = "!src=\"https:\/\/i\.ytimg\.com\/[a-z]+\/[A-Za-z0-9]+\/[A-Za-z0-9]+\.jpg\?([a-z]+=[-_a-zA-Z0-9]+|=&amp;)*\"!";


    $playlist=playlist_scraper($scrape_site, $url, $pattern, "href");
    $song_array = song_scraper($scrape_site, $playlist, $pattern2, "href");
    $tags_array = scrape_tags_per_song($playlist, $pattern3);

    $final_array = array();
    foreach ($song_array as $mv_link) {
        preg_match_all("!index=[0-9]*!", $mv_link, $index);

        $index = explode("=", $index[0][0])[1];
        $song_tag = $tags_array[$index - 1];
        $song_tag = str_replace(">", "", $song_tag);
        $song_tag = str_replace("'", "", $song_tag);
        $song_tag = implode("+", explode(" ", $song_tag));
        $mv_image = scrape_image_per_song($song_tag, $pattern4, "src=");
        array_push($final_array, array(str_replace("+", " ", $song_tag), $mv_link, $mv_image));
    }
    return $final_array;
}

