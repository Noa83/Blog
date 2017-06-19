<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class HomeController extends Controller
{
    const NUMBER_PER_PAGE = 3;

    /**
     * @Route("/{page}", name="home_page", defaults={"page" = 1}, requirements={"page" = "\d+"})
     * @Method({"GET"})
     */
    public function indexAction($page)
    {

        $articleRepository = $this->getDoctrine()->getRepository('AppBundle:Article');

        $paginator = $articleRepository->findArticlesForPagination($page, self::NUMBER_PER_PAGE);
        $numberOfPages = ceil(count($paginator) / self::NUMBER_PER_PAGE);

        if (($numberOfPages < $page) || ($page < 1))
        {
            throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
        }

        return $this->render('Home/index.html.twig', [
            'page' => $page,
            'paginator' => $paginator,
            'numberOfPages' => $numberOfPages
        ]);
    }
}
