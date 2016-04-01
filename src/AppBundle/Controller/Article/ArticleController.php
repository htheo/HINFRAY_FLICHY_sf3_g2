<?php

namespace AppBundle\Controller\Article;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends Controller
{
    /**
     * @Route("/list")
     */
    public function listAction()
    {
        $tutorials = [
            [
                'id' => 2,
                'name' => 'Symfony2'
            ],
            [
                'id' => 5,
                'name' => 'Wordpress'
            ],
            [
                'id' => 9,
                'name' => 'Laravel'
            ],
        ];
        return $this->render('AppBundle:Article:index.html.twig', [
            'tutorials' => $tutorials,
        ]);
    }

    /**
     * @Route("/show/{id}", requirements={"id" = "\d+"})
     */
    public function showAction($id, Request $request)
    {
       $tag = $request->query->get('tag');
        return new Response("Affiche l'article avec l'ID ".$id. " avec le tag ".$tag);
    }

    /**
     * @Route("/show/{articleName}")
     *
     * @param $articleName
     *
     * @return Response
     */
    public function showArticleNameAction($articleName)
    {
        return $this->render('AppBundle:Article:index.html.twig', [
            'articleName' => $articleName,
        ]);
    }
    /**
     * @Route("/author" , name="article_author"))
     */
    public function authorAction(Request $request)
    {
        $author = $request->query->get('author');

        $em = $this->getDoctrine()->getManager();
        $articleRepository = $em->getRepository('AppBundle:Article\Article');

        $articles= $articleRepository->findBy([
            'author' => $author,
        ]);
        return $this->render('AppBundle:Article:index.html.twig',[
            'articles' => $articles,
        ]);
    }
    /**
     * @Route("/new")
     */
    public function newAction()
    {

    }

}