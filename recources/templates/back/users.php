
                    <div class="col-lg-12">


                        <h1 class="page-header">
                            Users

                        </h1>
                          <p class="bg-success">
                            <?php  display_message(); ?>
                        </p>

                        <a href="add_user.php" class="btn btn-primary">Add User</a>


                        <div class="col-md-12">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php  display_users_in_admin(); ?>
                                </tbody>
                            </table> <!--End of Table-->


                        </div>











                    </div>
