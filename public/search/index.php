<?php 
require_once("../../includes/config.php");
require_once(ROOT_PATH . "includes/connection.php");
require_once(ROOT_PATH . "includes/_functions.php");
use App\controller;

$searchTerm = "";
if(isset($_GET['s'])){
	$searchTerm = htmlspecialchars(trim($_GET['s']));
	if($searchTerm != ""){
		if($con){
			// $searchTerm = "%{$searchTerm}%";
			$products = App\DB\query(
				"SELECT * FROM products WHERE products.name LIKE :s ORDER BY sku ASC", 
				array('s' => "%" . $searchTerm . "%"), $con);
		}else{
			die("Could not connect");
		}
		// var_dump($products);die();
		// $products = controller\get_products_by_search($searchTerm);
		if(!empty($products) && count($products) === 1) {
			// echo "<pre>";
			// var_dump($products);
			// echo $products[0]['sku'];
			$id = $products[0]['sku'];
			header("Location: " . BASE_URL . "shirts/" . urlencode($id) . '/');
			exit();
		}
	}	
}

$section = "search";
$pageTitle = "Search";
include(ROOT_PATH . "includes/header.php");
?>

<div class="section shirts search page">

	<div class="wrapper">

		<h1>Search</h1>
		
		<form action="./" method="get">
			<input type="text" name="s" value="<?= htmlentities($searchTerm); ?>">
			<input type="submit" value="Go!">
		</form>

		<?php // if a search has been performed ... ?>
			<?php if ($searchTerm != "") : ?>

				<?php // if there are products found that match the search term, display them;
					  // otherwise, display a message that none were found ?>
				<?php if (!empty($products) && count($products) > 1) : ?>
					<ul class="products">
						<?php
							foreach ($products as $product) {
	                            include(ROOT_PATH . "includes/partial-product-list-view.html.php");
							}
						?>
					</ul>
				<?php else: ?>
					<p>No products were found matching that search term.</p>
				<?php endif; ?>

			<?php endif; ?>

	</div>

</div>

 <?php include(ROOT_PATH . "includes/footer.php");?>