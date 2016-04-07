<?php 
require_once("../../includes/config.php");
require_once(ROOT_PATH . "includes/connection.php");

if (isset($_GET["id"])) {
	//sanitizing inputs
	$product_id = intval($_GET["id"]);
	$product = App\DB\get_shirt_by_sku($product_id, $con);
}

if ($product === null) {
	header("Location: " . BASE_URL . "shirts/");
	exit();
}


$section = "shirts";
$pageTitle = $product["name"];
include(ROOT_PATH . "includes/header.php");
 ?>

		<div class="section page">

			<div class="wrapper">

				<div class="breadcrumb"><a href="<?= BASE_URL; ?>shirts/">Shirts</a> &gt; <?= $product["name"]; ?></div>

				<div class="shirt-picture">
					<span>
						<img src="<?= BASE_URL . $product["img"]; ?>" alt="<?= $product["name"]; ?>">
					</span>
				</div>

				<div class="shirt-details">

					<h1><span class="price">$<?php echo $product["price"]; ?></span> <?= $product["name"]; ?></h1>

					<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="<?= $product["paypal"]; ?>">
						<input type="hidden" name="item_name" value="<?= $product["name"]; ?>">
						<table>
						<tr>
							<th>
								<input type="hidden" name="on0" value="Size">
								<label for="os0">Size</label>
							</th>
							<td>
							<?php  
							$result = App\DB\query(
										"SELECT * FROM products_sizes INNER JOIN sizes ON products_sizes.size_id = sizes.id WHERE product_sku = :s ORDER BY sizes.order ASC", 
										array('s' => $product['sku']), $con);
							// $result = $result[0];
							// echo "<pre>";
							// print_r($result);die();
							if($result === null){
								$result[0]['size'] = "Large";
								//incase there is an error with the database query it echoes a default size large
							}
							 ?>
								<select name="os0" id="os0">
									<?php foreach($result as $size) : ?>
										<option value="<?= htmlspecialchars($size['size']); ?>">
											<?= htmlentities($size['size']); ?> 
										</option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>
						</table>
						<input type="submit" value="Add to Cart" name="submit">
					</form>

					<p class="note-designer">* All shirts are designed by Ark Inc!.</p>

				</div>

			</div>

		</div>

<?php include(ROOT_PATH . "includes/footer.php");?>