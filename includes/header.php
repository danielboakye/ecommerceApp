<!DOCTYPE html>
<html>
<head>
	<title><?= isset($pageTitle) ? nl2br(htmlentities($pageTitle)) : "Ark Inc!"; ?></title>
	<link rel="stylesheet" href="<?= BASE_URL; ?>css/style.css" type="text/css">
	<link rel="shortcut icon" href="<?= BASE_URL; ?>img/favicon.ico">
	<?php if($section === "contact") : ?>
		<script type="text/javascript" src="<?= BASE_URL; ?>js/jquery-2.1.4.min.js"></script>
		<!-- root relative web addresses for links -->
		<link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>css/login.css">
	<?php endif; ?>
	<?php if($section === "shirts") : ?>
		<script type="text/javascript" src="<?= BASE_URL; ?>js/jquery-2.1.4.min.js"></script>
	<?php endif; ?>
</head>
<body>

	<div class="header">

		<div class="wrapper">

			<h1 class="branding-title"><a href="<?= BASE_URL ?>">Shirts 4 Mike</a></h1>
								<!-- HOME --> <!-- can use this  -->
								<!-- ./  -->
			<ul class="nav">
				<li class="shirts <?= (isset($section) && $section === "shirts") ? "on" : ""?>">
					<a href="<?= BASE_URL; ?>shirts/">Shirts</a>
				</li>
				<li class="contact <?= (isset($section) && $section === "contact") ? "on" : ""?>">
					<a href="<?= BASE_URL; ?>contact/">Contact</a>
				</li>
				<li class="search <?= (isset($section) && $section === "search") ? "on" : ""?>">
					<a href="<?= BASE_URL; ?>search/">Search</a>
				</li>
				<li class="cart"><a href="<?= BASE_URL; ?>receipt/">Shopping Cart</a></li>
			</ul>

		</div>

	</div>

	<div id="content">