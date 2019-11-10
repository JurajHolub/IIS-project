<?php


namespace Repositories;


require 'UserRepositoryInterface.php';
require '../Models/UserModel.php';


use PDO;


class UserRepository implements UserRepositoryInterface
{
    private $pdoDbConnection;

    public function __construct($pdoDbConnectionFactory)
    {
        $this->pdoDbConnection = $pdoDbConnectionFactory->createPdoDbConnection();
    }

    public function getAll()
    {
        $stmt = $this->pdoDbConnection->prepare('
            SELECT * FROM User_Base
        ');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Models\UserModel');
    }

    public function getById($user_id)
    {
        $stmt = $this->pdoDbConnection->prepare('
            SELECT * 
            FROM User_Base
            WHERE id = :id
        ');
        $stmt->bindParam(':id', $user_id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\UserModel');
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getByLogin($login)
    {
        $stmt = $this->pdoDbConnection->prepare('
            SELECT *
            FROM User_Base
            WHERE login = :login
        ');
        $stmt->bindParam(':login', $login);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\UserModel');
        $stmt->execute();
        if ($stmt->rowCount()) {
            return $stmt->fetch();
        } else {
            return null;
        }
    }

    public function create($user_model)
    {
        $stmt = $this->pdoDbConnection->prepare('
           INSERT INTO User_Base
               (name, surname, login, password, email, registration, bank_account)
           VALUES
               (:name, :surname, :login, :password, :email, CURRENT_DATE, :bank_account )
        ');
        $stmt->execute([
            'name' => $user_model->name,
            'surname' => $user_model->surname,
            'login' => $user_model->login,
            'password' => $user_model->password,
            'email' => $user_model->email,
            'bank_account' => $user_model->bank_account,
        ]);
    }

    public function update($user_model)
    {
        $stmt = $this->pdoDbConnection->prepare('
            UPDATE User_Base
            SET name = :name,
                surname = :surname,
                login = :login,
                password = :password,
                email = :email
            WHERE id = :id
        ');
        $stmt->bindParam(':id', $user_model->id);
        $stmt->bindParam(':name', $user_model->name);
        $stmt->bindParam(':surname', $user_model->surname);
        $stmt->bindParam(':login', $user_model->login);
        $stmt->bindParam(':password', $user_model->password);
        $stmt->bindParam(':email', $user_model->email);
        $stmt->execute();
    }

    public function delete($user_id)
    {
        $stmt = $this->pdoDbConnection->prepare('
            DELETE
            FROM User_Base
            WHERE id = :id
        ');
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();
    }
}