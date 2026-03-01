<?php


class UserRequest
{
    private string $name;
    private string $username;
    private string $email;
    private string $password;
    private int $roleId;
    private string $phone;
    private string $address;
    private bool $gender;
    private bool $isActive;

    public function __construct(
        string $name,
        string $username,
        string $email,
        string $password,
        int $roleId,
        string $phone,
        string $address,
        bool $gender,
        bool $isActive
    ) {
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->roleId = $roleId;
        $this->phone = $phone;
        $this->address = $address;
        $this->gender = $gender;
        $this->isActive = $isActive;
    }


}


?>