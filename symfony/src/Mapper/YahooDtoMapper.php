<?php
namespace App\Mapper;

use App\Dto\CompanyDto;

class YahooDtoMapper
{
    public function map(array $data): CompanyDto
    {
        $dto = new CompanyDto();

        $dto->symbol = $data['symbol'];
        $dto->name = preg_replace('/[^A-Za-z\s]/', '', $data['price']['longName'] ?? '');
        $dto->price = $data['price']['regularMarketPrice']['raw'] ?? 0;
        $dto->volume = $data['price']['regularMarketVolume']['raw'] ?? 0;
        $dto->eps = $data['defaultKeyStatistics']['trailingEps']['raw'] ?? 0;
        $dto->open = $data['price']['regularMarketOpen']['raw'] ?? 0;
        $dto->previousClose = $data['price']['regularMarketPreviousClose']['raw'] ?? 0;

        return $dto;
    }
}
