<?php
namespace App\Mapper;

use App\Dto\CompanyDto;

class FmpDtoMapper
{
    public function map(array $data): CompanyDto
    {
        $dto = new CompanyDto();
        $dto->symbol = $data['symbol'];
        $dto->name = preg_replace('/[^A-Za-z\s]/', '', $data['name']);
        $dto->price = $data['price'];
        $dto->volume = $data['volume'];
        $dto->eps = $data['eps'];
        $dto->open = $data['open'];
        $dto->previousClose = $data['previousClose'];

        return $dto;
    }
}
