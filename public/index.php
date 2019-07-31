<?php require_once("../recources/config.php");

 include(TEMPLATE_FRONT . DS . "header.php");
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Categories here -->
           <?php include(TEMPLATE_FRONT . DS . "side_nav.php"); ?>
            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <?php include(TEMPLATE_FRONT . DS . "slider.php"); ?>
                    </div>

                </div>

                <div class="row">

                <?php get_products() ?>
                    

                </div> <!-- end of row -->

            </div>

        </div>

    </div>
    <!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . "footer.php");
?>
