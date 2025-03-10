<?php

namespace App\Controller\Admin;

use App\Entity\Marker;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator,
    ){
    }

    #[Route('/admin', name: 'admin_landing')]
    public function index(): Response
    {

        $url = $this->adminUrlGenerator->setController(MarkerCrudController::class)
            ->setAction( Crud::PAGE_INDEX)
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('LS Marker | Back-Office');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('LS Marker | Accueil', 'fa fa-globe', $this->getParameter('app_url'));

        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');


        yield  MenuItem::linkToCrud('Users', 'fa fa-users', User::class)
            ->setController(UserCrudController::class)
            ->setAction( Crud::PAGE_INDEX)
        ;

        yield  MenuItem::linkToCrud('Marker type', 'fa fa-thumbtack', User::class)
            ->setController(MarkerTypeCrudController::class)
            ->setAction( Crud::PAGE_INDEX)
        ;

        yield MenuItem::subMenu('Markers', 'fas fa-map-location-dot')->setSubItems([
            MenuItem::linkToCrud('Tous les Markers', 'fa fa-map-marker-alt', Marker::class)
                ->setController(MarkerCrudController::class),
//            MenuItem::linkToCrud('Markers Nord', 'fa fa-map-marker-alt', Marker::class)
//                ->setController(MarkerCrudController::class)
//                ->setQueryParameter('filters[region][comparison]', '=')
//                ->setQueryParameter('filters[region][value]', 'north')
//                ->setAction( Crud::PAGE_INDEX),
//            MenuItem::linkToCrud('Markers Sud', 'fa fa-map-marker-alt', Marker::class)
//                ->setController(MarkerCrudController::class)
//                ->setQueryParameter('filters[region][comparison]', '=')
//                ->setQueryParameter('filters[region][value]', 'south')
//                ->setAction( Crud::PAGE_INDEX),
        ]);

    }
}
