<?php
namespace GDdesign\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
class DemoControllerTest extends WebTestCase
{
	public function testIndex()
	{
		$client = static::createClient();
		$crawler = $client->request('GET', '/');
		$this->assertGreaterThan( 0, $crawler->filter('html:contains("We are a talented")')->count());
	}
}
