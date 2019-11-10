<?php


namespace Repositories;


use Models\UserModel;

interface UserRepositoryInterface
{
    public function getAll();
    public function getById($user_id);
    public function getByLogin($login);

    public function create(UserModel $user_model);
    public function update(UserModel $user_model);
    public function delete($user_id);
}