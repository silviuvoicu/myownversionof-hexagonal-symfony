<?php
namespace Context;

use Behat\Behat\Exception\PendingException;
use SensioLabs\CeremonyTrackerBundle\Entity\ProjectManager;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';
 
class ProjectContext extends BaseContext
{
    
//    private $book;
    
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
    public function iHaveProjects($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When /^I list my projects$/
     */
    public function iListMyProjects()
    {
        throw new PendingException();
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
        throw new PendingException();
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
    }   
    
    private function iFillTheLoginFormWithValidDataForProjectManager()
    {
        
    }        
    
    
}
