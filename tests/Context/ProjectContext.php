<?php
namespace Context;

use Behat\Behat\Exception\PendingException;
use SensioLabs\CeremonyTrackerBundle\Entity\ProjectManager;
use SensioLabs\CeremonyTrackerBundle\Entity\Project;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';
 
class ProjectContext extends BaseContext
{
    
   private $projectManager;
    
    /**
     * @Given /^I am a project manager$/
     */
    public function iAmAProjectManager()
    {
        $this->projectManager  = $this->projectManagerExists();
        $this->iFillTheLoginFormWithValidDataForProjectManager();
    }

    /**
     * @When /^I create the "([^"]*)" project$/
     */
    public function iCreateTheProject($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then /^the "([^"]*)" project should be saved$/
     */
    public function theProjectShouldBeSaved($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I should be notified about the project creation success$/
     */
    public function iShouldBeNotifiedAboutTheProjectCreationSuccess()
    {
        throw new PendingException();
    }

    /**
     * @When /^I create the project$/
     */
    public function iCreateTheProject2()
    {
        throw new PendingException();
    }

    /**
     * @Then /^the project should not be saved$/
     */
    public function theProjectShouldNotBeSaved()
    {
        throw new PendingException();
    }

    /**
     * @Given /^I should be notified about the project creation failure$/
     */
    public function iShouldBeNotifiedAboutTheProjectCreationFailure()
    {
        throw new PendingException();
    }

    /**
     * @Given /^I have (\d+) projects$/
     */
    public function iHaveProjects($numbersOfProjects)
    {
        for($projectNumber=0;$projectNumber < $numbersOfProjects;$projectNumber++)
        {
            $projects[] = new Project("project number $projectNumber",$this->projectManager);
        }
        $em= $this->getEntityManager();
        foreach($projects as $project)
        {
            $em->persist($project);
            $em->persist($this->projectManager);
            $em->flush();
        }    
        
    }

    /**
     * @When /^I list my projects$/
     */
    public function iListMyProjects()
    {
        $this->getMinkContext()->visit($this->getMinkContext()->getMinkParameter("base_url").$this->generateUrl('list_my_projects'));
    }

    /**
     * @Then /^I should get a list of (\d+) projects$/
     */
    public function iShouldGetAListOfProjects($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I have no projects$/
     */
    public function iHaveNoProjects()
    {   
        $em= $this->getEntityManager();
        $numberOfProjects = $em->getRepository("CeremonyTrackerBundle:Project")->findAll();
        assertEmpty($numberOfProjects,"There are projects already");
    }

    /**
     * @Then /^I should get an empty list of projects$/
     */
    public function iShouldGetAnEmptyListOfProjects()
    {
        throw new PendingException();
    }

    private function projectManagerExists()
    {
        $projectManager = new ProjectManager("silviu");
        $projectManager->setPassword("qwerty");
        $encoder = $this->getService('security.encoder_factory')->getEncoder($projectManager);
        $encodedPassword = $encoder->encodePassword(
                    $projectManager->getPassword(),
                    $projectManager->getSalt()
                );
        $projectManager->setPassword($encodedPassword);
        $em= $this->getEntityManager();
        $em->persist($projectManager);
        $em->flush();
        return $projectManager;
    }   
    
    private function iFillTheLoginFormWithValidDataForProjectManager()
    {
         $name = "silviu";
         $this->getMinkContext()->visit($this->getMinkContext()->getMinkParameter("base_url").$this->generateUrl('login'));
         $this->getMinkContext()->fillField("username", $name);
         $this->getMinkContext()->fillField("password", "qwerty");
         $this->getMinkContext()->pressButton("login");
    }        
    
    
}
