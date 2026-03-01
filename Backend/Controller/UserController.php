<?php

require_once __DIR__ . "/../core/ApiResponse.php";
require_once __DIR__ . "/../services/UserServices.php";
require_once __DIR__ . "/../dto/requestDto/UserRequestDto.php";

class UserController
{
    private UserService $userService;
    private UserRequestDto $userRequestDto;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function getAllUserApi()
    {
        $user = $this->userService->getAllUsers();
        $data = array_map(fn($u) => $u->toArray(), $user);

        ApiResponse::toJson(
            $data,
            "All users fetched successfully",
            200
        );
    }

    public function getByIdApi($id)
    {
        $user = $this->userService->getById($id);

        ApiResponse::toJson(
            $user->toArray(),
            "User $id fetched successfully",
            200
        );
    }

    public function createApi(UserRequestDto $user): void
    {
        $user = $this->userService->createUser($user);

        ApiResponse::toJson(
            $user,
            "user is created Successfully",
            201
        );
    }

    public function updateUserApi(User $user)
    {
        $user = $this->userService->updateUser($user);

        ApiResponse::toJson(
            $user,
            "User is successfully updated",
            200
        );
    }

    public function deleteUserApi($id)
    {
        $user = $this->userService->deleteUser($id);
        $userId = $user->getId();
        ApiResponse::toJson(
            $user,
            "user id $userId is deleted successfully",
            200
        );
    }

}







?>