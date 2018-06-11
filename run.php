<?php
$a=file_get_contents("list.md");
$b=str_replace("\r\n"," OR ",$a);
$c=wordwrap($b,1499,"<br>");
$d=explode("<br>",$c);
foreach($d as $e)
{
	$f=preg_replace('/ OR$/', '', $e);
	$f=preg_replace('/^OR /', '', $f);
	$g[]=$f;
}
$ft="filters.txt";
file_put_contents($ft,"");
foreach($g as $h)
{ 
	@file_put_contents($ft,$h,FILE_APPEND);
	@file_put_contents($ft,"\r\n\r\n",FILE_APPEND);
}