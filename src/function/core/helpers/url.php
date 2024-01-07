<?php

function baseUrl($url) {
  $protocol = isset($_SERVER["HTTPS"]) && $_SERVER['HTTPS'] === 'on' ? 'https://':'http://';

  $domain = $_SERVER['HTTP_HOST'];
  $sub = explode('/', $_SERVER['REQUEST_URI']);



  $path = $protocol . $domain.'/' .$sub[1].'/'.$sub[2].'/'.$url;


  return $path;

}


function baseUrlImageSrc($url)
{
  $protocol = isset($_SERVER["HTTPS"]) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

  $domain = $_SERVER['HTTP_HOST'];
  $sub = explode('/', $_SERVER['REQUEST_URI']);



  $path = $protocol . $domain . '/' . $sub[1] . '/images/' . $url;


  return $path;

}





?>