<?php
class Review
{
    function __construct()
    {
        @session_start();
    }


    function getAdded(){
        ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Well don!</strong> Your review was added.
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

    function getReview($content){

        ?>

        <div class="form-group">
            <form action="" method="post" enctype="multipart/form-data">
                <h2 class="text-center">Name ot the article: <?php echo $content["title"]?></h2>
                <div class="form-group">
                    <label for="origin">Originality:</label>
                    <select class="form-control" id="origin" name="origin">
                        <option <?php if($content["origin"] != null && $content["origin"] == 1) echo "selected";?>>1 = Plagiarism</option>
                        <option <?php if($content["origin"] != null && $content["origin"] == 2) echo "selected";?>>2 = Only a few original ideas</option>
                        <option <?php if($content["origin"] != null && $content["origin"] == 3) echo "selected";?>>3 = Half the text is original</option>
                        <option <?php if($content["origin"] != null && $content["origin"] == 4) echo "selected";?>>4 = Almost completely original</option>
                        <option <?php if($content["origin"] != null && $content["origin"] == 5) echo "selected";?>>5 = Completely original</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="theme">Theme:</label>
                    <select class="form-control" id="theme" name="theme">
                        <option <?php if($content["theme"] != null && $content["theme"] == 1) echo "selected";?>>1 = Not relevant to this conference</option>
                        <option <?php if($content["theme"] != null && $content["theme"] == 2) echo "selected";?>>2 = Has little to do with this conference</option>
                        <option <?php if($content["theme"] != null && $content["theme"] == 3) echo "selected";?>>3 = Medium quality</option>
                        <option <?php if($content["theme"] != null && $content["theme"] == 4) echo "selected";?>>4 = Good</option>
                        <option <?php if($content["theme"] != null && $content["theme"] == 5) echo "selected";?>>5 = Gorgeous</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tech">Technical quality:</label>
                    <select class="form-control" id="tech" name="tech">
                        <option <?php if($content["tech"] != null && $content["tech"] == 1) echo "selected";?>>1 = Not quality</option>
                        <option <?php if($content["tech"] != null && $content["tech"] == 2) echo "selected";?>>2 = Poor quality</option>
                        <option <?php if($content["tech"] != null && $content["tech"] == 3) echo "selected";?>>3 = Medium quality</option>
                        <option <?php if($content["tech"] != null && $content["tech"] == 4) echo "selected";?>>4 = Good</option>
                        <option <?php if($content["tech"] != null && $content["tech"] == 5) echo "selected";?>>5 = Gorgeous</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="lang">Language quality:</label>
                    <select class="form-control" id="lang" name="lang">
                        <option <?php if($content["lang"] != null && $content["lang"] == 1) echo "selected";?>>1 = Not quality</option>
                        <option <?php if($content["lang"] != null && $content["lang"] == 2) echo "selected";?>>2 = OPoor quality</option>
                        <option <?php if($content["lang"] != null && $content["lang"] == 3) echo "selected";?>>3 = Medium quality</option>
                        <option <?php if($content["lang"] != null && $content["lang"] == 4) echo "selected";?>>4 = Good</option>
                        <option <?php if($content["lang"] != null && $content["lang"] == 5) echo "selected";?>>5 = Gorgeous</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="recom">Final solution:</label>
                    <select class="form-control" id="recom" name="recom">
                        <option <?php if($content["recom"] != null && $content["recom"] == 1) echo "selected";?>>1 = Not to accept</option>
                        <option <?php if($content["recom"] != null && $content["recom"] == 2) echo "selected";?>>2 = Rather not take</option>
                        <option <?php if($content["recom"] != null && $content["recom"] == 3) echo "selected";?>>3 = Can accept</option>
                        <option <?php if($content["recom"] != null && $content["recom"] == 4) echo "selected";?>>4 = To accept</option>
                        <option <?php if($content["recom"] != null && $content["recom"] == 5) echo "selected";?>>5 = Accept anyway</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="comm">Comments:</label>
                    <textarea class="form-control" rows="5" id="abstract" name="comm" ><?php if($content["comm"] != null) echo $content["comm"];?></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="save">Save</button>
                </div>
                <input type="hidden" name="action" value="savereview">
                <input type="hidden" name="reviewId" value="<?php echo $content["id"]?>">
            </form>
            <p class="text-center"><a href="index.php?page=articles">See all articles</a></p>

        </div>



        <?php


    }
}
?>