<?php require_once("../../recources/config.php"); ?>
<?php include(TEMPLATE_BACK . "/header.php"); ?>
        <div id="page-wrapper">

            <div class="container-fluid">


                <!-- /.row -->

                 <!-- FIRST ROW WITH PANELS -->

                <!-- /.row -->
                <?php
                if($_SERVER['REQUEST_URI'] ==  "/ecom/public/admin/" || $_SERVER['REQUEST_URI'] == "/ecom/public/admin/index.php") {
                    include(TEMPLATE_BACK . "/admin_content.php");
                }


                   if(isset($_GET['orders'])){
                   //require_once __DIR__ . '/../../resources/templates/back/orders.php';
                    include(TEMPLATE_BACK . "/orders.php");
                }

                if(isset($_GET['products'])){
                    include(TEMPLATE_BACK . "/products.php");
                }
                if(isset($_GET['addProduct'])){
                    include(TEMPLATE_BACK . "/add_product.php");
                }
                if(isset($_GET['categories'])){
                    include(TEMPLATE_BACK . "/categories.php");
                }
                if(isset($_GET['edit_product'])){
                    include(TEMPLATE_BACK . "/edit_product.php");
                }
                if(isset($_GET['users'])){
                  include(TEMPLATE_BACK . "/users.php");
                }

                if(isset($_GET['add_user'])){
                  include(TEMPLATE_BACK . "/add_user.php");
                }
                if(isset($_GET['reports'])){
                  include(TEMPLATE_BACK . "/reports.php");
                }
                ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php include(TEMPLATE_BACK . "/footer.php"); ?>
