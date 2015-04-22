<?php

namespace AppBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SitemapControllerTest extends WebTestCase
{
    protected function setUp()
    {
        $this->client = static::createClient();

        $fixtures = [
            'AppBundle\DataFixtures\ORM\LoadData',
        ];

        $this->loadFixtures($fixtures);
    }

    public function testView()
    {
        $crawler = $this->client->request('GET', '/sitemap.xml');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode(), 'HTTP Response fails');
        $this->assertTrue($crawler->filter('url')->count() > 2, 'No post loaded');
    }
}
