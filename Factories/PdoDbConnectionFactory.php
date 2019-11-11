<?php


namespace Factories;


require 'PdoDbContextFactoryInterface.php';


use PDO;


class PdoDbConnectionFactory implements PdoDbContextFactoryInterface
{

    public function createPdoDbConnection()
    {
        $pdo = new PDO(
            "mysql:host=localhost;dbname=xholub40;port=/var/run/mysql/mysql.sock",
            'xholub40',
            'engibi5r'
        );
        $pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        return $pdo;
    }
}