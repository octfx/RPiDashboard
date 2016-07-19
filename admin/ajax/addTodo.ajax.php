<?php
    require_once '../inc/init.php';
    if (!empty($_POST['todoname']) && !empty($_POST['user_todo'])){
        $user_todo = $sql->real_escape_string(intval($_POST['user_todo']));
        $todoname     = $sql->real_escape_string($_POST['todoname']);
        $query    = 'INSERT INTO ' . TODO_TABLE . '(todo_text, todo_done, todo_user_id)
                     VALUES ("' . $todoname . '", 0, ' . $user_todo . ');';
        $result = $DB->query($query,0);
        if ($result){
            echo json_encode(array('code'=>200));
        }else{
            echo json_encode(array('code'=>500));
        }
    }
?>
