<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$response = $client->request('GET', 'http://omdbapi.com', [
    'query' => [
        'apikey' => '2336edf3',
        's' => 'transformers'

    ]

]);

$result =json_decode($response -> getBody()->getContents(), true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOvie</title>
</head>
<body>
    <?php foreach ($result['Search'] as $movie) :?>
    <ul>
        <li>Title : <?= $movie['Title']?>/li>
        <li>Year : 2007</li>
        <li>
            <img src="<?= $movie['Poster']; ?>" widht="80">

        </li>
    </ul>
    <?php endforeach;?>
</body>
</html>