<?php
/**
 * Created by PhpStorm.
 * User: abellana
 * Date: 19/07/2018
 * Time: 11:33 PM
 */

namespace App\Controller;


use App\Entity\Article;
use App\Service\MarkdownHelper;
use App\Service\SlackClient;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage() {
        return $this->render('article/homepage.html.twig');
    }

    /**
     * @Route("/news/{slug}", name="article_show")
     */
    public function show($slug, SlackClient $slack, EntityManagerInterface $em) {

    	if ($slug == 'khaan') {
			$slack->sendMessage('Earl', 'Your almost there');
	    }

		$repository = $em->getRepository(Article::class);

    	/** @var $article Article*/
    	$article = $repository->findOneBy(['slug' => $slug]);
    	if (!$article) {
    		throw $this->createNotFoundException("No article found: " . $slug);
	    }

        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'comments' => $comments
        ]);
    }

    /**
     * @Route("news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart($slug, LoggerInterface $logger) {

        //TODO - no db yet

        $logger->info("Article is being hearted!");

        return $this->json(['hearts' => rand(5, 100)]);
    }
}