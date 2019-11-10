<?php


namespace Factories;


require 'PdoDbContextFactoryInterface.php';


use PDO;


class PdoDbConnectionFactory implements PdoDbContextFactoryInterface
{

    public function createPdoDbConnection()
    {
        $pdo = new PDO(
            'mysql:host=localhost;dbname=iis_project_db',
            'root',
            ''
        );
        $pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        return $pdo;
    }
}