<?php
namespace App\MessageHandler;

use App\Entity\Company;
use App\Mapper\CompanyMapper;
use App\Message\FetchCompanyDataMessage;
use App\Repository\CompanyRepository;
use App\Service\ApiSwitcher;
use App\Service\Provider\MarketDataProviderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

#[AsMessageHandler]
class FetchCompanyDataHandler
{
    public function __construct(
        private ApiSwitcher $switcher,
        #[TaggedIterator('app.market_provider', defaultIndexMethod: 'getKey')]
        private iterable $providers,
        private EntityManagerInterface $em,
        private CompanyRepository $repo,
        private CompanyMapper $companyMapper
    ) {}

    public function __invoke(FetchCompanyDataMessage $message): void
    {
        $symbol = strtoupper($message->symbol);
        $providerKey = $this->switcher->get();

        $provider = null;

        foreach ($this->providers as $p) {
            if ($p->getKey() === $providerKey) {
                $provider = $p;
                break;
            }
        }

        $dto = $provider->fetch($symbol);
        if (!$dto) {
            throw new \RuntimeException("Не удалось получить данные о {$symbol} из {$providerKey}");
        }

        $company = $this->repo->findOneBy(['symbol' => $symbol]) ?? new Company();
        $this->companyMapper->map($company, $dto);

        $this->em->persist($company);
        $this->em->flush();
    }
}
