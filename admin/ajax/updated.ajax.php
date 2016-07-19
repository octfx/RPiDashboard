<?php
    if (file_exists('/var/www/vhtdocs/foxdev.io/dashboard/update')){
        if (unlink('/var/www/vhtdocs/foxdev.io/dashboard/update')){
            echo json_encode(array('code'=>200));
        }else{
            echo json_encode(array('code'=>500));
        }
    }
?>
