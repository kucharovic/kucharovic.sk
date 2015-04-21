<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SitemapController extends Controller
{
    /**
     * @Template("sitemap/view.xml.twig")
     */
    public function viewAction()
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Post');
        return [
            'posts' => $repo->findBy([], ['publishedAt' => 'DESC'])
        ];
    }
}
