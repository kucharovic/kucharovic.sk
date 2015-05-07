<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Post;
use AppBundle\Entity\Tag;

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
     * @Template("blog/tag.html.twig")
     */
    public function tagAction(Tag $tag)
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Post');
        return [
            'tag' => $tag,
            'posts' => $repo->findByTag($tag)
        ];
    }

    /**
     * @Template("blog/view.html.twig")
     */
    public function viewAction(Post $post)
    {}

    /**
     * @ParamConverter
     */
    public function shortlinkAction(Post $post)
    {
        return $this->redirectToRoute('post.view', ['slug' => $post->getSlug()], 301);
    }
}
