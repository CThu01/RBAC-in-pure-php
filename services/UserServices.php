<?php

require_once "../repositories/UserRepository.php";
class UserService
{

    private UserRepository $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }

    public function getAllUsers(): array
    {
        return $this->userRepo->findAll();
    }

    public function createUser(User $user): User
    {
        return $this->userRepo->save($user);
    }

    public function updateUser(User $user): User
    {
        return $this->userRepo->update($user);
    }

    public function deleteUser(int $id): User
    {
        return $this->userRepo->delete($id);
    }


}



?>