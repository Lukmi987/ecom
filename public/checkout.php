<?php require_once("../recources/config.php"); ?>
 <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

  <?php
  //if(isset($_SESSION['product_1'])){
    //print_r($_SESSION['product_1']);

  // echo $_SESSION['item_total'];
  // echo "  ";
  // echo $_SESSION['item_quantity'];

?>
    <!-- Page Content -->
    <div class="container">


<!-- /.row -->

<div class="row">

      <h1>Checkout</h1>

  <h4 class="text-center bg-danger"><?php display_message();?></h4>


  <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_cart">
  <input type="hidden" name="business" value="komprsbusiness@gmail.com">
  <input type="hidden" name="currency_code" value="USD">
  <input type="hidden" name="upload" value="1">
    <table class="table table-striped">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Sub-total</th>

          </tr>
        </thead>
        <tbody>
            <tr>
               <?php cart(); ?>

            </tr>
        </tbody>
    </table>

<?php echo show_paypal(); ?>
</form>



<!--  ***********CART TOTALS*************-->

<div class="col-xs-4 pull-right ">
<h2>Cart Totals</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount">
  <?php
  echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = "0"; //Ternary OperatorThe expression (expr1) ? (expr2) : (expr3) evaluates to expr2 if expr1 evaluates to TRUE, and expr3 if expr1 evaluates to FALSE.
?>
</span></td>
</tr>
<tr class="shipping">
<th>Shipping and Handling</th>
<td>Free Shipping</td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount">&#36
<?php
  echo isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = "0";
?>
</span></strong> </td>
</tr>


</tbody>

</table>

</div><!-- CART TOTALS-->


 </div><!--Main Content-->


<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>
