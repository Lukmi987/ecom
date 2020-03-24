<?php add_category(); ?>
<div class="col-md-4">
  <h3 class="bg-success"><?php display_message(); ?></h3>
    <form action="" method="post">

        <div class="form-group">
            <label for="category-title">Title</label>
            <input type="text" name="title" class="form-control">
        </div>

        <div class="form-group">

            <input type="submit" name="add_category" class="btn btn-primary" value="Add Category">
        </div>


    </form>


</div>


<div class="col-md-8">

    <table class="table">
            <thead>

        <tr>
            <th>id</th>
            <th>Title</th>
        </tr>
            </thead>


    <tbody>
 <?php show_categories_in_admin(); ?>
    </tbody>

        </table>

</div>
