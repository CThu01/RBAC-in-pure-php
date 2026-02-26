<?php

require_once "../config/Database.php";
require_once "../models/User.php";
class UserRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM user");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($rows as $row) {
            $users = User::fromArray($row);
        }

        return $users;
    }

    public function save(User $user): User
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO user (name, username, email, password, role_id, phone, address, gender, is_active)
            VALUES ( :name, :username, :email, :password, :roleId, :phone, :address, :gender, :isActive)
        ");

        $stmt->execute([
            "name" => $user->getName(),
            "username" => $user->getUsername(),
            "email" => $user->getEmail(),
            "password" => password_hash($user->getPassword(), PASSWORD_DEFAULT),
            "roleId" => $user->getRoleId(),
            "phone" => $user->getPhone(),
            "address" => $user->getAddress(),
            "gender" => $user->getGender(),
            "isActive" => $user->isActive()
        ]);

        $id = (int) $this->pdo->lastInsertId();

        return $this->findyById($id);
    }

    public function update(User $user): User
    {
        $stmt = $this->pdo->prepare("
            UPDATE user
            SET name = :name,
                username = :username,
                email = :email,
                password = :password,
                role_id = :roleId,
                phone = :phone,
                address = :address,
                gender = :gender,
                is_active = :isActive
            WHERE id = :id
        ");

        $stmt->execute([
            "id" => $user->getId(),
            "name" => $user->getName(),
            "username" => $user->getUsername(),
            "email" => $user->getEmail(),
            "password" => password_hash($user->getPassword(), PASSWORD_DEFAULT),
            "roleId" => $user->getRoleId(),
            "phone" => $user->getPhone(),
            "address" => $user->getAddress(),
            "gender" => $user->getGender(),
            "isActive" => $user->isActive()
        ]);

        return $this->findyById($user->getId());
    }

    public function findyById(int $id): User|null
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user where id= :id");
        $stmt->execute([
            "id" => $id
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $user = new User(
            $row['id'],
            $row['name'],
            $row['username'],
            $row['email'],
            $row['role_id'],
            $row['phone'],
            $row['phone'],
            $row['address'],
            $row['gender'],
            $row['is_active']
        );

        return $user;
    }

    public function delete(int $id): User
    {

        $deletedUser = $this->findyById($id);

        $stmt = $this->pdo->prepare("
            DELETE FROM user WHERE id=:id
        ");

        $stmt->execute(["id" => $id]);

        return $deletedUser;
    }

}

?>