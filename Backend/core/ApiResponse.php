<?php

class ApiResponse
{
    private string $status;
    private string $message;
    private mixed $data;

    // public function __construct(string $status, string $message, mixed $data)
    // {

    //     $this->status = $status;
    //     $this->message = $message;
    //     $this->data = $data;
    // }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function setsetData(mixed $data): void
    {
        $this->data = $data;
    }

    public static function toJson($data, string $message, int $statusCode): string
    {
        http_response_code($statusCode);
        header("Content-Type: application/json");
        echo json_encode([
            "status" => $statusCode,
            "message" => $message,
            "data" => $data
        ]);

        exit;
    }



    public function getStatus(): string
    {
        return $this->status;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getData(): mixed
    {
        return $this->data;
    }


}

?>