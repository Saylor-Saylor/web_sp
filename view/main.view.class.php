<?php
class Main{
    function __construct(){
        @session_start();
    }

    function getPage(){
        ?>
        <div class="jumbotron">
            <h1 class="display-3">Conference about conference</h1>
            <p class="">At this conference, you can participate in seminars on training in conference management.</p>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <h4>The language of the post</h4>
                <p>Articles may be in Czech or English</p>

                <h4>Article size</h4>
                <p>Maximum 8 pages</p>

            </div>

            <div class="col-lg-6">
                <h4>Article format</h4>
                <p>Must follow LNCS style</p>

                <h4>Article creation</h4>
                <p>The article must be downloaded in pdf format</p>

            </div>
        </div>
        <?php
    }


}
?>

