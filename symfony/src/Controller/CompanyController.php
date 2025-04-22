<?php
namespace App\Controller;

use App\Message\FetchCompanyDataMessage;
use App\Repository\CompanyRepository;
use App\Service\ApiSwitcher;
use App\Service\Provider\YahooProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class CompanyController extends AbstractController
{
    #[Route('/news/{symbol}', name: 'company_news')]
    public function news(string $symbol, YahooProvider $provider): Response
    {
        $news = $provider->fetch($symbol);

        dd($news);
    }

    #[Route('/', name: 'company_index', methods: ['GET'])]
    public function index(
        Request $request,
        CompanyRepository $repository,
        ApiSwitcher $apiSwitcher,
    ): Response {
        if ($request->query->has('use_api')) {
            $apiSwitcher->set($request->query->get('use_api'));
            return $this->redirectToRoute('company_index');
        }

        $activeApi = $apiSwitcher->get();
        $companies = $repository->findAll();

        return $this->render('company/index.html.twig', [
            'companies' => $companies,
            'active_api' => $activeApi,
        ]);
    }

    #[Route('/', name: 'company_add', methods: ['POST'])]
    public function companyAdd(
        Request $request,
        MessageBusInterface $bus
    ): Response {
        $symbol = strtoupper($request->request->get('symbol'));
        if ($symbol) {
            $bus->dispatch(new FetchCompanyDataMessage($symbol));
            return new JsonResponse(['message' => "Data about the company $symbol is loaded..."]);
        }
        else {
            return new JsonResponse(['message' => "Symbol must is required"]);
        }
    }
}
