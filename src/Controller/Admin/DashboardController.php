<?php

namespace App\Controller\Admin;

use App\Entity\Actualites;
use App\Entity\Blog;
use App\Entity\CommentsActu;
use App\Entity\CommentsBlog;
use App\Entity\Contact;
use App\Entity\FAQ;
use App\Entity\Formations;
use App\Entity\Reviews;
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
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('AF2C');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('Actualités', 'fas fa-newspaper', Actualites::class);
        yield MenuItem::linkToCrud('Commentaires Actualites', 'fas fa-comment', CommentsActu::class);

        yield MenuItem::linkToCrud('Blog', 'fas fa-blog', Blog::class);
        yield MenuItem::linkToCrud('Commentaires Blog', 'fas fa-comment', CommentsBlog::class);

        yield MenuItem::linkToCrud('Formations', 'fas fa-graduation-cap', Formations::class);
        yield MenuItem::linkToCrud('Avis Formations', 'fas fa-comment', Reviews::class);

        yield MenuItem::linkToCrud('F.A.Q', 'fa fa-question', FAQ::class);

        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class);

        yield MenuItem::linkToCrud('Contact', 'fa fa-envelope-open-o', Contact::class);





    }
}
