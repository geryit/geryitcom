<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Mailer</title>
<style>
label{width:100px;display:block;}
input[type=text]{width:200px;}
textarea{width:400px;height:300px;}
</style>
</head>
<?
if($_GET["send"]){

$from = $_POST["from"];
$to = $_POST["to"];
$subject = $_POST["subject"];
$msg = $_POST["msg"];


	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: ".$from." \r\n";
		
	mail($to,$subject, $msg, $headers);
	
	echo "Gonderildi";

}
?>
<body>

<form action="?send=1" method="post">
	<label>From :</label><input type="text" name="from" /><br>
	<label>To : </label><input type="text" name="to" /><br>
    <label>Subject : </label><input type="text" name="subject" /><br>
	<label>Message : </label><textarea name="msg"></textarea><br>
    <input type="submit" value="submit" />
</form>

</body>
</html>