<?php
include('config.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Twitter Style load more results.</title>
<link href="frame.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js"></script>

<script type="text/javascript">
$(function() {
//More Button
$('.more').live("click",function() 
{
var ID = $(this).attr("id");
var	next	= parseInt($("#page").val())+1;
$("#page").val(next);
if(ID)
{
$("#more"+ID).html('<img src="moreajax.gif" />');

$.ajax({
type: "POST",
url: "ajax_more.php",
data: "lastmsg="+ ID+"&next="+next, 
cache: false,
success: function(html){
$("ol#updates").append(html);
$("#more"+ID).remove();
}
});
}
else
{
$(".morebox").html('The End');

}


return false;


});
});

</script>
<style>
body
{
font-family:Arial, 'Helvetica', sans-serif;
color:#000;
font-size:15px;

}
a { text-decoration:none; color:#0066CC}
a:hover { text-decoration:underline; color:#0066cc }
*
{ margin:0px; padding:0px }
ol.timeline
	{ list-style:none}ol.timeline li{ position:relative;border-bottom:1px #dedede dashed; padding:8px; }ol.timeline li:first-child{}
	.morebox
	{
	font-weight:bold;
	color:#333333;
	text-align:center;
	border:solid 1px #333333;
	padding:8px;
	margin-top:8px;
	margin-bottom:8px;
	-moz-border-radius: 6px;-webkit-border-radius: 6px;
	}
	.morebox a{ color:#333333; text-decoration:none}
	.morebox a:hover{ color:#333333; text-decoration:none}
	#container{margin-left:60px; width:580px }
	
</style>
</head>

<body>
<?php $first=1;?>
<input type="hidden" id="page" value="<?php echo $first?>"/>
<input type="hidden" id="next"/>

<div id='container'>
<ol class="timeline" id="updates">
<?php
$sql=mysql_query("select * from artikel order by tgldibuat desc limit 0,10");
while($row=mysql_fetch_array($sql))
{
$msg_id=$row['idart'];
$message=$row['judul'];
?>
<li>
<?php echo $message; ?>
</li>
<?php } ?>
</ol>
<div id="more<?php echo $msg_id; ?>" class="morebox">
<a href="#" class="more" id="<?php echo $msg_id; ?>">more</a>
</div>
</div>
</body>
</html>
