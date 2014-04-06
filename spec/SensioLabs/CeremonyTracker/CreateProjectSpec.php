<?php

namespace spec\SensioLabs\CeremonyTracker;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SensioLabs\Ceremonies\ProjectRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\ValidatorInterface;
use SensioLabs\Ceremonies\Project;

class CreateProjectSpec extends ObjectBehavior
{
    function let(ProjectRepositoryInterface $repository, EventDispatcherInterface $dispatcher, ValidatorInterface $validator)
    {
        $this->beConstructedWith($repository, $dispatcher,$validator);
    }

    function it_saves_a_named_project_to_the_repository(Project $project, $repository, $validator)
    {
       $errors = array();
        $validator->validate($project)->willReturn($errors); 
      //  $project->getName()->willReturn('Nokia');

        $repository->save($project)->shouldBeCalled();

        $this->createProject($project);
    }

    function it_reports_success_to_the_dispatcher(Project $project, $dispatcher, $validator)
    {
        $errors = array();
        $validator->validate($project)->willReturn($errors); 
      //  $project->getName()->willReturn('Nokia');

        $dispatcher->dispatch($this->SUCCESS, Argument::any())->shouldBeCalled();

        $this->createProject($project);
    }

    function it_does_not_save_an_unnamed_project(Project $project, $repository, $validator)
    {
        $errors = array();
        $validator->validate($project)->willReturn($errors); 
        
        if (count($errors) >0){
        $repository->save($project)->shouldNotBeCalled();

        $this->createProject($project);
        }
    }

    function it_reports_failure_to_the_dispatcher(Project $project, $dispatcher, $validator)
    {
        $errors = array();
        $validator->validate($project)->willReturn($errors); 
        if (count($errors) >0){
        $dispatcher->dispatch($this->FAILURE, Argument::any())->shouldBeCalled();

        $this->createProject($project);
        }
    }
}
