<? 
$act = $_POST["act"];
$subject = $_POST["subject"];
$name = $_POST["name"];
$email = $_POST["email"];
$email_from = "site@geryit.com";
$msg = $_POST["msg"];


if($act == "contactForm"){
	
	$m="Subject : ".$subject."\r\n";
	$m.="Name : ".$name."\r\n";
	$m.="E-mail : ".$email."\r\n";
	$m.="Message : ".$msg."\r\n";
	
	$headers = "From: ".$email_from." \r\n";
		
	mail("geryit@gmail.com","Site message from ".$email, $m, $headers);
}

?>