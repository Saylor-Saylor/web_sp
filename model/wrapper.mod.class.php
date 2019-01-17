<?php

class Wrapper{

    function getWrapper($file){
        //http://php.net/manual/en/function.ob-start.php
        ob_start();
        if (file_exists($file) && !is_dir($file)) {
            include($file);
        }
        return ob_get_clean();
    }
}