<?php

namespace GDdesign\UserBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;


/**
 * Message
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GDdesign\UserBundle\Entity\MessageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Message
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    
    /**
     * @ORM\ManyToOne(targetEntity="User" )
     * @ORM\JoinColumn(name="receiver_id", referencedColumnName="id")
     */
    private $receiver;
    
 
     /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="sender_id", referencedColumnName="id")
     */
    private $sender;
    
	
     /**
     * @var \Doctrine\Common\Collections\ArrayCollection $messages
     * @ORM\OneToMany(targetEntity="Reply", mappedBy="message", cascade={"persist", "remove"} )
     * @ORM\OrderBy({"created" = "asc"})
     */
    private $messages;
 

    

    public function __construct()
    {
         $this->messages =new \Doctrine\Common\Collections\ArrayCollection();
    }

	
	
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    

    /**
     * Set receiver
     *
     * @param \GDdesign\UserBundle\Entity\User $receiver
     * @return Message
     */
    public function setReceiver(\GDdesign\UserBundle\Entity\User $receiver = null)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get receiver
     *
     * @return \GDdesign\UserBundle\Entity\User 
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set sender
     *
     * @param \GDdesign\UserBundle\Entity\User $sender
     * @return Message
     */
    public function setSender(\GDdesign\UserBundle\Entity\User $sender = null)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return \GDdesign\UserBundle\Entity\User 
     */
    public function getSender()
    {
        return $this->sender;
    }
	
	

    /**
     * Add messages
     *
     * @param \GDdesign\UserBundle\Entity\Reply $message
     * @return Message
     */
    public function addMessage(\GDdesign\UserBundle\Entity\Reply $message)
    {
        $this->messages[] = $message;
        $message->setMessage($this);
        return $this;
    }

    /**
     * Remove messages
     *
     * @param \GDdesign\UserBundle\Entity\Reply $messages
     */
    public function removeMessage(\GDdesign\UserBundle\Entity\Reply $messages)
    {
        $this->messages->removeElement($messages);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMessages()
    {
        return $this->messages;
    }
}
