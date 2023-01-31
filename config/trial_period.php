<?php
    require_once "connect.php";

    //на текущую дату
    $date_tr = date('Y-m-d');

    $sql_trial = "SELECT CONCAT_WS(\" \", user.first_name, USER.middle_name, USER.last_name) as fio, \n"

    . "position.name as pos, \n"

    . "user.created_at as dt_pr,\n"

    . "user_dismission.created_at as dt_d,\n"

    . "dismission_reason.description as d_ds,\n"

    . "position.salary as salary,\n"

    . "n.fio as nach\n"

    . "from user\n"

    . "INNER join user_position on user.id = user_position.user_id\n"

    . "INNER join position on user_position.position_id = position.id\n"

    . "LEFT join user_dismission on user.id = user_dismission.user_id\n"

    . "LEFT join dismission_reason on user_dismission.reason_id = dismission_reason.id\n"

    . "INNER join department on user_position.department_id = department.id\n"

    . "\n"

    . "join (SELECT CONCAT_WS(\" \", user.first_name, USER.middle_name, USER.last_name) as fio, \n"

    . "department.id as id_dep\n"

    . "FROM `user`\n"

    . "join user_position on user.id = user_position.user_id\n"

    . "join department on user_position.department_id = department.id\n"

    . "WHERE department.leader_id = user.id) as n \n"

    . "on department.id = n.id_dep\n"

    . "WHERE DATEDIFF('$date_tr', user.created_at) BETWEEN 0 AND 90\n"
    
    . "ORDER BY `fio` ASC;";

    $data_trial = mysqli_query($connect, $sql_trial);

    $data = mysqli_fetch_all($data_trial);
        foreach($data as $d){
    ?> 
    <tr>
        <td><?=$d[0]?></td>
        <td><?=$d[1]?></td>
        <td><?=$d[2]?></td>
        <td><?=$d[3]?></td>
        <td><?=$d[4]?></td>
        <td><?=$d[5]?></td>
        <td><?=$d[6]?></td>
    </tr> 
    <?php 
        }
    ?>