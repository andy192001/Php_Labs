<?php
$parsed_data = array();

$curl=curl_init("http://gismeteo.ua/ua/city/hourly/4944/"); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($curl, CURLOPT_MAXREDIRS, 5);
$out = curl_exec($curl);
$doc = new DOMDocument();
$doc->loadHTML($out);
$finder = new DOMXPath($doc);
$city = $finder->query('//div[@class="breadcrumbs-links"]/a[last()]');
$times = $finder->query('//div[@class="widget widget-weather widget-oneday"]//div[@class="widget-row widget-row-time"]/div[@class="row-item"]/span');
$temperature_c = $finder->query('//span[@class="unit unit_temperature_c"]');
$astro_sun = $finder->query('//div[@class="astro-sun"]');
$parsed_data["hours"] = array();
$parsed_data["temperature_c"] = array();
for($i = 0; $i < $times->length; $i++){
    $nodeValue = $times->item($i)->nodeValue;
    array_push($parsed_data["hours"], substr($nodeValue, 0, strlen($nodeValue) - 2) . ":" . substr($nodeValue, strlen($nodeValue) - 2, 2)); 
    array_push($parsed_data["temperature_c"], $temperature_c->item($i)->nodeValue); 
}

function recursiveDomNodePrint(DOMNode $node) {
    if($node->hasChildNodes()){
        $list = $node->childNodes;
        $it = $list->getIterator();
        $it->rewind();
        while($it->valid()){
            $child = $it->current();
            recursiveDomNodePrint($child);
            $it->next();
        }
    }
    else {
        echo("<p>" . $node->textContent . " </p>" );
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 5</title>
</head>
<body>
    <h1><?php echo($city->item(0)->nodeValue) ?></h1>

    <?php recursiveDomNodePrint($astro_sun->item(0)) ?>
    <table>
        <tr>
            <th style="border: 1px solid black;">þÁÓ</th>
            <?php foreach($parsed_data["hours"] as $hour): ?>
                <td style="border: 1px solid black;"><?php echo $hour?></td>
            <?php endforeach; ?>

        </tr>
        <tr>
            <th style="border: 1px solid black;">ôÅÍÐÅÒÁÔÕÒÁ</th >
            <?php foreach($parsed_data["temperature_c"] as $temperature): ?>
                <td style="border: 1px solid black;"><?php echo $temperature?></td>
            <?php endforeach; ?>
        </tr>
    </table>
   </body>
</html>