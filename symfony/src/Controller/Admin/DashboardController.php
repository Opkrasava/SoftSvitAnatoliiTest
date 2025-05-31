<?php

namespace App\Controller\Admin;

use App\Entity\Bigbuy\BigbuyProduct;
use App\Entity\Bigbuy\BigbuyTaxonomy;
use App\Entity\Blog;
use App\Entity\Category;
use App\Entity\Chat;
use App\Entity\CollageCategory;
use App\Entity\CollageMultimedia;
use App\Entity\CollageProduct;
use App\Entity\Company;
use App\Entity\Country;
use App\Entity\Feedback;
use App\Entity\Language;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\ProductAttribute;
use App\Entity\ProductAttributeGroup;
use App\Entity\ProductTag;
use App\Entity\ProductVariation;
use App\Entity\Slider;
use App\Entity\Translation;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Html');
    }

    public function configureMenuItems(): iterable
    {
        return [
            yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            yield MenuItem::linkToCrud('Company', 'fas fa-th-large', Company::class),
        ];
    }
}
