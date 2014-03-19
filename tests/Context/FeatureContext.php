<?php
namespace Context;

use Behat\MinkExtension\Context\RawMinkContext;
use Behat\MinkExtension\Context\MinkContext;
//use Behat\CommonContexts\MinkRedirectContext;
//use Behat\CommonContexts\SymfonyMailerContext;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Component\HttpKernel\KernelInterface;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends RawMinkContext implements KernelAwareInterface
{
    /**
     * Kernel.
     *
     * @var KernelInterface
     */
    private $kernel;

    /**
     * Parameters.
     *
     * @var array
     */
    private $parameters;

    /**
     * Initializes context with parameters from behat.yml.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;

        $this->useContext('project_management', new ProjectContext($parameters)); 
//         $this->useContext('symfony_mailer_context', new SymfonyMailerContext());
//         $this->useContext('mink_redirect_context', new MinkRedirectContext());
         $this->useContext('mink', new  MinkContext()); 
           
        
    }

    /**
     * {@inheritdoc}
     */
     public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @BeforeScenario
     */
    public function purgeDatabase()
    {
        $em = $this->kernel->getContainer()->get('doctrine.orm.entity_manager');

        $purger = new ORMPurger($em);
        $purger->purge();
        
//        $conn = $this->kernel->getContainer()->get('database_connection');
//        $conn->executeQuery('DELETE FROM acl_classes');
//        $conn->executeQuery('DELETE FROM acl_entries ');
//        $conn->executeQuery('DELETE FROM acl_object_identities');
//        $conn->executeQuery('DELETE FROM acl_object_identity_ancestors');
//        $conn->executeQuery('DELETE FROM acl_security_identities');
    }
   

          
   
}
