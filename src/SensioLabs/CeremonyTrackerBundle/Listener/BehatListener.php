<?php

namespace SensioLabs\CeremonyTrackerBundle\Listener;

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;


class BehatListener {
/***
 * @var Symfony\Component\HttpKernel\Kernel $kernel
 */    
private $kernel;

/***
 * @var Bool $isAppTest
 *
 */
private $isAppTest;

/***
 * @var Exception $exception
 */
private $exception;

public function __construct(Kernel $kernel) {
    $this->kernel = $kernel;
}    
    public function onKernelException(GetResponseForExceptionEvent $event)
{
   
    $this->isAppTest = ($this->kernel->getEnvironment() == "test") ? true : false;

    
    if ($this->isAppTest ){
 
       
        $this->exception = $event->getException();
        
        
            throw $this->exception;

    }

}


}    


