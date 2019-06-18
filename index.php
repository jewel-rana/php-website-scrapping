 <?php
 ini_set('display_errors', 1);
error_reporting(E_ALL|E_STRICT);

include_once('lib/simplehtmldom/simple_html_dom.php');
$html = file_get_html('https://www.youtube.com/feed/trending');

echo '<pre>';

var_dump($html->find('li.expanded-shelf-content-item-wrapper', 0));

$videos = array();

$i = 1;
foreach ($html->find('li.expanded-shelf-content-item-wrapper') as $video) {
	if($i >10){
		break;
	}

// // echo 'test';
// 	//Item Link
    // $thumb = $video->find('img');
    $thumb = $video->find('img', 0);
    // print_r($thumb);
    $info = $video->find('a.yt-uix-tile-link', 0);
//  //    print_r($info->href);
//  //    echo '<br />';
//  //    print_r($info->title);
// 	// // print_r($info->title);
//  //    echo '<br />';
//     // $summary = $video->find('.style-scope.ytd-video-renderer', 0);
//     // print_r($summary);
// 	// echo '<br />';

// 	// //push to a list of videos

    $videos[] = array(
        'url'=> 'https://youtube.com' . $info->href, 
        'title'=>$info->plaintext,
        'thumb'=>$thumb->src,
        'duration'=>$info->duration
    );

	$i++;
}

var_dump($videos);

// $fp = fsockopen("//youtube.com/feed/trending", 80, $errno, $errstr, 30);
// if (!$fp) {
//     $result = "$errstr ($errno)<br />\n";
// } else {
//     $result = '';
//     $out = "GET / HTTP/1.1\r\n";
//     $out .= "Host: www.4wtech.com/csp/web/Employee/Login.csp\r\n";
//     $out .= "Connection: Close\r\n\r\n";
//     fwrite($fp, $out);
//     while (!feof($fp)) {
//         $result .= fgets($fp, 128);
//     }
//     fclose($fp);
// }
// echo $result;