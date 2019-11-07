<?php


namespace Factories;


require 'Factories/PdoDbContextFactoryInterface.php';


use PDO;


class PdoDbConnectionFactory implements PdoDbContextFactoryInterface
{

    public function createPdoDbConnection()
    {
        $pdo = new PDO(
            'mysql:host=localhost;dbname=is_user',
            'usera',
            'user'
        );
        $pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        return $pdo;
    }
}