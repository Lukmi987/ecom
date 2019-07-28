<div class="col-md-3">
                <p class="lead">Shop Name</p>
                <div class="list-group">
                    <?php 
                    try{
                    $sql = "SELECT cat_title FROM categories";
                    	 $stmt = $conn->prepare($sql); 
                    	 $stmt->execute();
                    	 $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
					foreach ( $result as $row) {
							
							echo "<a href='' class='list-group-item'>{$row['cat_title']}</a>";
						}
					} catch (\Exception $e){
						throw $e;
					}	
                    	
                    ?>
                    <a href="category.html" class="list-group-item">Category 1</a>
                    <a href="#" class="list-group-item">Category 2</a>
                    <a href="#" class="list-group-item">Category 3</a>
                </div>
            </div>
