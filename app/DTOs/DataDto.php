<?php

namespace App\DTOs;

class DataDto
{
    public function __construct(
        public string $name,
        public string $telephone,
        public int $training_id,
        public int $data_source_id
    ) {}
}
