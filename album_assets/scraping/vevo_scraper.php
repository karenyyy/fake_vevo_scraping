<?php


function vevo_scrape($url, $xpath) {
    $html = file_get_contents($url);
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $finder = new DOMXPath($dom);
    $result = $finder->query($xpath);
    print_r($result);
    return $result->item(0)->nodeValue;
}


function vevo_run()
{
    $vevo_trending_array = array();
    for ($j=1; $j<3; $j++) {
        for ($i = 1; $i < 37; $i++) {
            $artist = vevo_scrape('https://www.vevo.com/trending-now?page='.$j, '/html/body/div[2]/div/div/div[4]/div/div[3]/ul/li[' . $i . ']/div[1]//text()');
            $song = vevo_scrape('https://www.vevo.com/trending-now?page='.$j,'/html/body/div[2]/div/div/div[4]/div/div[3]/ul/li['.$i.']/div[1]/a[2]/h3//text()');
            $img = vevo_scrape('https://www.vevo.com/trending-now?page='.$j, '/html/body/div[2]/div/div/div[4]/div/div[3]/ul/li['. $i. ']/a/div/div/picture/img//@src');
            $video = vevo_scrape('https://www.vevo.com/trending-now?page='.$j, '/html/body/div[2]/div/div/div[4]/div/div[3]/ul/li['.$i.']/a//@href');
            array_push($vevo_trending_array, array($artist, $song, 'https:'.$img, 'https://www.vevo.com'.$video));
        }
        print_r($vevo_trending_array);
    }
    return $vevo_trending_array;
}




function vevo_genre($genre) {
    $vevo_genre_array = array();
    for ($j=1; $j<3; $j++) {
        for ($i = 1; $i < 37; $i++) {
            $artist = vevo_scrape('https://www.vevo.com/genres/'.$genre.'/trending-videos?page='.$j, '/html/body/div[2]/div/div/div[4]/div/div[3]/ul/li[' . $i . ']/div[1]//text()');
            $songtitle = vevo_scrape('https://www.vevo.com/genres/'.$genre.'/trending-videos?page='.$j, '/html/body/div[2]/div/div/div[4]/div/div[3]/ul/li['. $i .']/div[1]/a[2]//text()');
            $img = vevo_scrape('https://www.vevo.com/genres/'.$genre.'/trending-videos?page='.$j, '/html/body/div[2]/div/div/div[4]/div/div[3]/ul/li['. $i. ']/a/div/div/picture/img//@src');
            $video = vevo_scrape('https://www.vevo.com/genres/'.$genre.'/trending-videos?page='.$j, '/html/body/div[2]/div/div/div[4]/div/div[3]/ul/li['.$i.']/div[1]/a[2]//@href');
            array_push($vevo_genre_array, array($artist, $songtitle, 'https:'.$img, 'https://www.vevo.com'.$video));
        }
        print_r($vevo_genre_array);
    }
    return $vevo_genre_array;
}


