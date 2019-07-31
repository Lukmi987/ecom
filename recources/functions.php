<?php

// helper fucntions

function redirect ($location){
	header("Location: $location");
}

function query($sql) {
	global $conn; // if I want to  bring it inside a func I need to use global
	try{
	$stmt = $conn->prepare($sql);
    return $stmt->execute();
   
	} catch (\Exception $e) {
		throw $e;
	}
}

function escape_string($string){
	global $conn;
	return $conn->quote($string);
}

function fetch_array($result){
	return $result->fetchAll(PDO::FETCH_ASSOC);
}


/***********************FRONT END FUNCTIONS******************/
function get_products(){
	global $conn;
	try{
	$sql = "SELECT * FROM products";
 	$stmt = $conn->prepare($sql);
 	$stmt->execute();
 	$result= $stmt->fetchAll(PDO::FETCH_ASSOC);
 	} catch(\Exception $e) {
 	throw $e;
 	}

	foreach ( $result as $row){
		//using herodoc https://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.heredoc
 $product = <<<DELIMETER
<div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">
        <a href="item.php?id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a>
        <div class="caption">
            <h4 class="pull-right">&#36;{$row['product_price']}</h4>
            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
            </h4>
            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
       <a class="btn btn-primary" target="_blank" href="item.php?id={$row['product_id']}">Add to cart</a>      
        </div>
    </div>
</div>
DELIMETER;
	echo $product;
	}

	//herodoc
}

function get_categories(){
	                
	             global $conn;   
	                try{
                    $sql = "SELECT * FROM categories";
                    	 $stmt = $conn->prepare($sql); 
                    	 $stmt->execute();
                    	 $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
					foreach ( $result as $row) {
					 $category_links = <<<DELIMETER
					 <a href="category.php?id={$row['cat_id']}" class='list-group-item'>{$row['cat_title']}</a>
DELIMETER;
	
							echo $category_links;	
						}
					} catch (\Exception $e){
						throw $e;
					}	
}


/***********************FRONT END FUNCTIONS******************/
