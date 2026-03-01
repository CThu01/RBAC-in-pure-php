<?php

class User
{
    private ?int $id;
    private ?string $name;
    private string $username;
    private string $email;
    private string $password;
    private int $roleId;
    private string $phone;
    private string $address;
    private bool $gender;
    private bool $isActive;

    public function __construct(
        ?int $id,
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
        $this->id = $id;
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

    public static function fromArray(array $data): User
    {
        return new User(
            $data['id'] ?? null,
            $data['name'],
            $data['username'],
            $data['email'],
            $data['password'],
            $data['role_id'],
            $data['phone'],
            $data['address'],
            $data['gender'],
            $data['is_active']
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'roleId' => $this->roleId,
            'phone' => $this->phone,
            'address' => $this->address,
            'gender' => $this->gender,
            'isActive' => $this->isActive
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getUsername(): string
    {
        return $this->username;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getRoleId(): int
    {
        return $this->roleId;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getGender(): bool
    {
        return $this->gender;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

}

?>