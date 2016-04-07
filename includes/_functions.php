<?php namespace App\controller;
//model
//the argument is the search text
//@param search
function get_products_by_search($s){
	global $products;
	$results = array();
	foreach ($products as $product) {
		$returned = stripos($product['name'], $s);
		if( $returned !== false || strtolower($product['name']) === strtolower($s)){
			// $results[] = $product;
			array_push($results, $product);
		}
	}
	return (!empty($results)? $results : null);
	//@return array
}

// function get_products_count(){
// 	global $products;
// 	return count($products);
// }

function get_products_subset($start, $end){
	global $products;
	$subset = array();

	$position = 0;
	//when you loop through the associative array it changes the indexes 
	//eg: 101 the first index the represent the logo red, shirt array will change to 0
	//so use sku to reference it 
	foreach ($products as $product) {
		$position++;
		if($position >= $start && $position <= $end){
			array_push($subset, $product);
		}
	}
	return (!empty($subset)? $subset : null);
}

