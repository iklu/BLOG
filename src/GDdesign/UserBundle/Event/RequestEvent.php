<?php
namespace GDdesign\UserBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class RequestEvent extends Event
{
    
    private $request;
    private $response;
    private $entityRepository;
    private $entityManager;

    public function __construct(Request $request, EntityRepository $entityRepository,EntityManager $entityManager)
    {
        $this->entityRepository = $entityRepository;
        $this->entityManager = $entityManager;
        $this->request = $request;
    }

  
    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }
    
    /**
     * @return Request
     */
    public function getEntityRepository()
    {
    	return $this->entityRepository;
    }
    
    /**
     * @return Request
     */
    public function getEntityManager()
    {
    	return $this->entityManager;
    }

    public function setResponse($response)
    {
        $this->response = new Response(json_encode($response));
        $this->response->headers->set('Content-Type', 'application/json');
        return $this->response;
        
       
    }

    /**
     * @return Response|null
     */
    public function getResponse()
    {
    	
        return $this->response;
        
    }
}


?>