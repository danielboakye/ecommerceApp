<?php 
require_once("../includes/config.php");
require_once(ROOT_PATH . "includes/connection.php");
if($con){
	$products = App\DB\query("SELECT * FROM products ORDER BY sku DESC LIMIT 4", array(), $con);
	$products = array_reverse($products);
}else{
	die("Could not connect");
}

$section = "";
include(ROOT_PATH . "includes/header.php");
 ?>
<div class="section banner">

	<div class="wrapper">

		<img class="hero" src="img/mike-the-frog.png" alt="Mike the Frog says:">
		<div class="button">
			<a href="<?= BASE_URL; ?>shirts/">
				<h2>Hey, I&rsquo;m Mike!</h2>
				<p>Check Out My Shirts</p>
			</a>
		</div>
	</div>

</div>

<div class="section shirts latest">

	<div class="wrapper">

		<h2>Mike&rsquo;s Latest Shirts</h2>

		<ul class="products">
			<?php foreach($products as $product_id => $product) : ?>
					<li>
						<a href="<?= BASE_URL; ?>shirts/<?= urlencode($product['sku']); ?>/">
							<img src="<?= BASE_URL . htmlspecialchars($product['img']); ?>" alt="<?= htmlspecialchars($product['name']); ?>">
							<p>View Details</p>
						</a>
					</li>
			<?php endforeach; ?>	
		</ul>
	</div>

</div>

<?php include(ROOT_PATH . "includes/footer.php");?>