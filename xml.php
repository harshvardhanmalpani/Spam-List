<?php
$originalFile = file_get_contents("list.md");
$a = str_replace(array("&","<",">","'",'"'),array("&amp;","&lt;","&gt;","&apos;","&quot;"),$originalFile);
$b = str_replace("\n", " OR ", $a);
$c = wordwrap($b, 1499, "<br>");
$d = explode("<br>", $c);
$head = "<?xml version='1.0' encoding='UTF-8'?><feed xmlns='http://www.w3.org/2005/Atom' xmlns:apps='http://schemas.google.com/apps/2006'>
	<title>Mail Filters</title>
	<id>
	tag:mail.google.com,2008:filters:";
$author = "<author>
		<name>Harshvardhan Malpani</name>
		<email>i@harshmalpani.in</email>
	</author>";
$propertySettings = "<apps:property name='shouldTrash' value='true'/>
		<apps:property name='shouldNeverSpam' value='true'/>
		<apps:property name='sizeOperator' value='s_sl'/>
		<apps:property name='sizeUnit' value='s_smb'/>";
$termtitle = "<entry><category term='filter'></category>
<title>Mail Filter</title>
		<id>tag:mail.google.com,2008:filter:";
foreach ($d as $e) {
    $f = preg_replace('/ OR$/', '', $e);
    $f = preg_replace('/^OR /', '', $f);
    $g[] = $f;
}
$ft = "filters.txt";
file_put_contents($ft, "");
date_default_timezone_set("Asia/Kolkata");
$tagarr = [];
$fullEntry = '';
$gb = '';
foreach ($g as $h)
{
    $updatedStamp = round(microtime(true) * 1000);
    $updatedTime = date("Y-m-d\TH:i:s\Z", intval($updatedStamp / 1000));
    $tagarr[] = $updatedStamp;
    $fullEntry .= "$termtitle$updatedStamp</id><updated>$updatedTime</updated><content></content><apps:property name='from' value='$h'/>$propertySettings </entry>";
    @file_put_contents($ft, $h, FILE_APPEND);
    @file_put_contents($ft, "\r\n\r\n", FILE_APPEND);
}
//echo $fullEntry;
foreach ($tagarr as $tagtime)
{
    $gb .= $tagtime . ',';
}
$gb = substr($gb, 0, -1);
$finalStory = $head . $gb . '</id><updated>' . date("Y-m-d\TH:i:s\Z", time()) . '</updated>' . $author . $fullEntry . '</feed>';
file_put_contents("filter_import_for_gmail.xml", $finalStory);
?>