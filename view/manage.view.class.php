<?php
class Manage{
    function __construct()
    {
        @session_start();
    }

    function getContent($content, $reviewers)
    {
        ?>
        <main role="main" class="container">
        <h1 class="mt-5">Name ot the article: <?php echo $content[0]["title"]?></h1>
        <h2 class="mt-5">Authors: <?php echo $content[0]["autors"];?></h2>
        <h3 class="mt-5">Reviewers:</h3>

        <div class="form-group">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="col-md-12">
                <h4>All articles</h4>
                <div class="table-responsive">


                    <table id="mytable" class="table table-bordred table-striped">

                        <thead>

                        <tr>
                            <th>Reviewer</th>
                            <th>Originality</th>
                            <th>Theme</th>
                            <th>Technical quality</th>
                            <th>Language quality</th>
                            <th>Final solution</th>

                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php if(count($content) > 0 && $content[0]["name"] && $content[0]["name"] != null){?>
                                    <td><?php echo $content[0]["name"];?></td>
                                <?php } else {?>
                                    <td>

                                        <select id="reviwer1" name="reviwer1">
                                            <option>None</option>
                                            <?php
                                            foreach ($reviewers as $key){
                                                echo "<option>".$key["name"]."</option>";
                                            }
                                            ?>
                                        </select>


                                    </td>

                                <?php }?>

                                <?php if(count($content) > 0 && $content[0]["origin"] &&  $content[0]["origin"] != null){?>
                                    <td><?php echo $content[0]["origin"];?></td>
                                    <td><?php echo $content[0]["theme"];?></td>
                                    <td><?php echo $content[0]["tech"];?></td>
                                    <td><?php echo $content[0]["lang"];?></td>
                                    <td><?php echo $content[0]["recom"];?></td>
                                <?php } else {?>
                                    <td>none</td>
                                    <td>none</td>
                                    <td>none</td>
                                    <td>none</td>
                                    <td>none</td>

                                    <?php }?>


                            </tr>
                            <tr>
                                <?php if(count($content) > 1 && $content[1]["name"] != null){?>
                                    <td><?php echo $content[1]["name"];?></td>
                                <?php } else {?>
                                    <td>

                                        <select id="reviwer2" name="reviwer2">
                                            <option value="0">None</option>
                                            <?php
                                            foreach ($reviewers as $key){
                                                echo "<option value=\"".$key["id"]."\">".$key["name"]."</option..>";
                                            }
                                            ?>
                                        </select>


                                    </td>

                                <?php }?>

                                <?php if(count($content) > 1 && $content[1]["origin"] &&  $content[1]["origin"] != null){?>
                                    <td><?php echo $content[1]["origin"];?></td>
                                    <td><?php echo $content[1]["theme"];?></td>
                                    <td><?php echo $content[1]["tech"];?></td>
                                    <td><?php echo $content[1]["lang"];?></td>
                                    <td><?php echo $content[1]["recom"];?></td>
                                <?php } else {?>
                                    <td>none</td>
                                    <td>none</td>
                                    <td>none</td>
                                    <td>none</td>
                                    <td>none</td>

                                <?php }?>


                            </tr>
                            <tr>
                                <?php if(count($content) > 2 && $content[2]["name"] != null){?>
                                    <td><?php echo $content[2]["name"];?></td>
                                <?php } else {?>
                                    <td>

                                        <select id="reviwer3" name="reviwer3">
                                            <option value="0">None</option>
                                            <?php
                                            foreach ($reviewers as $key){
                                                echo "<option value=\"".$key["id"]."\">".$key["name"]."</option..>";
                                            }
                                            ?>
                                        </select>


                                    </td>

                                <?php }?>

                                <?php if(count($content) > 2 && $content[2]["origin"] &&  $content[2]["origin"] != null){?>
                                    <td><?php echo $content[2]["origin"];?></td>
                                    <td><?php echo $content[2]["theme"];?></td>
                                    <td><?php echo $content[2]["tech"];?></td>
                                    <td><?php echo $content[2]["lang"];?></td>
                                    <td><?php echo $content[2]["recom"];?></td>
                                <?php } else {?>
                                    <td>none</td>
                                    <td>none</td>
                                    <td>none</td>
                                    <td>none</td>
                                    <td>none</td>

                                <?php }?>


                            </tr>

                        </tbody>

                    </table>


                </div>

            </div>


        <input type="hidden" name="action" value="savemanage">
        <input type="hidden" name="articleId" value="<?php echo $content[0]["id"]?>">
        <input type="hidden" name="reviewId1" value="<?php if(count($content) > 0) echo $content[0]["review_id"];?>">
            <input type="hidden" name="reviewId2" value="<?php if(count($content) > 1) echo $content[1]["review_id"];?>">
            <input type="hidden" name="reviewId3" value="<?php if(count($content) > 2) echo $content[2]["review_id"];?>">
            <div class="form-group">
                <label for="state">Final solution:</label>
                <select class="form-control" id="state" name="state">
                    <option <?php if($content[0]["state"] == 0) echo "selected";?>> 0 = Waiting</option>
                    <option <?php if($content[0]["state"] == 1) echo "selected";?>> 1 = Open</option>
                    <option <?php if($content[0]["state"] == 2) echo "selected";?>> 2 = Close</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="save">Save</button>
            </div>
        </form>

        </div>
        </main>


        <?php
    }
}
