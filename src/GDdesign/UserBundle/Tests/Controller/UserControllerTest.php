<?php

namespace GDdesign\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
	    
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /register");
        $crawler = $client->click($crawler->selectLink('Register')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Register')->form(array(
							            'fos_user_registration_form[firstname]'  => 'Dragoi',
							            'fos_user_registration_form[lastname]' => 'Ovidiu',
							            'fos_user_registration_form[telefon]'=> '0785565656',
							            'fos_user_registration_form[email]'=>'dragoiovidiu2011test@yahoo.com',
							            'fos_user_registration_form[username]'=>'admintest',
							            'fos_user_registration_form[plainPassword][password]'=>'parola',
							            'fos_user_registration_form[plainPassword][confirm]'=>'parola',
							            'fos_user_registration_form[terms]'=>true));

        $client->submit($form);
        $crawler = $client->followRedirect();
        $crawler = $client->click($crawler->selectLink('Profile')->link());
      
        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'fos_user_profile_form[telefon]'  => '555',
        	'fos_user_profile_form[current_password]'  => 'parola',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();
        $crawler = $client->click($crawler->selectLink('Delete Account')->link());
        
        // Check the element contains an attribute with value equals "Foo"
       // $this->assertGreaterThan(0, $crawler->filter('[value="555"]')->count(), 'Missing element [value="Foo"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
       // $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }
    
}
