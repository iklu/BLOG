<?php

namespace GDdesign\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * User
 *
 * @ORM\Table(name="UserRegister")
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 * @ORM\Entity(repositoryClass="GDdesign\UserBundle\Entity\UserRegisterRepository")
 */
class UserRegister implements AdvancedUserInterface, \Serializable , EquatableInterface
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
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\NotBlank()
		 * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Assert\NotBlank()
		 * @Assert\Length(max = 4096)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;
    
    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="string", length=50)
     */
    private $roles;

    /**
     * @var integer
     *
     * @ORM\Column(name="telefon", type="bigint")
     * @Assert\NotBlank()
     */
    private $telefon;
    
    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="user")
     */
    private $messages;

    /**
	* @ORM\Column(name="is_active", type="boolean")
	*/
	private $isActive;
	
	private $salt;
    
     private $credentials;
	
	
    
    public function __construct()
	{
		$this->isActive = true;
		// may not be needed, see section on salt below
		// $this->salt = md5(uniqid(null, true));
	}
	
	
	
    /**
     * Set roles
     *
     * @param string $roles
     * @return UserRegister
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }
    
    public function getRoles()
	{
		return  (array)$this->roles;
	}
    
    /**
     * Get credentials
     *
     * @return string 
     */
    public function getCredentials()
    {
      return $this->credentials ;

    }
    
    /**
	* @inheritDoc
	*/
	public function eraseCredentials()
	{
	}
	
	/**
	* @see \Serializable::serialize()
	*/
	public function serialize()
	{
		return serialize(array(
		$this->id,
		$this->username,
		$this->password,
		// see section on salt below
		// $this->salt,
		));
	}
	
	/**
	* @see \Serializable::unserialize()
	*/
	public function unserialize($serialized)
	{
		list (
			$this->id,
			$this->username,
			$this->password,
			// see section on salt below
			// $this->salt
			) = unserialize($serialized);
	}
	
	public function isEqualTo(UserInterface $user)
    {
    	return $this->id === $user->getId();
    }
    
     public function __toString()
    {
		return $this->username;
    }
   
	
	public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }
    
    
     /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
       return $this->salt ;
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
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set telefon
     *
     * @param integer $telefon
     * @return User
     */
    public function setTelefon($telefon)
    {
        $this->telefon = $telefon;

        return $this;
    }

    /**
     * Get telefon
     *
     * @return integer 
     */
    public function getTelefon()
    {
        return $this->telefon;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return UserRegister
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Add messages
     *
     * @param \GDdesign\UserBundle\Entity\Message $messages
     * @return UserRegister
     */
    public function addMessage(\GDdesign\UserBundle\Entity\Message $messages)
    {
        $this->messages[] = $messages;

        return $this;
    }

    /**
     * Remove messages
     *
     * @param \GDdesign\UserBundle\Entity\Message $messages
     */
    public function removeMessage(\GDdesign\UserBundle\Entity\Message $messages)
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
