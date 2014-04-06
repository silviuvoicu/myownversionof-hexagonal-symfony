<?php

namespace SensioLabs\CeremonyTracker;

use SensioLabs\Ceremonies\Project;
use SensioLabs\Ceremonies\ProjectRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\ValidatorInterface;

class CreateProject
{
    const SUCCESS = 'sensio.ceremony_tracker.project_creation_success';
    const FAILURE = 'sensio.ceremony_tracker.project_creation_failure';

    private $repository;
    private $dispatcher;
    private $validator;

    public function __construct(ProjectRepositoryInterface $repository, EventDispatcherInterface $dispatcher, ValidatorInterface $validator = null)
    {
        $this->repository = $repository;
        $this->dispatcher = $dispatcher;
        $this->validator = $validator;
    }

    public function createProject(Project $project)
    {
        
        $errors =$this->validator->validate($project) ;
//        var_dump($project);
//        var_dump($this->validator);
//        var_dump($errors);die;
        if (count($errors) > 0) {
            $this->dispatcher->dispatch(self::FAILURE, new Event([
                'project' => $project,
                'reason'  => $this->validator->validate($project)->get(0)->getMessage()
            ]));

            return;
        }

        $this->repository->save($project);
        $this->dispatcher->dispatch(self::SUCCESS, new Event(['project' => $project]));
    }
}
