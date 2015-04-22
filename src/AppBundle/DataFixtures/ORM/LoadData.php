<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Post;
use AppBundle\Entity\Tag;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Defines the sample data to load in the database when executing this command:
 *   $ php app/console doctrine:fixtures:load
 *
 * @see http://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html
 */
class LoadData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $tag = new Tag();
        $tag->setTitle('General');
        $tag->setSlug('general');

        $post = new Post();

        $post->setTitle('Lorem ipsum');
        $post->setSlug('lorem-ipsum');
        $post->setPerex('<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur aliquam, metus ultrices malesuada imperdiet, mauris leo volutpat ex, pellentesque tempus eros odio eu quam.');
        $post->setContent('<p>Ut malesuada ultrices tortor a mattis. Donec vel arcu at lorem dapibus bibendum non vitae ipsum. Praesent nec lectus vel magna molestie malesuada. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.<p>Proin hendrerit, nibh nec finibus venenatis, quam felis scelerisque velit, ut suscipit nunc elit eget purus. Sed leo ligula, porta hendrerit quam a, efficitur semper lectus. Donec rutrum finibus mauris ut porta. Sed in quam sit amet mauris porttitor rhoncus nec ac mi.');
        $post->setPublishedAt(new \DateTime());
        $post->addTag($tag);

        $manager->persist($tag);
        $manager->persist($post);

        $manager->flush();
    }

}