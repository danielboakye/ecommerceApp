<?php
//controller
require_once("../../includes/config.php");
require_once(ROOT_PATH . "includes/connection.php");
require_once(ROOT_PATH . "includes/_functions.php");

if( empty($_GET['pg']) ) {
	$current_page = 1;
}else{
	// var_dump(htmlspecialchars($_GET['page']));exit();
	$current_page = (int) htmlspecialchars($_GET['pg']);
	//can use intval();
}

if($current_page < 1){
	//if get value is text or words instead of int then the value will be zero after casting
	//redirect to this page (thus the root directory -> './') without a query string which will set current page to 1
	//the same goes for query strings == negative numbers
	header("Location: ./");
	exit();
}

if($con){
	$products = App\DB\query("SELECT * FROM products ORDER BY sku ASC", array(), $con);
}else{
	die("Could not connect");
}


use App\controller;
$total_products_number = count($products);
// echo "$total_products_number";die();
$products_per_page = 8;
$total_pages = ceil($total_products_number / $products_per_page);

if($current_page > $total_pages){
	//if query string input is more than the number of pages existing then redirect to the last page
	header("Location: ./?pg=" . urlencode($total_pages));
	exit();
}

$start = ( ($current_page - 1) * $products_per_page );

if($current_page === intval($total_pages)){
	$remaining_products = $total_products_number % $products_per_page;
	// var_dump($remaining_products);
	$products = App\DB\get_products_subset($start, $remaining_products);
}else{
	$products = App\DB\get_products_subset($start, $products_per_page); //limit with two parameter start from 0 
} 
		// @param ___subset(start from 0 thus the first result but return n elements)
// echo "<pre>";
// var_dump($products);die();
if($products === null){
	//in case get_products_subset returns null display everything(all products -> remove pagination)
	$products =  App\DB\query("SELECT * FROM products ORDER BY sku ASC", array(), $con);
}
// var_dump($products);die();

$pageTitle = "Full Catalog | Ark Inc!";
$section = "shirts";
include(ROOT_PATH . "includes/header.php");
 ?>

<div class="section shirts page">
<!-- view -->
	<div class="wrapper">
		<h1>Full Catalog of Shirts</h1>
		<!-- pagination links -->
		<?php require(ROOT_PATH . "includes/list-navigation.html.php"); ?>

		<ul class="products">
			<?php if(count($products) > 1) : ?>
				<?php foreach($products as $product_id => $product) : ?>
					<li>
						<a href="<?= BASE_URL; ?>shirts/<?= urlencode($product['sku']); ?>/">
							<img src="<?= BASE_URL . htmlspecialchars($product['img']); ?>" alt="<?= htmlentities($product['name']); ?>">
							<p>View Details</p>
						</a>
					</li>
				<?php endforeach; ?>
			<?php else : ?>
				<?php $product = $products[0]; ?>
				<li>
					<a href="<?= BASE_URL; ?>shirts/<?= urlencode($product['sku']); ?>/">
						<img src="<?= BASE_URL . htmlspecialchars($product['img']); ?>" alt="<?= htmlentities($product['name']); ?>">
						<p>View Details</p>
					</a>
				</li>
			<?php endif; ?>		
		</ul>

		<?php require(ROOT_PATH . "includes/list-navigation.html.php"); ?>

	</div>
</div>

<?php include(ROOT_PATH . "includes/footer.php") ?>

				