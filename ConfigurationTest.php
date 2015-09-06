<?php
namespace tests\library\Inheritance;
use src\library\Configuration;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
	public function testConfiguration()
	{
		try {
			$conf = new Configuration( dirname(__FILE__)."/conf01.xml" );
			print "user: ".$conf->get('user')."\n";
			print "host: ".$conf->get('host')."\n";
			$conf->set("pass", "newpass");
			$conf->write();
		} catch ( \Exception $e ) {
			die( $e->__toString() );
		}
	}
}

?>