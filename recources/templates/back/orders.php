
        <div class="col-md-12">
<div class="row">
<h1 class="page-header">
   All Orders

</h1>
</div>
<h4 class="bg bg-success"><?php display_message();?></h4>
<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>id</th>
           <th>Amount</th>
           <th>Transaction</th>
           <th>Currency</th>
           <th>Status</th>
      </tr>
    </thead>
    <tbody>
        <?php process_transaction() ?>
    </tbody>
</table>
</div>


