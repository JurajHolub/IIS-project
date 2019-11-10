<?php


namespace Repositories;


require 'UserRepositoryInterface.php';
require '../Models/UserModel.php';


use Models\UserModel;
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

    public function getByLogin($login): ?UserModel
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

    public function create(UserModel $user_model)
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

    public function update(UserModel $user_model)
    {
        $stmt = $this->pdoDbConnection->prepare('
            UPDATE User_Base
            SET name = :name,
                surname = :surname,
                login = :login,
                password = :password,
                email = :email,
                bank_account = :bank_account
            WHERE id = :id
        ');
        $stmt->execute([
            'name' => $user_model->name,
            'surname' => $user_model->surname,
            'login' => $user_model->login,
            'password' => $user_model->password,
            'email' => $user_model->email,
            'bank_account' => $user_model->bank_account,
            'id' => $user_model->id,
        ]);
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