<?php
    require_once "connect.php";

    $sql = "SELECT CONCAT_WS(\" \", user.first_name, USER.middle_name, USER.last_name) as fio, \n"

    . "position.name as pos, \n"

    . "user.created_at as dt_pr,\n"

    . "user_dismission.created_at as dt_d,\n"

    . "dismission_reason.description as d_ds,\n"

    . "position.salary as salary,\n"

    . "n.fio as nach\n"

    . "from user\n"

    . "INNER join user_position on user.id = user_position.user_id\n"

    . "INNER join position on user_position.position_id = position.id\n"

    . "INNER join user_dismission on user.id = user_dismission.user_id\n"

    . "INNER join dismission_reason on user_dismission.reason_id = dismission_reason.id\n"

    . "INNER join department on user_position.department_id = department.id\n"

    . "\n"

    . "join (SELECT CONCAT_WS(\" \", user.first_name, USER.middle_name, USER.last_name) as fio, \n"

    . "department.id as id_dep\n"

    . "FROM `user`\n"

    . "join user_position on user.id = user_position.user_id\n"

    . "join department on user_position.department_id = department.id\n"

    . "WHERE department.leader_id = user.id) as n \n"

    . "on department.id = n.id_dep\n"
    
    . "where not dismission_reason.description in ('Умер', 'Перевод')";

    $data_d = mysqli_query($connect, $sql);

    $data = mysqli_fetch_all($data_d);
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