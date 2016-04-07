<?php namespace App\DB;

function connect_to_db($config){
	try {
		$con = new \PDO("mysql:host={$config['DB_HOST']}; dbname={$config['DB_NAME']}", 
									$config['DB_USER'], $config['DB_PASS']);
		$con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		$con->exec("SET NAMES 'utf8'");
		return $con;

	} catch (PDOException $e) {
		return false;
		die($e->getMessage() . " Could not connect to db!");
	}
}

function query($query, $bindings, $con){
	$stmt = $con->prepare($query);
	$stmt->execute($bindings);

	return ($stmt->rowCount() > 0) ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : false;
}

// function get_shirt_by_sku($product_id, $con){
// 	$query = query(
// 		"SELECT * FROM products WHERE sku = :sku LIMIT 1", 
// 		array('sku' => $product_id),
// 		$con);

// 	return ( !empty($query) ) ? $query[0] : null;
// 	//doesnt need fetch all cos that was already done with the query function and
// 	// it is now just ready for use
// 	// can use fetch(\PDO::FETCH_ASSOC) if was writing  the query funcion again specifically for this
// }
//use bindParam and bindValue u want to bind a few values but use execute($bindings) with binding array if there are
// a lot of values lyk more than 3

function get_shirt_by_sku($product_id, $con){

	$stmt = $con->prepare("SELECT * FROM products WHERE sku = ? LIMIT 1");
	$stmt->bindValue(1, $product_id, \PDO::PARAM_INT);
	$stmt->execute();

	return ($stmt->rowCount() > 0) ? $stmt->fetch(\PDO::FETCH_ASSOC) : false;
}

function get_products_subset($start, $end){
	global $con;
	try {
		$stmt = $con->prepare("SELECT * FROM products ORDER BY sku LIMIT ?, ?");
		$stmt->bindValue(1, $start, \PDO::PARAM_INT);
		$stmt->bindParam(2, $end, \PDO::PARAM_INT);
		$stmt->execute();

		return ($stmt->rowCount() > 0) ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : false;
	} catch (PDOException $e) {
		echo "Error " . $e.getMessage();
	}
}