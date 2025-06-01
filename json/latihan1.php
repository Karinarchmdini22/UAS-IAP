<?php

// $mahasiswa = [
//     [
//     "nama" => "karina",
//     "telp" => "0822",
//     "email" => "karina@gmail"
//     ],
//     [
//     "nama" => "ara",
//     "telp" => "0822",
//     "email" => "ara@gmail" 
//     ]
// ];

$dbh = new PDO('mysql:host=localhost;dbname=phpdasar', 'root',
 '');
$db = $dbh->prepare('SELECT * FROM mahasiswa');
$db->execute();
$mahasiswa = $db->fetchAll(PDO::FETCH_ASSOC);

$data = json_encode($mahasiswa);
echo  $data;

?>