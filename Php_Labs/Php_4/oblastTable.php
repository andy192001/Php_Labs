<?php
    $oblast = trim($_POST['oblast']);
    $headers = array("Область","Населення","Кількість внз", "Кількість внз на 100тис");
    $fileName = "oblinfo.txt";
    $file = fopen($fileName, 'r');
    $len = fgets($file);    
    $oblastList = array();
    for($i = 0; $i < $len; $i++){
        $name = fgets($file);
        $population = fgets($file);
        $universityCount = fgets($file);
        $oblastList[trim($name)] = array($name, $population, $universityCount, round(($universityCount / $population) * 100, 2));
    }
    fclose($file);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <tr>
            <?php foreach ($headers as $header): ?>
                <th><?php echo $header; ?></th>
                    <?php endforeach; ?>
        </tr>
        <tr>
            <?php foreach ($oblastList[$oblast] as $oblastInfo): ?>
                <td><?php echo($oblastInfo) ?></td>
            <?php endforeach; ?>
        </tr>
    </table>
</body>
</html>