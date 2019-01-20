<?php
class Admin{
    function __construct(){
        @session_start();
    }

    function getUserTable($users){

        ?>
        <form action="" method="post" enctype="multipart/form-data">
        <div class="col-md-12">
            <h4>Users:</h4>
            <div class="table-responsive">


                <table id="mytable" class="table table-bordred table-striped">

                    <thead>

                    <tr>
                        <th>Name</th>
                        <th>Login</th>
                        <th>E-mail</th>
                        <th>Organisation</th>
                        <th>User role</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($users as $key){

                        ?>
                        <tr>

                            <td><?php echo $key["name"];?></td>
                            <td><?php echo $key["login"];?></td>
                            <td><?php echo $key["email"];?></td>
                            <td><?php echo $key["org"];?></td>
                            <td>
                                <select name="role">
                                    <option value="1" <?php if($key["user_role_id"] == 1) echo "selected";?>>Administrator</option>;
                                    <option value="2" <?php if($key["user_role_id"] == 2) echo "selected";?>>Author</option>;
                                    <option value="3" <?php if($key["user_role_id"] == 3) echo "selected";?>>Reviewer</option>;
                                </select>
                            </td>

                        </tr>
                        <?php
                    }

                    ?>
                    </tbody>

                </table>

                <input type="hidden" name="action" value="saveadm">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="save">Save</button>
                </div>
            </div>

        </div>

        </form>
        <script>
            $(document).ready(function(){
                $('button').on('click', function(){
                    window.location.href = $(this).attr('data-target');
                });
            });


        </script>



        <?php


    }
}
