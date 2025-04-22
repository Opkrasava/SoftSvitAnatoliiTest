<?php
namespace App\Mapper;

use App\Dto\CompanyDto;
use App\Entity\Company;

class CompanyMapper
{
    public function map(Company $company, CompanyDto $dto): void
    {
        $company->setSymbol($dto->symbol);
        $company->setName($dto->name);
        $company->setOpen($dto->open);
        $company->setPreviousClose($dto->previousClose);
        $company->setMetrics([
            'price' => $dto->price,
            'volume' => $dto->volume,
            'eps' => $dto->eps,
        ]);
    }
}
