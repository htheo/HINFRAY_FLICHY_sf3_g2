<?php


namespace AppBundle\Controller;

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
        $antispam = $this->get('antispam');

        dump($antispam->isSpam('dlkfldlkjdfklfdsfdlskjslkdflksfjklsjflksjflksjlkfjdslkjdslkfjlxfjdsl'));
        die;

        return $this->render('AppBundle:Home:index.html.twig');

    }

}