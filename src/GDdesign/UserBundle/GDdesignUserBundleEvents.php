<?php
namespace GDdesign\UserBundle;




final class GDdesignUserBundleEvents
{   
	/**
	 * On sent message emit event
	 *
	 *
	 *
	 */
    const SEND_MESSAGE_REPLY = 'user_bundle.send_message.complete';
    
    /**
     *  On adding a user verifys if user exists
     */
    const VERIFY_IF_USER_EXISTS ='user_bundle.verify_user.complete';
}




