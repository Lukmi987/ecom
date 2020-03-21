<?php

// helper fucntions

function redirect($location){
	header("Location: $location");
}

function set_message($msg){
	if(!empty($msg)){
		$_SESSION['message'] = $msg;
	} else{
		$msg = '';
	}
}

function display_message(){
	if(isset($_SESSION['message'])){
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
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
       <a class="btn btn-primary" target="_blank" href="../recources/cart.php?add={$row['product_id']}">Add to cart</a>
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

function get_products_in_cat_page($id){
	global $conn;
	try{
	$sql = "SELECT * FROM products WHERE product_category_id = ?";
 	$stmt = $conn->prepare($sql);
 	$stmt->bindParam(1,$id);
 	$stmt->execute();
 	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
       <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
        </div>
    </div>
</div>
DELIMETER;
	echo $product;
	}

	//herodoc
 }

 function get_products_in_shop_page(){
	global $conn;
	try{
	$sql = "SELECT * FROM products";
 	$stmt = $conn->prepare($sql);
 	$stmt->execute();
 	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
       <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
        </div>
    </div>
</div>
DELIMETER;
	echo $product;
	}

	//herodoc
 }

 function login_user(){
 	global $conn;
 	if(isset($_POST['submit'])){
  $username = $_POST['username'];
  $password = intval($_POST['password']);
  var_dump($username);
  var_dump($password);
  try{
  	$sql = "SELECT * FROM users WHERE username = :username AND  password = :password";

  	$stmt = $conn->prepare($sql);

  	$stmt->bindParam(':username',$username);

  	$stmt->bindParam(':password',$password);
  	$stmt->execute();

  }catch(\Exception $e){
  		throw $e;
   }
    if($stmt->fetchColumn() == 0){
    	set_message('Your pswd or username is wrong!!');
  		redirect("login.php");

  	}else{
  		redirect("admin");
  		}
  	}
  }

  function send_message(){
  	if(isset($_POST['submit'])){
  	$to = "komprs.l@gmail.com";
  	$from_name = $_POST['name'];
  	$subject = $_POST['subject'];
  	$email = $_POST['email'];
  	$message = $_POST['message'];

  	$headers = "From: {$from_name} {email}";

  	$result = mail($to, $subject, $message, $headers);


  	if(!$result){
  		set_message("Sorry we could not send your messge");
  		redirect("contact.php");
  	} else {
  			set_message("Your messag has been sent!!");
  			redirect("contact.php");
  		}
  	}
  }

	/***********************Add products in Admin******************/
function add_product(){
global $conn;

if(isset($_POST['publish'])){
	
		$product_title = escape_string($_POST['product_title']);
		$product_category_id = intval($_POST['product_category_id']);
		$product_price = intval($_POST['product_price']);
		$product_quantity = intval($_POST['product_quantity']);
		$product_description = escape_string($_POST['product_description']);
		$short_desc = escape_string($_POST['short_desc']);
		$product_image = escape_string($_FILES['file']['name']);
		$image_temp_location = escape_string($_FILES['file']['tmp_name']);

		move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);

		try{
			$sql = "INSERT INTO products (product_title,product_category_id,product_price,product_description,short_desc,product_quantity,product_image) VALUES (:product_title, :product_category_id, :product_price, :product_description, :short_desc, :product_quantity, :product_image)";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':product_title',$product_title);
			$stmt->bindParam(':product_category_id',$product_category_id);
			$stmt->bindParam(':product_price',$product_price);
			$stmt->bindParam(':product_description',$product_description);
			$stmt->bindParam(':short_desc',$short_desc);
			$stmt->bindParam(':product_quantity',$product_quantity);
			$stmt->bindParam(':product_image',$product_image);
			$stmt->execute();
			$lastId = intval($conn->lastInsertId());
			set_message("New Product with id {$lastId} Just Added");
			//redirect("index.php?products");
		}catch (\Exception $e){
			throw $e;
		}
	}
}


/***********************FRONT END FUNCTIONS******************/
