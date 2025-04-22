<?php
namespace App\Message;

class FetchCompanyDataMessage
{
    public function __construct(
        public readonly string $symbol
    ) {}
}