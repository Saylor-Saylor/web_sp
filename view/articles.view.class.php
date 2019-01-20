<?php
class Articles
{
    function __construct()
    {
        @session_start();
    }

    function getAllArticles($articlesarr, $user_flag, $id_user)
    {
        ?>

        <div class="col-md-12">
            <h4>All articles</h4>
            <div class="table-responsive">


                <table id="mytable" class="table table-bordred table-striped">

                    <thead>

                    <tr>
                        <th>Title</th>
                        <th>Autors</th>
                        <th>Read</th>
                        <?php
                        if($user_flag == 2) {

                            ?>

                            <th>Edit</th>
                            <th>Status</th>
                         <?php
                        }

                        ?>
                        <?php
                        if($user_flag == 3) {

                            ?>
                            <th>Review</th>
                            <?php
                        }

                        ?>
                        <?php
                        if($user_flag == 1) {

                            ?>
                            <th>Manage</th>
                            <th>State</th>

                            <?php
                        }

                        ?>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($articlesarr as $key){

                        ?>
                    <tr>

                        <td><?php echo $key["title"];?></td>
                        <td><?php echo $key["autors"];?></td>
                        <td>
                            <p data-placement="top" data-toggle="tooltip" title="Read">
                                <button class="btn btn-primary btn-xs" data-title="Read" data-toggle="modal"
                                        data-target="index.php?page=article&articleid=<?php echo $key["id"];?>"><span class="glyphicon glyphicon-folder-open"></span></button>
                            </p>
                        </td>
                        <?php
                        if($user_flag == 2 && $key["user_id"] == $id_user) {

                        ?>
                        <td>
                            <p data-placement="top" data-toggle="tooltip" title="Edit">
                                <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal"
                                        data-target="index.php?page=newarticle&action=edit&articleid=<?php echo $key["id"];?>"><span class="glyphicon glyphicon-pencil"></span></button>
                            </p>
                        </td>
                            <td><?php
                                switch ($key["state"]){
                                    case 0: echo "Wait";
                                        break;
                                    case 1: echo "Ok";
                                        break;
                                    case 2: echo "Delete";
                                        break;
                                }


                                ?></td>
                            <?php
                        } else if ($user_flag == 2){

                        ?>
                            <td>

                            </td>
                            <td>

                            </td>

                            <?php
                        }


                        ?>

                        <?php
                        if($user_flag == 3) {

                            ?>
                            <td>
                                <p data-placement="top" data-toggle="tooltip" title="Review">
                                    <button class="btn btn-primary btn-xs" data-title="Review" data-toggle="modal"
                                            data-target="index.php?page=review&articleid=<?php echo $key["id"];?>"><span class="glyphicon glyphicon-pencil"></span></button>
                                </p>
                            </td>
                            <?php
                        }

                        ?>

                        <?php
                        if($user_flag == 1) {

                            ?>
                            <td>
                                <p data-placement="top" data-toggle="tooltip" title="Manage">
                                    <button class="btn btn-primary btn-xs" data-title="Review" data-toggle="modal"
                                            data-target="index.php?page=manage&articleid=<?php echo $key["id"];?>"><span class="glyphicon glyphicon-pencil"></span></button>
                                </p>
                            </td>
                            <td><?php
                                switch ($key["state"]){
                                    case 0: echo "Wait";
                                    break;
                                    case 1: echo "Ok";
                                        break;
                                    case 2: echo "Delete";
                                        break;
                                }




                            ?></td>
                            <?php
                        }

                        ?>
                    </tr>
                    <?php
                    }

                    ?>
                    </tbody>

                </table>


            </div>

        </div>
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
?>