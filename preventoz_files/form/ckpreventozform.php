<?php
//echo "working";
$dbhost = 'localhost:3036';
$dbuser = 'root';
$dbpass = '';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
	die('Could not connect: ' . mysql_error());
}
if(isset($_POST['add']))
{
	if(! get_magic_quotes_gpc() )
	{
		$comment = addslashes ($_POST['comment']);
	}
	else
	{
		$comment = $_POST['comment'];
	}

	$sql = "INSERT INTO ckpreventoztable ".
	"(comment) ".
	"VALUES ".
	"('$comment')";
	mysql_select_db('CK');
	$retval = mysql_query( $sql, $conn );
	if(! $retval )
	{
		die('Could not enter data: ' . mysql_error());
	}
	echo "Entered Comment : " ;echo $comment; echo"\n";
	mysql_close($conn);
}

?>