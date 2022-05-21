<?php

namespace App\Resources;

use Core\JsonResource;

class UrlResource extends JsonResource
{
    public function toArray(): array
    {
        return [
          'hash' => $this->data['hash'],
          'user_id' => $this->data['user_id'],
          'url' => $this->data['url'],
          'created_at' => $this->data['created_at'],
          'updated_at' => $this->data['updated_at'],
        ];
    }
}
