<?php


namespace Repositories;


interface UserRepositoryInterface
{
    public function getAll();
    public function getById($user_id);
    public function getByLogin($login);

    public function create($user_model);
    public function update($user_model);
    public function delete($user_id);
}