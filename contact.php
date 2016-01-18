<?php 

    $titrePage = 'Contact';
	require_once  'inc/dbconnect.php';
	include_once 'inc/header.php';

	require 'vendor/autoload.php';

?>

<h1> Contactez-moi!</h1>

<?php

$error = array();
$post = array();
$formValid = true;

if(!empty($_POST)){
	foreach($_POST as $key => $value){
		$post[$key] = trim(strip_tags($value));
	 }
    if (!preg_match('/^[\w.-]+@[\w.-]+\.[a-z]{2,}$/i', $post['email'])){
		$error[] = 'L\'adresse email est obligatoire';
	}
	if (!preg_match('/^[A-Z]+[a-zA-Z\s-]/', $post['lastname'])){
		$error[]= 'le nom doit commencer par une majuscule';
	}
	if (!preg_match('/^[A-Z]+[a-zA-Z\s-]/', $post['firstname'])){
	$error[]= 'le prénom doit commencer par une majuscule';
	}
	if(empty($post['subject'])){
		$error[] = 'Le sujet est obligatoire';
	}

	if(empty($post['message']))	{
			$error[] ='le message est obligatoire'; 
	}

	if(count($error) > 0){
		$formError = true;
	}
	else {
		$req = $bdd->prepare('INSERT INTO contact (email, lastname, firstname, message, new, date, subject) VALUES(:email, :lastname, :firstname, :message, "yes", NOW(), :subject)');
		$req->bindValue(':email', $post['email'], PDO::PARAM_STR);
		$req->bindValue(':lastname', $post['lastname'], PDO::PARAM_STR);
		$req->bindValue(':firstname', $post['firstname'], PDO::PARAM_STR);
		$req->bindValue(':subject', $post['subject'], PDO::PARAM_STR);
		$req->bindValue(':message', $post['message'], PDO::PARAM_STR);
		if($req->execute()){

	        $mail = new PHPMailer; 

			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.mailgun.org';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'equipe2@wf3.axw.ovh';                 // SMTP username
			$mail->Password = 'BbPZm67u7d7iX9';                           // SMTP password
			$mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->setFrom($post['email'], $post['lastname'].' '.$post['firstname']);
			$mail->addAddress('michael.mann.the.god.of.cinema@gmail.com');               // Name is optional

			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = $post['subject'];
			$mail->Body    = $post['message'];
			$mail->AltBody = $post['message'];

			if(!$mail->send()) {
			    echo 'Le mail n\'a pas été envoyé.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Le message a été envoyé';
			}
		}else{
			echo 'nok';
		}
	}	
}

 ?>
<?php 
		if(isset($formError) && $formError){
			echo '<p class="error">'.implode('<br>', $error).'</p>';
		}
?>
<form method="post">
  		<label for="email">Votre email</label>
  		<br><input type="email" name="email" id="email" placeholder ="Ecrivez votre Email">

  		<br><label for="lastname">Nom</label>
  		<br><input name="lastname" placeholder ="Nom...">

  		<br><label for="firstname">Prénom</label>
  		<br><input name="firstname" placeholder ="Prénom...">
  		
  		<br><label for="subject">Sujet de votre message</label>
  		<br><input name="subject" placeholder ="Sujet...">

  		<br><label for="textarea">Votre message</label>
  		<br><textarea name="message" placeholder ="Ecrivez votre Message"></textarea>
  		

  		<br><input type="submit" value="Envoyer"> 
</form>


<?php include_once 'inc/footer.php'; ?>
