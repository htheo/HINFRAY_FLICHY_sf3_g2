<?php

namespace AppBundle\Controller\Article;

use AppBundle\Form\Type\Article\TagType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends Controller
{
    /**
     * @Route("/list", name="article_list")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articleRepository = $em->getRepository('AppBundle:Article\Article');
        $articles = $articleRepository->findAll();
        return $this->render('AppBundle:Article:index.html.twig', [
            'articles' => $articles,
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
     * @Route("/tag/new")
     */
    public function newAction(Request $request)
    {
    $form = $this->createForm(TagType::class);

    $form->handleRequest($request);




    if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();


        /** @var Tag $tag */
        $tag=$form->getData();
        $monslug = $tag->getName();
        $stringUtil = $this->get('slugify');
        $slug = $stringUtil->slugify($monslug);
        $tag->setSlug($slug);
        $em->persist($tag);

        $em -> flush();

        return $this->redirectToRoute('article_list');
    }
    return $this->render('AppBundle:Article:tag.new.html.twig', [
        'form' => $form->createView(),
    ]);
    }


}