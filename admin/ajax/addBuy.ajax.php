<?php
    require_once '../inc/init.php';
    if (!empty($_POST['item']) && !empty($_POST['quantity']) && !empty($_POST['user_buy'])){
        $quantity = $sql->real_escape_string(intval($_POST['quantity']));
        $user_buy = $sql->real_escape_string(intval($_POST['user_buy']));
        $item     = $sql->real_escape_string($_POST['item']);
        $query    = 'INSERT INTO ' . BUY_TABLE . '(item_name, item_quantity, item_user)
                     VALUES ("' . $item . '", ' . $quantity . ', ' . $user_buy . ');';
        $result = $DB->query($query,0);
        if ($result){
            echo json_encode(array('code'=>200));
        }else{
            echo json_encode(array('code'=>500));
        }
    }
?>
