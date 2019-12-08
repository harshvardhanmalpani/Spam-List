<?php
	$a=file_get_contents("list.md");
$b=str_replace("\n"," OR ",$a);
$c=wordwrap($b,1499,"<br>");
$d=explode("<br>",$c);
$head="<?xml version='1.0' encoding='UTF-8'?><feed xmlns='http://www.w3.org/2005/Atom' xmlns:apps='http://schemas.google.com/apps/2006'>
	<title>Mail Filters</title>
	<id>
	tag:mail.google.com,2008:filters:";
$author="<author>
		<name>Harshvardhan Malpani</name>
		<email>i@harshmalpani.in</email>
	</author>";
$propertysettings="<apps:property name='shouldTrash' value='true'/>
		<apps:property name='shouldNeverSpam' value='true'/>
		<apps:property name='sizeOperator' value='s_sl'/>
		<apps:property name='sizeUnit' value='s_smb'/>";
$termtitle="<entry><category term='filter'></category>
<title>Mail Filter</title>
		<id>tag:mail.google.com,2008:filter:";
foreach($d as $e)
{
	$f=preg_replace('/ OR$/', '', $e);
	$f=preg_replace('/^OR /', '', $f);
	$g[]=$f;
}
$ft="filters.txt";
file_put_contents($ft,"");
date_default_timezone_set("Asia/Kolkata");
$tagarr=[];
$fullentry='';$gb='';
foreach($g as $h)
{ 
	
	$updatedstamp= round(microtime(true) * 1000);
	$updatedtime= date("Y-m-d\TH:i:s\Z",intval($updatedstamp/1000));
	$tagarr[]=$updatedstamp;
	$fullentry.="$termtitle$updatedstamp</id><updated>$updatedtime</updated><content></content><apps:property name='from' value='$h'/>$propertysettings </entry>";
	@file_put_contents($ft,$h,FILE_APPEND);
	@file_put_contents($ft,"\r\n\r\n",FILE_APPEND);
}
//echo $fullentry;
foreach($tagarr as$tagtime)$gb.=$tagtime.',';
$gb=substr($gb,0,-1);
$finalstory=$head.$gb.'</id><updated>'.date("Y-m-d\TH:i:s\Z",time()).'</updated>'.$author.$fullentry.'</feed>';
file_put_contents("filter_import_for_gmail.xml",$finalstory);
?>