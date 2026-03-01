<?php

require_once __DIR__ . "/../repositories/UserRepository.php";
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

    public function getById($id): User
    {
        return $this->userRepo->findyById($id);
    }

    public function updateUser(User $user): User|string
    {
        $userId = $user->getId();
        $user = $this->userRepo->findyById($userId);

        if (!$user) {
            return ApiResponse::toJson(
                null,
                "User Id $userId is not found",
                404
            );
        }
        return $this->userRepo->update($user);
    }

    public function deleteUser(int $id): User
    {
        return $this->userRepo->delete($id);
    }


}



?>