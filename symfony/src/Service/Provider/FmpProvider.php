<?php
namespace App\Service\Provider;

use App\Dto\CompanyDto;
use App\Mapper\FmpDtoMapper;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FmpProvider implements MarketDataProviderInterface
{
    private const HOST = 'https://financialmodelingprep.com';
    private const KEY = 'fmp';

    public function __construct(
        private HttpClientInterface $client,
        private FmpDtoMapper $mapper,
        private string $apiKey = 'xSNTss2Zv42YCTS3UE8k6nVZOe0OjsNb'
    ) {}

    public static function getKey(): string
    {
        return self::KEY;
    }

    public function fetch(string $symbol): ?CompanyDto
    {
        $url = self::HOST."/api/v3/quote/{$symbol}?apikey={$this->apiKey}";
        $response = $this->client->request('GET', $url);
        $data = $response->toArray()[0] ?? null;

        if (!$data) return null;

        return $this->mapper->map($data);
    }
}
