<?php
class Article
{
    function __construct()
    {
        @session_start();
    }

    function getArticle($content){

    ?>

        <main role="main" class="container">
            <h1 class="mt-5"><?php echo $content["title"];?></h1>
            <h3 class="mt-5"><?php echo $content["autors"];?></h3>
            <p class="lead"><?php echo $content["abstract"];?></p>
           <?php
            if($content["file_name"] != null){
                ?>
                <a href="uploads/<?php echo $content["file_name"];?> ">PDF</a>
                <?php
            }


            ?>
        </main>



     <?php


    }
}
?>