<?php

header('Content-Type: text/xml');
echo file_get_contents('https://www.sciencedaily.com/rss/top/science.xml');

?>
