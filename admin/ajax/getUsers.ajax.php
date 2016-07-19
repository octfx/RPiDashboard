<?php
    require_once '../inc/init.php';
    $table = '
    <table class="table table-responsive">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Farbe</th>
        </tr>';
    $query = '  SELECT  user_id,
                        user_name,
                        user_color,
                        CONCAT("#", user_color) as color
                FROM    ' . TODO_USER_TABLE;
    $userObj = $DB->query($query,4);

    if (!empty($_POST['type']) && $_POST['type'] == 'table'){
        foreach ($userObj as $user) {
            $table .= '<tr>
                <td>' .  $user['user_id'] . '</td>
                <td>' .  $user['user_name'] . '</td>
                <td style="background-color:' . $user['color'] . ';"></td>
            </tr>';
        }
        $table .='</table>';
    }else{
        $table = '';
        foreach ($userObj as $user) {
            $table .= '<option value="' .  $user['user_id'] . '">' .  $user['user_name'] . '</option>';
        }
    }

    echo json_encode(array('code'=>0, 'data'=>$table));
?>
