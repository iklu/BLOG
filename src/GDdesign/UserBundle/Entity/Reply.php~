<?php

namespace GDdesign\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reply
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="GDdesign\UserBundle\Entity\ReplyRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Reply
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
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255)     
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var boolean
     *
     * @ORM\Column(name="live", type="boolean")
     */
    private $live;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean")
     */
    private $deleted;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime")
     */
    private $modified;
    
    /**       
    * @ORM\ManyToOne(targetEntity="Message", inversedBy="messages")
    * @ORM\JoinColumn(name="message_id", referencedColumnName="id", onDelete="CASCADE")
    */
    private $message;

     /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=255)
     */
    private $user;

     public function __construct()
    {
    	
    	$this->deleted = false;
    	$this->live = true;

    	// may not be needed, see section on salt below
    	// $this->salt = md5(uniqid(null, true));
    }

   
    
 	

    /**
     * Set subject
     *
     * @param string $subject
     * @return Reply
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Reply
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set live
     *
     * @param boolean $live
     * @return Reply
     */
    public function setLive($live)
    {
        $this->live = $live;

        return $this;
    }

    /**
     * Get live
     *
     * @return boolean 
     */
    public function getLive()
    {
        return $this->live;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return Reply
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @ORM\PrePersist
     * @return Reply
     */
    public function setCreated($created)
    {
        $this->created = new \DateTime();

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return Reply
     * @ORM\PrePersist
     */
    public function setModified($modified)
    {
         $this->modified = new \DateTime();

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Set message
     *
     * @param \GDdesign\UserBundle\Entity\Message $message
     * @return Reply
     */
    public function setMessage(\GDdesign\UserBundle\Entity\Message $message = null)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return \GDdesign\UserBundle\Entity\Message 
     */
    public function getMessage()
    {
        return $this->message;
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
     * Set user
     *
     * @param string $user
     * @return Reply     
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
    }
}
