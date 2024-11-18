<?php
namespace App\Services;

abstract class AbstractService {
    public bool $status = true;
    public ?int $statusCode = 200;
    public ?string $message = '';
    public mixed $errors = [];
    public mixed $data = [];


    public function setStatus(bool $status = true): static
    {
        $this->status = $status;
        return $this;
    } 

    public function setStatusCode($statusCode = 200): static
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function setMessage(?string $message = ''): static
    {
        $this->message = $message;
        return $this;
    } 

    public function setError(mixed $errors): static
    {
        $this->errors = $errors;
        return $this;
    } 

    public function setData(mixed $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function getStatus() : bool
    {
        return $this->status;
    }

    public function getMessage() : string
    {
        return $this->message;
    }

    public function getErrors() : mixed
    {
        return $this->errors;
    }
    
    public function getData(): mixed
    {
        return $this->data;
    }

    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }
}

