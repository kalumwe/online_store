<?php
/*PHP Solution 8-9: Extracting Data from JSON*/

$json = file_get_contents('./data/film_locations.json');
$data = json_decode($json, true);

$col_names = array_column($data['meta']['view']['columns'], 'name');

$locations = [];
foreach ($data['data'] as $datum) {
$locations[] = array_combine($col_names, $datum);
}

$search = 'chaplin'; //value to search
$getLocation = function ($location) use ($search) {
return (stripos($location['Actor 1'], $search) !== false); //(212) change key to search value in

};



$filtered = array_filter($locations, $getLocation);
echo '<ul>';
foreach ($filtered as $item) {
echo "<li>{$item['Title']}, {$item['Actor 1']}({$item['Release Year']}) filmed at
{$item['Locations']}</li>";
}
echo '</ul>';

/*echo '<pre>';
print_r($locations);
echo '</pre>';*/