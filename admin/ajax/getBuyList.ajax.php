<?php
    require_once '../inc/init.php';
    $table = '
    <table class="table table-responsive">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Anzahl</th>
            <th>Von</th>
            <th></th>
        </tr>';
    $query = '  SELECT  item_id,
                        item_name,
                        item_quantity,
                        user_name,
                        user_color
                FROM    ' . BUY_TABLE . ' bt
                JOIN    ' . TODO_USER_TABLE . ' tut
                ON      bt.item_user = tut.user_id';
    $buyObj = $DB->query($query,4);
    if (!empty($_POST['type']) && $_POST['type'] == 'table'){
        foreach ($buyObj as $todo) {
            $table .= '<tr>
                <td>' .  $todo['item_id'] . '</td>
                <td>' .  $todo['item_name'] . '</td>
                <td>' .  $todo['item_quantity'] . '</td>
                <td>' .  $todo['user_name'] . '</td>
                <td><button type="button" name="button" class="remove_item btn btn-danger btn-xs" data-id="' .  $todo['item_id'] . '"><i class="glyphicon glyphicon-remove"></i></button></td>
            </tr>';
        }
        $table .='<tr><td colspan="5"><button type="button" name="button" class="btn btn-block btn-default" id="showBuyModal">Einkauf hinzufügen</button></td></tr></table>';
    }else{
        $table = '<ul class="list-unstyled ">';
        $i=0;
        foreach ($buyObj as $todo) {
            if ($i==round(count($buyObj)/2)){
                //$table .= '</ul><ul class="list-unstyled col-md-6">';
            }
            $table .= '<li>' . $todo['item_name'] . ' x' . $todo['item_quantity'] . '<span class="label pull-right" style="background-color:#' . $todo['user_color'] . ';">' . $todo['user_name'] . '</span></li>';
            $i++;
        }
        $table .='</ul>';
    }

    echo json_encode(array('code'=>0, 'data'=>$table));
?>
