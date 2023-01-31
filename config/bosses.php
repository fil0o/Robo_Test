<?php
    require_once "connect.php";

    $sql_bosses = "select \n"

    . "CONCAT_WS(\" \", user.first_name, USER.middle_name, USER.last_name) as ФИО, \n"

    . "position.name, \n"

    . "m.dt, \n"

    . "user_dismission.created_at as dt_d,\n"

    . "dismission_reason.description as d_ds,\n"

    . "position.salary, \n"

    . "n.fio as nach\n"

    . "FROM department as d\n"

    . "Join (SELECT department_id, MAX(created_at) as dt FROM `user_position` GROUP by department_id) as m\n"

    . "on d.id = m.department_id\n"

    . "join user_position on user_position.created_at = m.dt and user_position.department_id = m.department_id\n"

    . "join user on user_position.user_id = user.id\n"

    . "LEFT join user_dismission on user.id = user_dismission.user_id\n"

    . "LEFT join dismission_reason on user_dismission.reason_id = dismission_reason.id\n"

    . "join position on user_position.position_id = position.id\n"

    . "\n"

    . "join (SELECT CONCAT_WS(\" \", user.first_name, USER.middle_name, USER.last_name) as fio, \n"

    . "department.id as id_dep\n"

    . "FROM `user`\n"

    . "join user_position on user.id = user_position.user_id\n"

    . "join department on user_position.department_id = department.id\n"

    . "WHERE department.leader_id = user.id) as n \n"

    . "on d.id = n.id_dep;";

    $data_b = mysqli_query($connect, $sql_bosses);

    $data = mysqli_fetch_all($data_b);
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