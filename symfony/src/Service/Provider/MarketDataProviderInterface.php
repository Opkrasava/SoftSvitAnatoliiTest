<?php
namespace App\Service\Provider;

use App\Dto\CompanyDto;

interface MarketDataProviderInterface
{
    public function fetch(string $symbol): ?CompanyDto;
    public static function getKey(): string;
}
