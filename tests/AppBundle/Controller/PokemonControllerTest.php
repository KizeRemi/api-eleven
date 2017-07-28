<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PokemonControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp() {
        $this->client = static::createClient();
    }

    public function testCget()
    {
        $this->setUp();
        $client = $this->client;
        $client->followRedirects(true);
        $crawler  = $client->request('GET', '/pokemon');

        $response = $client->getResponse();

        $this->assertJsonResponse($response, 200);
        
        $content = json_decode($response->getContent(), true);
        $this->assertInternalType('array', $content);
        $pokemon = $content[1];
        $this->assertArrayHasKey('number', $pokemon);
        $this->assertArrayHasKey('description', $pokemon);
        $this->assertArrayHasKey('name', $pokemon);
        $this->assertArrayHasKey('id', $pokemon);
    }

    public function testGet()
    {
        $this->setUp();
        $client = $this->client;
        $client->followRedirects(true);
        $crawler  = $client->request('GET', '/pokemon/1');

        $response = $client->getResponse();

        $this->assertJsonResponse($response, 200);
        
        $content = json_decode($response->getContent(), true);
        $this->assertInternalType('array', $content);
        $this->assertArrayHasKey('number', $content);
        $this->assertArrayHasKey('description', $content);
        $this->assertArrayHasKey('name', $content);
        $this->assertArrayHasKey('id', $content);
    }

    public function testPost(){
        $data = array
        (
            "number"  => "6",
            "name"  => "name_of_pokemon",
            "description" => "Description of the pokemon",
        );
        $this->setUp();
        $client = $this->client;

        $crawler  = $client->request('POST', '/pokemon', $data);
        $response = $client->getResponse();
        $this->assertEquals(201, $response->getStatusCode());
    }

    protected function assertJsonResponse($response, $statusCode = 200)
    {
        $this->assertEquals(
            $statusCode, $response->getStatusCode(),
            $response->getContent()
        );
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );
    }
}