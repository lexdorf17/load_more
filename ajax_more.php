
 <?php
include("config.php");


if(isSet($_POST['lastmsg']))
{
$lastmsg=$_POST['lastmsg'];
$limit=$_POST['next']*10;
$result=mysql_query("select * from artikel order by tgldibuat desc limit $limit,10");
$count=mysql_num_rows($result);
while($row=mysql_fetch_array($result))
{

$msg_id=$row['idart'];
$message=$row['judul'];
?>
 

<li>
<?php echo $message; ?>
</li>


<?php
}


?>

<div id="more<?php echo $msg_id; ?>" class="morebox">
<a href="#" id="<?php echo $msg_id; ?>" class="more">more</a>
</div>

<?php
}
?>
