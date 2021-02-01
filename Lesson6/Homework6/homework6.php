<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <pre>
        <?php var_dump($_POST); ?>
    </pre>
    <hr>
    <h3>checkbox</h3>
    <form action="homework6.php" method="post"> Вам нужен доступ в интернет?
        <input type="checkbox" name="formWheelchair" value="Yes">
        <input type="submit" name="formSubmit" value="Submit" >
    </form>
    <?php if(isset($_POST['formWheelchair']) && $_POST['formWheelchair'] == 'Yes') {
        echo "Требуется доступ.";
    } else { echo "Доступ не нужен."; }
    ?>
    <hr>

    <h3>group of checkboks</h3>
    <form action="homework6.php" method="post">Выберите здания, которые необходимо посетить. <br>
        <input type="checkbox" name="formDoor[]" value="A">Acorn Building<br>
        <input type="checkbox" name="formDoor[]" value="B">Brown Hall<br>
        <input type="checkbox" name="formDoor[]" value="C">Carnegie Complex<br>
        <input type="checkbox" name="formDoor[]" value="D">Drake Commons<br>
        <input type="checkbox" name="formDoor[]" value="E">Elliot House
        <input type="submit" name="formSubmit" value="Submit">
    </form>
    <?php if (isset($_POST['formDoor'])) $aDoor = $_POST['formDoor'];
            if(empty($aDoor)) {
                echo("Вы ничего не выбрали.");
            } else {
                $N = count($aDoor);
                echo("Вы выбрали $N здание(й): ");
                for($i=0; $i < $N; $i++) {
                    echo($aDoor[$i] . " ");
                }
            }
    ?>
    <hr>

    <h3>drop down list</h3>
    <form method="post" action="homework6.php">
        <select name="selectitem">
            <option value="option 1">Option 1</option>
            <option value="option 2">Option 2</option>
            <option value="option 3">Option 3</option>
        </select>
        <input type="submit" value="send">
    </form>

    <hr>

    The PHP
    <?php
    if (isset($_POST['selectitem'])) print $_POST['selectitem'];
    ?>

    <hr>

    <form method="post" action="homework6.php">
        <input type="radio" name="radio" value="yes"
               class="radio" />yes
        <input type="radio" name="radio" value="no"
               class="radio" />no
        <input type="submit" value="send">
    </form>
    <?php
    print $_POST['radio'];
    ?>




</body>
</html>
<style>
    table, tr, td {
        border: 1px solid black;
        padding: 5px;
    }
</style>