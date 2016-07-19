<?php
    require_once '../inc/init.php';
    if (!empty($_POST['itemid'])){
        $itemid = $sql->real_escape_string(intval($_POST['itemid']));
        $query    = 'UPDATE ' . TODO_TABLE . ' SET todo_done = 1 WHERE todo_id = ' . $itemid;
        $result = $DB->query($query,0);
        if ($result){
            echo json_encode(array('code'=>200));
        }else{
            echo json_encode(array('code'=>500));
        }
    }
?>