function vevo_artist_scrape(){
    $vevo_artist_array = array();
    for ($j = 1; $j < 10; $j++) {
        $each_artist_array=array();
        $name = vevo_scrape('https://www.vevo.com/artists', '/html/body/div[2]/div/div/div[4]/div/div[3]/ul/li[' . $j . ']/div[1]/a//text()');
        $img = vevo_cover_scrape('https://www.vevo.com/artists', '/html/body/div[2]/div/div/div[4]/div/div[3]/ul/li['. $j. ']/a/div/div/picture/img//@src');
        array_push($each_artist_array, $name, $img);
        $name = implode("-", explode(" ", $name));
        for ($i = 1; $i < 8; $i++) {
            $song_artist = vevo_scrape('https://www.vevo.com/artist/'.strtolower($name), '/html/body/div[2]/div/div/div[4]/div/div[3]/div[2]/div/div/div[2]/div/div[' . $i . ']/a/div[2]/div[1]//text()');
            $song_title  = vevo_scrape('https://www.vevo.com/artist/'.strtolower($name), '/html/body/div[2]/div/div/div[4]/div/div[3]/div[2]/div/div/div[2]/div/div[' . $i . ']/a/div[2]/div[2]//text()');
            $cover = vevo_scrape('https://www.vevo.com/artist/'.strtolower($name), '/html/body/div[2]/div/div/div[4]/div/div[3]/div[2]/div/div/div[2]/div/div['. $i. ']/a/div/div/picture/img//@src');
            $video = vevo_scrape('https://www.vevo.com/artist/'.strtolower($name), '/html/body/div[2]/div/div/div[4]/div/div[3]/div[2]/div/div/div[2]/div/div['.$i.']/a//@href');
            array_push($each_artist_array, array($song_artist, $song_title, 'https:'.$cover, 'https://www.vevo.com'.$video));
        }
        print_r($each_artist_array);
        $fp = fopen('vevo_popular_artists.json', 'a');
        fwrite($fp, json_encode($each_artist_array, JSON_PRETTY_PRINT));
        array_push($vevo_artist_array, $each_artist_array);
//        print_r($vevo_artist_array);
    }
    return $vevo_artist_array;
}



$vevo_trending_array= vevo_run();
$fp = fopen('../json_files/vevo_trending.json', 'w');
fwrite($fp, json_encode($vevo_trending_array, JSON_PRETTY_PRINT));
fclose($fp);

//[Gg]enre\s*\=\s*{{[a-zA-Z]+\slist\|(\\n<!--[A-Za-z\s\.]+\s-->\\n\*)*\[\[[A-Za-z\s]+

//Genres
//$genre_array = ['pop', 'hip-hop','country','electronic','rock','latino','rbsoul'];

//
//foreach ($genre_array as $item) {
//    $vevo_genre_array = vevo_genre($item);
//    $fp = fopen('../json_files/vevo_'.$item.'.json', 'w');
//    fwrite($fp, json_encode($vevo_genre_array, JSON_PRETTY_PRINT));
//    fclose($fp);
//}

//$vevo_artist_array = vevo_artist_scrape();
//$fp = fopen('vevo_popular_artists.json', 'a');
//fwrite($fp, json_encode($vevo_artist_array, JSON_PRETTY_PRINT));
//fclose($fp);
//$final_array = main();
//$fp = fopen('scraped_results.json', 'w');
//fwrite($fp, json_encode($final_array, JSON_PRETTY_PRINT));
//fclose($fp);

//
//function resize_image($file, $w, $h, $specific=false, $crop=false) {
//    list($width, $height) = getimagesize($file);
//    $r = $width / $height;
//    if ($crop) {
//        if ($width > $height) {
//            $width = ceil($width-($width*abs($r-$w/$h)));
//        } else {
//            $height = ceil($height-($height*abs($r-$w/$h)));
//        }
//        $newwidth = $w;
//        $newheight = $h;
//    } else {
//        if ($w/$h > $r) {
//            if ($specific){
//                $newwidth = $w;
//                $newheight = $h;
//            }else{
//                $newwidth = $h*$r;
//                $newheight = $h;
//            }
//
//        } else {
//            if ($specific) {
//                $newheight = $h;
//                $newwidth = $w;
//            }else{
//                $newheight = $w / $r;
//                $newwidth = $w;
//            }
//        }
//    }
//    $src = imagecreatefromjpeg($file);
//    $dst = imagecreatetruecolor($newwidth, $newheight);
//    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
//
//    return $dst;
//}


//define('DIRECTORY', '/opt/lampp/htdocs/fake_spotify/assets/images');
//
//$content = file_get_contents('https://elrescatemusical.com/wp-content/uploads/2017/11/amas.jpg');
//file_put_contents(DIRECTORY . '/top.jpg', $content);
//$img = resize_image(DIRECTORY . '/top.jpg', 800, 400, true);
//imagejpeg($img,DIRECTORY . '/top.jpg');
//

?>

