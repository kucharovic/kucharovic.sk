<?php

namespace AppBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class RssControllerTest extends WebTestCase
{
    protected function setUp()
    {
        $this->client = static::createClient();

        $fixtures = [
            'AppBundle\DataFixtures\ORM\LoadData',
        ];

        $this->loadFixtures($fixtures);
    }

    public function testFeed()
    {
        $crawler = $this->client->request('GET', '/rss.xml');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode(), 'HTTP Response fails');
        $this->assertCount(1, $crawler->filter('item'), 'No post loaded from database');
    }
}
