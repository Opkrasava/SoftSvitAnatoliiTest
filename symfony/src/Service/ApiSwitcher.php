<?php
namespace App\Service;

use Symfony\Contracts\Cache\CacheInterface;

class ApiSwitcher
{
    private const KEY = 'active_api';

    public function __construct(private CacheInterface $cache) {}

    public function get(): string
    {
        return $this->cache->get(self::KEY, fn () => 'fmp');
    }

    public function set(string $key): void
    {
        $this->cache->delete(self::KEY);
        $this->cache->get(self::KEY, fn () => $key);
    }
}
