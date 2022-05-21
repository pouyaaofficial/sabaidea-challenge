<?php

namespace App\Resources;

use Core\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(): array
    {
        return [
          'id' => $this->data['id'],
          'email' => $this->data['email'],
          'created_at' => $this->data['created_at'],
          'updated_at' => $this->data['updated_at'],
        ];
    }
}
