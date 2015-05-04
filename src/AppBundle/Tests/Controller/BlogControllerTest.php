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
        $this->assertContains('Zoznam príspevkov', $crawler->filter('title')->text(), 'Title element missmatch');
        $this->assertGreaterThan(0, $crawler->filter('body article')->count(), 'No post loaded');
    }

    public function testTag()
    {
        $crawler = $this->client->request('GET', '/blog/stitok/general');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode(), 'HTTP Response fails');
        $this->assertContains('General', $crawler->filter('title')->text(), 'Title element missmatch');
        $this->assertCount(1, $crawler->filter('body article'), 'No post loaded');
    }

    public function testViewPost()
    {
        $crawler = $this->client->request('GET', '/blog/lorem-ipsum');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode(), 'HTTP Response fails');
        $this->assertContains('Lorem ipsum', $crawler->filter('title')->text(), 'Title element missmatch');
    }

    public function testNotFoundPost()
    {
        $crawler = $this->client->request('GET', '/blog/this-should-not-exists');

        $this->assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode(), 'HTTP Response fails');
    }
}
