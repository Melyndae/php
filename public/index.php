<?php

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

require __DIR__.'/../vendor/autoload.php';

$config = new Configuration();
$connectionParams = [
    'driver'    => 'pdo_mysql',
    'host'      => '127.0.0.1',
    'dbname'    => 'tp-sql',
    'user'      => 'root',
    'password'  => '',
    'charset'   => 'utf8mb4',
];
$conn = DriverManager::getConnection($connectionParams, $config);

// récupération de tous les éléments de la table `item` dans un tableau PHP

/* Pour la requête SQL :
- "promotions.id AS promotionsID" p our effectuer un alias (avec AS)
- "INNER JOIN" pour effectuer la jointure suivit de "students" qui correspond à la table à joindre
- "ON" pour dire sur quelles colonnes elles sont liés (donc ici promotion_id de la table students est lié à id de la table promotions)
- "ORDER BY" suivit du nom de la ou des tables (exemple ORDER BY lastname, name)
- ASC pour croissant ou DESC pour décroissant (exemple ORDER BY lastname, name ASC)
*/


$items = $conn->fetchAll('SELECT *, promotions.id AS promotionsID FROM `promotions` INNER JOIN students ON students.promotion_id = promotions.id');
/* 
foreach ($items as $item) {
    echo $item['promotionsID'].'<br />';
    echo $item['firstname'].'<br />';
    echo $item['lastname'].'<br />';
    echo $item['birthdate'].'<br />';
    echo $item['sex'].'<br />';
    echo $item['promotion_id'].'<br />';
    echo '<br />';
}