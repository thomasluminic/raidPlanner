<?php

namespace App\Controller\Admin;

use App\Entity\Character;
use App\Entity\Raid;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('@EasyAdmin/page/content.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Raid Planner');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),

            MenuItem::section('Raid'),
            MenuItem::linkToCrud('Raid', 'fa fa-angry', Raid::class),

            MenuItem::section('Users'),
            MenuItem::linkToCrud('Personnage', 'far fa-id-card', Character::class),
            MenuItem::linkToCrud('Utilisateur', 'fa fa-user', User::class),
        ];
    }
}
