<?php
namespace Context;

use Behat\Behat\Exception\PendingException;
use SensioLabs\CeremonyTrackerBundle\Entity\ProjectManager;
use SensioLabs\CeremonyTrackerBundle\Entity\Project;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';
 
class ProjectContext extends BaseContext
{
    
//   private $projectManager;
    
    /**
     * @Given /^I am a project manager$/
     */
    public function iAmAProjectManager()
    {
        $this->projectManagerExists();
        $this->iFillTheLoginFormWithValidDataForProjectManager();
    }

    /**
     * @When /^I create the "([^"]*)" project$/
     */
    public function iCreateTheProject($name)
    {
//        $this->iListMyProjects();
        $this->getMinkContext()->fillField("create_project_name", $name);
        $this->getMinkContext()->pressButton("submit");
//        $inputCreateProject= $this->getMinkContext()->getSession()->getPage()->find('css', '#create_project_name');
//        $inputCreateProject->focus();
//        $this->getMinkContext()->getSession()->getDriver()->keyPress($inputCreateProject->getXPath(), 13);
//               
    }
    
    /**
     * @Then /^the "([^"]*)" project should be saved$/
     */
    public function theProjectShouldBeSaved($name)
    {   
//    
        $em= $this->getEntityManager();
        $nameOfProject = $em->getRepository("CeremonyTrackerBundle:Project")->findOneByName($name);
//        var_dump($nameOfProject->getName());die;
        assertEquals($name,$nameOfProject->getName(),"The project $name was not saved in the database");
    }

    /**
     * @Given /^I should be notified about the project creation success$/
     */
    public function iShouldBeNotifiedAboutTheProjectCreationSuccess()
    {
        $this->getMinkContext()->assertPageContainsText("Project has been created.");         
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
        $projectManager = $this->getProjectManager();
        for($projectNumber=0;$projectNumber < $numbersOfProjects;$projectNumber++)
        {
            $projects[] = new Project("project number $projectNumber",$projectManager);
        }
        $em= $this->getEntityManager();
        foreach($projects as $project)
        {
            $em->persist($project);
            $em->persist($projectManager);
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
    public function iShouldGetAListOfProjects($numberOfProjects)
    {
        assertEquals($numberOfProjects,$this->getNumberOfProjects(),"The number of Projects are not the same");
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
        $this->iShouldGetAListOfProjects(0);
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
//        return $projectManager;
    }   
    
    private function iFillTheLoginFormWithValidDataForProjectManager()
    {
         $name = "silviu";
         $this->getMinkContext()->visit($this->getMinkContext()->getMinkParameter("base_url").$this->generateUrl('login'));
         $this->getMinkContext()->fillField("username", $name);
         $this->getMinkContext()->fillField("password", "qwerty");
         $this->getMinkContext()->pressButton("login");
    } 
    
    private function getProjectManager()
    {
        $em= $this->getEntityManager();
        $projectManager = $em->getRepository("CeremonyTrackerBundle:ProjectManager")->findOneByName("silviu");
        return $projectManager;
    } 
    
    private function getNumberOfProjects()
    {
        $em= $this->getEntityManager();
        $numberOfProjects = $em->getRepository("CeremonyTrackerBundle:Project")->findAll();
        return count($numberOfProjects);
    }         
    
    
}
