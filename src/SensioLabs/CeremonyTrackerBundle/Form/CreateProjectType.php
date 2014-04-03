<?php

namespace SensioLabs\CeremonyTrackerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CreateProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text'
//                , ['constraints' => [
//            new NotBlank(['message' => 'Project does not have a name.']),
//            new Length(['min' => 3, 'max' => 255,'minMessage'=>'The name must have more than 2 characters'])
//                ] ]
                );
    }

    public function getName()
    {
        return 'create_project';
    }
}
