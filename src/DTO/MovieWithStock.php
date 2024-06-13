<?php

namespace App\DTO;

class MovieWithStock
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly int $stockIn,
        public readonly int $stockOut,
        public readonly int $stockReserve,
    ) {

    }
}