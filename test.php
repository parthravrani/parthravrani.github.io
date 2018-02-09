<?php
$id = $_GET['id']; //the youtube video ID
$format = $_GET['fmt']; //the MIME type of the video. e.g. video/mp4, video/webm, etc.
parse_str(file_get_contents("http://youtube.com/get_video_info?video_id=".$id),$info); //decode the data
$streams = $info['url_encoded_fmt_stream_map']; //the video's location info

$streams = explode(',',$streams);

foreach($streams as $stream){
    parse_str($stream,$data); //decode the stream
    if(stripos($data['type'],$format) !== false){ //We've found the right stream with the correct format
        $video = fopen($data['url'].'&amp;signature='.$data['sig'],'r'); //the video
        $file = fopen('video.'.str_replace($format,'video/',''),'w');
        stream_copy_to_stream($video,$file); //copy it to the file
        fclose($video);
        fclose($file);
        echo 'Download finished! Check the file.';
        break;
    }
}

?>
