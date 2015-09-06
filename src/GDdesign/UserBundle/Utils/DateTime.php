<?php
namespace GDdesign\UserBundle\Utils;

class DateTime 
{
	public function pluralize( $count, $text )
	{
		return $count . ( ( $count == 1 ) ? ( " $text" ) : ( " ${text}s" ) );
	}
	
	public function ago($datetime)
	{
		$interval = date_create('now')->diff( $datetime );
		$suffix = ( $interval->invert ? ' ago' : '' );
		if ( $v = $interval->y >= 1 ) return $this->pluralize( $interval->y, 'year' ) . $suffix;
		if ( $v = $interval->m >= 1 ) return $this->pluralize( $interval->m, 'month' ) . $suffix;
		if ( $v = $interval->d >= 1 ) return $this->pluralize( $interval->d, 'day' ) . $suffix;
		if ( $v = $interval->h >= 1 ) return $this->pluralize( $interval->h, 'hour' ) . $suffix;
		if ( $v = $interval->i >= 1 ) return $this->pluralize( $interval->i, 'minute' ) . $suffix;
		return $this->pluralize( $interval->s, 'second' ) . $suffix;
	}
}

?>