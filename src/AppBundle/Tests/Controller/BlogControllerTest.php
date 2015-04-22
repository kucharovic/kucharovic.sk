<?php

namespace AppBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class BlogControllerTest extends WebTestCase
{
    protected function setUp()
    {
        $this->client = static::createClient();

        $fixtures = [
            'AppBundle\DataFixtures\ORM\LoadData',
        ];

        $this->loadFixtures($fixtures);
    }

    public function testList()
    {
        $crawler = $this->client->request('GET', '/blog');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode(), 'HTTP Response fails');
        $this->assertTrue($crawler->filter('title:contains("Zoznam príspevkov")')->count() == 1, 'Title element missmatch');
        $this->assertTrue($crawler->filter('body ul > li')->count() > 0, 'No post loaded');
    }

    public function testTag()
    {
        $crawler = $this->client->request('GET', '/blog/stitok/general');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode(), 'HTTP Response fails');
        $this->assertTrue($crawler->filter('title:contains("General")')->count() == 1, 'Title element missmatch');
        $this->assertTrue($crawler->filter('body ul > li')->count() > 0, 'No post loaded');
    }

    public function testViewPost()
    {
        $crawler = $this->client->request('GET', '/blog/lorem-ipsum');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode(), 'HTTP Response fails');
        $this->assertTrue($crawler->filter('title:contains("Lorem ipsum")')->count() == 1, 'Title element missmatch');
    }

    public function testNotFoundPost()
    {
        $crawler = $this->client->request('GET', '/blog/this-should-not-exists');

        $this->assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode(), 'HTTP Response fails');
    }
}
