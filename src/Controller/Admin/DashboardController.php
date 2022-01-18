<?php

namespace App\Controller\Admin;
use App\Entity\Category;
use App\Entity\Product;
//use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
//use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class DashboardController extends AbstractDashboardController
{
    /**
     * @IsGranted("Role_Admin")
     */
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
//        $this->denyAccessUnlessGranted('Role_Admin');

        // or add an optional message - seen by developers
//        $this->denyAccessUnlessGranted('Role_Admin', null, 'User tried to access a page without having ROLE_ADMIN');
        return parent::index();
          }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Shopping')
            ->setTitle('<img src="">Shop<span class="text-small">ABC</span>')
            ->setTranslationDomain('my-custom-domain')
            ->setFaviconPath('favicon.svg');
    }

    public function configureMenuItems(): iterable
    {
//        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        return[
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),

        MenuItem::section('Product'),
            MenuItem::linkToCrud('Products', 'fa fa-tags', Product::class),
        MenuItem::linkToCrud('Categories', 'fa fa-tags', Category::class),
//            MenuItem::linkToCrud('Blog Posts', 'fa fa-file-text', BlogPost::class);
//            MenuItem::linkToCrud('Blog Posts', 'fa fa-file-text', BlogPost::class);

//        MenuItem::section('Users'),
//        MenuItem::linkToCrud('Comments', 'fa fa-comment', Comment::class),
//        MenuItem::linkToCrud('Users', 'fa fa-user', User::class),
        ];

    }
}
