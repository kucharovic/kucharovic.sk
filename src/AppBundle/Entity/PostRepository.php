<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Tag;

/**
 * PostRepository
 */
class PostRepository extends EntityRepository
{
    public function findByTag(Tag $tag)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM AppBundle:Post p WHERE :tag MEMBER OF p.tags ORDER BY p.publishedAt DESC'
            )
            ->setParameter('tag', $tag)
            ->getResult();
    }
}
