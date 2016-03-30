<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Article\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();

        $articleRepository = $manager->getRepository('AppBundle:Article\Article');

        $article = new Article();

        $article
            ->setTitle('Titre')
            ->setContent('Le contenu de mon premier article')
            ->setAuthor('Leonardo Di Caprio')
            ->setTag('First Oscar')
        ;

        $manager->persist($article);
        $manager->flush();

        return $this->render('AppBundle:Home:index.html.twig');
    }

}