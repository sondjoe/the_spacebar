<?php
/**
 * Created by PhpStorm.
 * User: abellana
 * Date: 09/08/2018
 * Time: 11:21 PM
 */

namespace App\Controller;


use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleAdminController extends AbstractController
{

	/**
	 * @Route("/admin/article/new")
	 */
	public function new(EntityManagerInterface $em) {
		die('TODO');

		return new Response(sprintf(
			'Hey! New article id: #%d and slug: %s',
			$article->getId(),
			$article->getSlug()
		));

	}
}