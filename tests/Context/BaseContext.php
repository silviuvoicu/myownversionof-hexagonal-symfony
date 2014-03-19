<?php
namespace Context;

use Behat\Behat\Context\BehatContext;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Base context class.
 *
 */
abstract class BaseContext extends BehatContext implements KernelAwareInterface
{
    /**
     * Kernel.
     *
     * @var KernelInterface
     */
    protected $kernel;
    
//    public function __construct(array $parameters)
//    {
//        // do subcontext initialization
//    }

    /**
     * {@inheritdoc}
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    protected function getEntityManager()
    {
        return $this->getService('doctrine.orm.entity_manager');
    }

    protected function generateUrl($route, array $params = array())
    {
        return $this->getRouter()->generate($route, $params);
    }

    protected function getRouter()
    {
        return $this->kernel->getContainer()->get('router');
    }

    protected function getService($id)
    {
        return $this->kernel->getContainer()->get($id);
    }
    protected function getMinkContext()
    {
       return $this->getMainContext()->getSubcontext('mink');
    }        
}


