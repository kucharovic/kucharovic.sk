<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Post;

class BlogController extends Controller
{
    /**
     * @Template
     */
    public function listAction()
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Post');
        return [
            'posts' => $repo->findBy([], ['publishedAt' => 'DESC'])
        ];
    }

    /**
     * @Template
     */
    public function viewAction(Post $post)
    {}
}
