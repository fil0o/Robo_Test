<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Тестовое задание</title>
</head>
<script>
    function showData(query){
        if (window.XMLHttpRequest) {
            // код для IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else {
            // код для IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("data").innerHTML = this.responseText;
            }
        }

        xmlhttp.open("POST", `config/${query}.php`, true);
        xmlhttp.send();

    }
</script>
<body>
    <h2>Отдел кадров</h2>
    <div class="btn_container">
        <button onclick="showData(this.value)" value="trial_period">Испытательный срок</button>
        <button onclick="showData(this.value)" value="dismissed">Уволенные</button>
        <button onclick="showData(this.value)" value="bosses">Начальники</button>
    </div>
    <div class="container">
        
        <table>
            <tr>
                <th>ФИО</th>
                <th>Должность</th>
                <th>Дата приема на работу</th>
                <th>Дата увольнения</th>
                <th>Причина увольнения</th>
                <th>Размер заработной платы</th>
                <th>Начальник</th>
            </tr>
            <tbody id="data">
            
            </tbody>
            
        </table>
    </div>


    
</body>
</html>