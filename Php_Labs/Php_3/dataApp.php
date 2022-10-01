<?php
    $napr = $_POST["directions"];
    echo $napr . "<br>";

    $filePath = "data.txt";
    $file = fopen($filePath, 'r');

    $headers = array();
    array_push($headers, "N", "Середній бал на бюджет", "Кількість встіпників на бюджет", "Недобір", "Кількість контрактників", "ВНЗ");

    $universityList = array();
    while(!feof($file)){
        if(fgets($file) == $napr){
            $len = intval(preg_replace("/\D/",'', fgets($file)));
            for($k = 1; $k <= $len; $k++){

                $avarageGrade = fgets($file);
                $budgetCount = fgets($file);
                $contracts = fgets($file);
                $shortfall = '-';
                $name = fgets($file);

                if($contracts <= 0){
                    $shortfall = $contracts;
                    $contracts = '-';
                }
                $universityData = array();
                array_push($universityData, $k, $avarageGrade, $budgetCount, $shortfall, $contracts, $name);
                array_push($universityList, $universityData);
            }
        }
    }
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
    <table border="1">
        <tr>
            <?php foreach ($headers as $header): ?>
                <th><?php echo $header; ?></th>
                    <?php endforeach; ?>
        </tr>
            <?php for ($i = 0; $i < count($universityList); $i++): ?>
                <tr>
                    <?php for ($j = 0; $j < 6; $j++): ?>
                     <td><?php echo $universityList[$i][$j]; ?></td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
    </table>
</body>
</html>