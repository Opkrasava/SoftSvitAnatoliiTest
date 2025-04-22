<?php
namespace App\Service\Provider;

use App\Dto\CompanyDto;
use App\Mapper\YahooDtoMapper;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class YahooProvider implements MarketDataProviderInterface
{
    private const HOST = 'https://yahoo-finance166.p.rapidapi.com';
    private const KEY = 'yahoo';

    public function __construct(
        private HttpClientInterface $client,
        private YahooDtoMapper $mapper,
        private string $apiKey = '39978cd983msh857bea21c9bafb3p15f4dbjsn1c3faa4618c5'
    ) {}

    public static function getKey(): string
    {
        return self::KEY;
    }

    public function fetch(string $symbol): ?CompanyDto
    {
        $url = self::HOST."/api/market/get-quote";
        $response = $this->client->request('GET', $url, [
            'headers' => [
                'X-RapidAPI-Key' => $this->apiKey,
                'X-RapidAPI-Host' => 'yahoo-finance166.p.rapidapi.com',
            ],
            'query' => [
                'symbols' => $symbol,
            ],
        ]);

        $data = $response->toArray()['quoteResponse']['result']['0'];

        return $this->mapper->map($data);
    }
}
