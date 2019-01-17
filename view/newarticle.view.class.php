<?php
class newArticle{
    function __construct()
    {
        @session_start();
    }

    function getAdded(){
        ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Well don!</strong> Your article was added.
        </div>

        <?php
    }

    function getEdited(){
        ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Well don!</strong> Your article was edit.
        </div>

        <?php
    }
    function getError(){
        ?>
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Ops!</strong> something was wrong, please, try again.
        </div>

        <?php
    }

    function getArticleForm(){
        ?>

        <div class="form-group">
            <form action="" method="post" enctype="multipart/form-data">
                <h2 class="text-center">Create new article</h2>
                <div class="form-group">
                    <input type="text" class="form-control" name="title" placeholder="Title" required="required">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="autors" placeholder="Autors" required="required">
                </div>
                <div class="form-group">
                    <label for="abstract">Abstract:</label>
                    <textarea class="form-control" rows="5" id="abstract" name="abstract" required="required"></textarea>
                </div>
                <div class="form-group">
                    <input type="file" class="form-control-file" name="file">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="add">Add</button>
                </div>
                <input type="hidden" name="action" value="addarticle">
            </form>
            <p class="text-center"><a href="index.php?page=articles">See all articles</a></p>

        </div>
        <?php
    }

    function getEditArticleForm($curr_article){
        ?>

        <div class="form-group">
            <form action="" method="post" enctype="multipart/form-data">
                <h2 class="text-center">Edit article</h2>
                <div class="form-group">
                    <input type="text" class="form-control" name="title" placeholder="Title" required="required" value="<?php echo $curr_article["title"]?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="autors" placeholder="Autors" required="required" value="<?php echo $curr_article["autors"]?>">
                </div>
                <div class="form-group">
                    <label for="abstract">Abstract:</label>
                    <textarea class="form-control" rows="5" id="abstract" name="abstract" required="required" ><?php echo $curr_article["abstract"]?></textarea>
                </div>
                <div class="form-group">
                    <input type="file" class="form-control-file" name="file">
                </div>
                <?php if($curr_article["file_name"] != null){?>
                <div class="form-group">
                    <a href="uploads/<?php echo $curr_article["file_name"]?>">PDF</a>
                </div>
                <?php }?>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="save">Save</button>
                </div>
                <input type="hidden" name="action" value="savearticle">
                <input type="hidden" name="articleId" value="<?php echo $curr_article["id"]?>">
                <input type="hidden" name="old_file" value="<?php echo $curr_article["file_name"]?>">
            </form>
            <p class="text-center"><a href="index.php?page=articles">See all articles</a></p>

        </div>
        <?php
    }

}