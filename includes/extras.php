<?= date("h:i:s a"); ?>


<a href="index.php"><button class="button">Cancel</button></a>   
		<?php if (isset($_SESSION['status']) ) : ?>
			<div class="message"> <?= (isset( $_SESSION['status'] ) ) ?  nl2br(htmlentities($_SESSION['status'])) : ''; ?></div>
			<?php session_destroy(); ?>
		<?php endif; ?>