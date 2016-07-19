<?php
    require_once '../inc/init.php';
    $table = '
    <table class="table table-responsive">
        <tr>
            <th>ID</th>
            <th>Aufgabe</th>
            <th>Zu erledigen von</th>
            <th>Erledigt</th>
        </tr>';
    $query = '  SELECT  todo_id,
                        todo_done,
                        todo_text,
                        user_name,
                        user_color
                FROM    ' . TODO_TABLE . ' tt
                JOIN    ' . TODO_USER_TABLE . ' tut
                ON      tt.todo_user_id = tut.user_id
                WHERE todo_done = 0';
    $todoObj = $DB->query($query,4);
    if (!empty($_POST['type']) && $_POST['type'] == 'table'){
        foreach ($todoObj as $todo) {
            $color = $todo['todo_done']==1?'#77b300':'#cc0000';
            $table .= '<tr>
                <td>' .  $todo['todo_id'] . '</td>
                <td>' .  $todo['todo_text'] . '</td>
                <td>' .  $todo['user_name'] . '</td>
                <td><button type="button" name="button" class="mark_done btn btn-success btn-xs" data-id="' .  $todo['todo_id'] . '"><i class="glyphicon glyphicon-ok"></i></button></td>
            </tr>';
        }
        $table .='<tr><td colspan="4"><button type="button" name="button" class="btn btn-block btn-default" id="showTodoModal">ToDo hinzufügen</button></td></tr></table>';
    }else{
        $table = '<ul class="list-unstyled">';
        $i=0;
        foreach ($todoObj as $todo) {
            if ($i==round(count($todoObj)/2)){
                //$table .= '</ul><ul class="list-unstyled col-md-6">';
            }
            $color = $todo['todo_done']==1?'#77b300':'#cc0000';
            $table .= '<li>' . $todo['todo_text'] . '<span class="label pull-right" style="background-color:#' . $todo['user_color'] . ';">' . $todo['user_name'] . '</span></li>';
            $i++;
        }
        $table .='</ul>';
    }

    echo json_encode(array('code'=>0, 'data'=>$table));
?>
