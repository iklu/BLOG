<?php
namespace GDdesign\UserBundle\EventListener;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;


class  ExceptionListener 
{
	public function onKernelException(GetResponseForExceptionEvent $event)
	{
		// You get the exception object from the received event
		$exception = $event->getException();
		if($exception->getCode()==0)
		{
			//$response = new RedirectResponse('/BLOG/web/not-found');
			//return $response->send();
		}	
		$message = sprintf('My Error says: %s with code: %s', $exception->getMessage(), $exception->getCode() );
		// Customize your response object to display the exception details
		$response = new Response();
		$response->setContent($message);
		// HttpExceptionInterface is a special type of exception that
		// holds status code and header details
		if ($exception instanceof HttpExceptionInterface) 
		{
			$response->setStatusCode($exception->getStatusCode());
			$response->headers->replace($exception->getHeaders());
		} 
		else 
		{
			$response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
		}
		// Send the modified response object to the event
		//$event->setResponse($response);
		
	      // echo "<br><span style='color:green';>Tienes una error de tipo : </span> <span style='color:red';>".$response."</span>!!";
	}
}		
