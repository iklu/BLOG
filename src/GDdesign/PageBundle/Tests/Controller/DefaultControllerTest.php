<?php

namespace GDdesign\PageBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
		
        $crawler = $client->request('GET', '/en/web-development.html');

        $this->assertTrue($crawler->filter('html:contains("Like a composer")')->count() > 0);
        
        $crawler = $client->request('GET', '/en/contact.html');
        
        $this->assertTrue($crawler->filter('html:contains("Office Hours")')->count() > 0);
        
        $crawler = $client->request('GET', '/en/about-us.html');
        
        $this->assertTrue($crawler->filter('html:contains("Stay Connected")')->count() > 0);
        
        $crawler->selectButton('English');
        
        $crawler->selectLink('Spanish')->link();
        
        $crawler = $client->request('GET', '/es/homepage.html');
        
        $this->assertTrue($crawler->filter('html:contains("Compone")')->count() > 0);
    }
}
