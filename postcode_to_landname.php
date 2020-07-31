<?php



/*

postcode	long	lat
800	130.83668	-12.458684
801	130.83668	-12.458684
804	130.873315	-12.428017
810	130.866242	-12.381806
810	130.866242	-12.381806
810	130.866242	-12.381806
810	130.8502369	-12.39614166
810	130.866242	-12.381806
810	130.866242	-12.381806
810	130.8885151	-12.35911956
810	130.866242	-12.381806
810	130.866242	-12.381806
810	130.8959029	-12.35811947


land	long	lat
Ngameni	139.0833333	26.83333333
Araba	142.1666667	17.16666667
Kakadu	133	12.58333333
Wenamba	128.8333333	23.83333333

*/
$earthRadius = 6371000;
$earthCirc = pi() * $earthRadius * 2;
// echo $earthCirc;



$postcodes = array();

if (($handle = fopen("postcode.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        // $postcode = $data[0];
        // $long = $data[1];
        // $lat = $data[2];
        array_push($postcodes, $data);

    }
    fclose($handle);
}


$lands = array();


if (($handle = fopen("lands.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        // $postcode = $data[0];
        // $long = $data[1];
        // $lat = $data[2];
        array_push($lands, $data);

    }
    fclose($handle);
}


foreach ($postcodes as $postcode)
{
    $closestDistance = $earthCirc;
    foreach ($lands as $land)
    {
        $distance = vincentyGreatCircleDistance(floatval($postcode[1]), floatval($postcode[2]), floatval($land[1]), floatval($land[2]), $earthRadius);
        // echo $distance;
        if ($distance < $closestDistance)
        {
            $closestDistance = $distance;
            $closestLocation = $land;
        }
        // echo $land[0] . ": " . $distance . "m<BR />";
    }
    // echo $closestLocation[0] . " is closest to " . $postcode[0] . " at: " . floor($closestDistance/1000) . "km<BR />";
    echo $postcode[0] . "," . $closestLocation[0] . "," . $closestLocation[1] . "," . $closestLocation[2] . "<BR />";
}



/*
For test postcode 800
Ngameni:    4458941.3879338m
Araba:      3521436.6351395m
Kakadu:     2794750.9093626m
Wenamba:    4041360.6662374m
*/


// Thanks martinstoeckli https://stackoverflow.com/a/10054282
function vincentyGreatCircleDistance($longitudeFrom, $latitudeFrom, $longitudeTo, $latitudeTo, $earthRadius)
  {
    // convert from degrees to radians
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);
  
    $lonDelta = $lonTo - $lonFrom;
    $a = pow(cos($latTo) * sin($lonDelta), 2) +
      pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
    $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);
  
    $angle = atan2(sqrt($a), $b);
    return $angle * $earthRadius;
  }






?>