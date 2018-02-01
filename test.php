<?php
<?php 
$file = ("http://api.appsocial.xyz/bigpicture/api.php");
header ("Content-Type:application/octet-stream");
 
header ("Accept-Ranges: bytes");
 
header ("Content-Length: ".filesize($file));
 
header ("Content-Disposition: attachment; filename=".$file);
 
readfile($file);
?> 
