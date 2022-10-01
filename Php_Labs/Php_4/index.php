<?php
    $fileName = "oblinfo.txt";
    $file = fopen($fileName, 'r');
    $length = fgets($file);    
    $oblastList = array();
    for($i = 0; $i < $length; $i++){
        $name = fgets($file);
        $population = fgets($file);
        $universityCount = fgets($file);
        array_push($oblastList, $name);
    }
    fclose($file);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="oblastTable.php" method="POST">
        <select name="oblast">
            <?php for($i = 0; $i < count($oblastList); $i++): ?>
                <option value='<?php echo($oblastList[$i])?>'> <?php echo $oblastList[$i]; ?> </option>
            <?php endfor; ?>
        </select>
        <input type="submit" value="Відправити запит">
    </form>
</body>
</html>