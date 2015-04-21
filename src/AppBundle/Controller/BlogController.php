<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Post;

class BlogController extends Controller
{
    /**
     * @Template("blog/list.html.twig")
     */
    public function listAction()
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Post');
        return [
            'posts' => $repo->findBy([], ['publishedAt' => 'DESC'])
        ];
    }

    /**
     * @Template("blog/view.html.twig")
     */
    public function viewAction(Post $post)
    {}
}
