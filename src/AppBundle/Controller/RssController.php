<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RssController extends Controller
{
    /**
     * @Template("rss/feed.xml.twig")
     */
    public function feedAction()
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Post');
        return [
            'posts' => $repo->findBy([], ['publishedAt' => 'DESC'])
        ];
    }
}
