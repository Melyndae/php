<?php

// déclaration des classes PHP qui seront utilisées
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

// activation de la fonction autoloading de Composer
require __DIR__.'/../vendor/autoload.php';

// création d'une variable avec une configuration par défaut
$config = new Configuration();

// création d'un tableau avec les paramètres de connection à la BDD
$connectionParams = [
    'driver'    => 'pdo_mysql',
    'host'      => '127.0.0.1',
    'port'      => '3306',
    'dbname'    => 'my_project',
    'user'      => 'user',
    'password'  => '123',
    'charset'   => 'utf8mb4',
];

// connection à la BDD
// la variable `$conn` permet de communiquer avec la BDD
$conn = DriverManager::getConnection($connectionParams, $config);

// créer une requête préparée à partir du code SQL et renvoie un pointeur sur le résultat
$stmt = $conn->executeQuery('SELECT students.id, firstname, lastname, promotions.name FROM students INNER JOIN promotions
ON students.promotion_id= promotions.id ORDER BY firstname :firstname_order, lastname: lastname_order', [
    'firstname_order' => 'ASC', 
    'lastname_order' => 'ASC',
]);

// la méthode `rowCount()` permet de savoir combien de lignes le résultat comporte
echo 'results : '.$stmt->rowCount().'<br />';
echo '<br />';

// boucle `while` qui récupère les résultats ligne par ligne
while ($item = $stmt->fetch()) {
    // à chaque itération de la boucle, la variable `$item` contient une ligne de la table
    // chaque clé alpha-numérique représente une colonne de la table
    echo $item['id'].'<br />';          // affichage de la colonne `id`
    echo $item['firstname'].'<br />';        // affichage de la colonne `firstname`
    echo $item['lastname'].'<br />';        // affichage de la colonne `lastname`
    echo $item['name'].'<br />';        // affichage de la colonne `name`
    echo '<br />';
}