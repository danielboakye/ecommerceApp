<?php 
session_start();
require_once("../../includes/config.php");
if($_POST){
	$name = trim(htmlspecialchars($_POST['name']));
	$email = trim(htmlspecialchars($_POST['email']));
	$message = trim(htmlspecialchars($_POST['msg']));
    // echo "{$message}";

	 if ($name == "" OR $email == "" OR $message == "") {
        $error_message = "You must specify a value for name, email address, and message.";
    }

    if (!isset($error_message)) {
        foreach( $_POST as $value ){
            if( stripos($value,'Content-Type:') !== FALSE ){
                $error_message = "There was a problem with the information you entered.";
            }
        }
    }

    if (!isset($error_message) && $_POST["address"] != "") {
        $error_message = "Your form submission has an error.";
    }

    require_once(ROOT_PATH . "includes/phpmailer/class.phpmailer.php");
    $mail = new PHPMailer();

    if (!isset($error_message) && !$mail->ValidateAddress($email)){
        $error_message = "You must specify a valid email address.";
    }

    if (!isset($error_message)) {
        $email_body = "";
        $email_body = $email_body . "Name: " . $name . "<br>";
        $email_body = $email_body . "Email: " . $email . "<br>";
        $email_body = $email_body . "Message: " . $message;

        $mail->SetFrom($email, $name);
        $address = "danielboakye98@yahoo.com";
        $mail->AddAddress($address, "Shirts 4 Mike");
        $mail->Subject    = "Shirts 4 Mike Contact Form Submission | " . $name;
        $mail->MsgHTML($email_body); 

        if($mail->Send()) {
            $_SESSION['status'] = "302";
            header("Location: " . BASE_URL . "contact/?status=" . urlencode(302));
            exit;
        } else {
          $error_message = "There was a problem sending the email: " . $mail->ErrorInfo;
        }

    }
   
}

	// echo nl2br("name: {$name} \n email: {$email} \n msg: {$msg}");	


$pageTitle = "Contact Ark Inc!";
$section = "contact";
include(ROOT_PATH . "includes/header.php");
?>
<div class="section page">

    <?php if (isset($_SESSION['status']) AND $_SESSION['status'] == "302" 
                AND isset($_GET['status']) AND $_GET['status'] == "302") : ?>
    	<section class="hire">
    		<h1>Thanks for the email! I&rsquo;ll be in touch shortly!</h1>
    	</section>
       <?php $_SESSION['status'] = null; ?> 
    <?php else : ?>

 
		<section id="hire">
            <?php if (!isset($error_message)) : ?>
		        <h1>Contact Me</h1>
            <?php else : ?>
                <?php echo '<p class="msg">' . $error_message . '</p>'; ?> 
            <?php endif; ?>    
		  <form action="<?= BASE_URL; ?>contact/" method="POST">
			    <div class="field name-box">
			      <input type="text" id="name" name="name" placeholder="Who Are You?" value="<?= (isset($name) && $error_message != null)? htmlentities($name) : ""; ?>" required>
			      <label for="name">Name</label>
			      <span class="ss-icon">check</span>
			    </div>

			    <div class="field email-box">
			      <input type="text" id="email" name="email" placeholder="name@email.com" value="<?= (isset($email) && $error_message != null) ? htmlentities($email) : ""; ?>" required>
			      <label for="email">Email</label>
			      <span class="ss-icon">check</span>
			    </div>
			    <div class="field email-box" style="display: none;">
			      <input type="text" id="address" name="address" >
			      <label for="address">Address</label>
			      <span class="ss-icon">Humans pls leave this field blank</span>
			    </div>
			    <div class="field msg-box">
			      <textarea id="msg" rows="4" name="msg" placeholder="Your message goes here..."><?= isset($message) ? htmlentities($message) : ""; ?></textarea>
			      <label for="msg">Msg</label>
			      <span class="ss-icon">check</span>
			    </div>

			    <input class="button" type="submit" value="Send" />
		  </form>
		</section>
                 
    <?php endif; ?>

</div>
<script type="text/javascript" src="<?= BASE_URL . "js/script.js";?>"></script>
<?php include(ROOT_PATH . "includes/footer.php"); ?>