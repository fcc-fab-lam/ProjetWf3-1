<?php
session_start();

require_once 'inc/dbconnect.php';

include_once 'inc/header.php';

require '../vendor/autoload.php';


$post = array();
		$err = array();
		$erreursForm = false;
		$formValid = false;
if(isset($_GET['error']) && $_GET['error'] == 'yes'){
    $err[] = 'Erreur de Token !!!';
}
if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        $post[$key] = trim(strip_tags($value));
    }
    if(!empty($post['email']) && filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
        $prep = $bdd->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $prep->bindValue(':email', $post['email'], PDO::PARAM_STR);
        $prep->execute();
        $user = $prep->fetch(PDO::FETCH_ASSOC);
        if (!empty($user)){
            $token = md5(uniqid());
            $req = $bdd->prepare('INSERT INTO tokens (email, token, date_inserted) VALUES (:email,:token, NOW())');
            $req->bindValue('email', $post['email'], PDO::PARAM_STR);
            $req->bindValue('token', $token, PDO::PARAM_STR);
            $req->execute();

            $formValid = true;
            $message = 'Pour réinitialiser votre mot de passe, merci de cliquer sur lien suivant : <a href="http://localhost/projetwf3-1/admin/initpwd.php?token='.$token.'">Réinitialisation</a>';

        } else{
            $err[] = 'ton email est inexistant!';
        }
    }
}
if(count($err)){
    $erreursForm = true;
}
?>



	<h3>Mot de passe oublié</h3>
	
		<form method="post">
			<label for="email">Votre email :</label><br>
			<input type="email" name="email" id="email" placeholder="Votre email">

			<br><br>
			<button type="submit">Envoyer</button>

		</form>

		<?php
			if($erreursForm){
				echo '<p class="error">'.implode('<br>', $err).'</p>';
			}
		?>

		<pre>
			<?php 
				if($formValid){
					//echo '<a href="initpwd.php?token='.$token.'">Reinitialise ton mot de passe</a>';
                    $mail = new PHPMailer; 

                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.mailgun.org';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'equipe2@wf3.axw.ovh';                 // SMTP username
                    $mail->Password = 'BbPZm67u7d7iX9';                           // SMTP password
                    $mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to

                    $mail->setFrom('no-reply@michael.mann.com', 'Michael Mann Token');
                    $mail->addAddress($post['email']);               // Name is optional

                    $mail->isHTML(true);                                  // Set email format to HTML

                    $mail->Subject = 'Réinitialisation de mot de passe';
                    $mail->Body    = $message;
                    $mail->AltBody = $message;

                    if(!$mail->send()) {
                        echo 'Le mail n\'a pas été envoyé.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                        echo 'Un mail vient de vous être envoyé !';
                    }
				} 
			?>
		</pre>





<?php include_once 'inc/footer.php'; ?>
