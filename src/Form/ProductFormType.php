<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;


class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('nom',TextType::class,[
                'attr'=>[
                    'class'=>'form-control mynom'
                ]
            ])
            ->add('prenom',TextType::class,[
                'attr'=>[
                    'class'=>'form-control myprenom',
                    
                ]
            ])
            ->add('email',EmailType::class,[
                'attr'=>[
                    'class'=>'form-control myemail'
                ]
            ])
            ->add('telephone',TelType::class,[
                'attr'=>[
                    'class'=>'form-control mytelephone',
                    'required' => true,
                ]
            ])
            ->add('dateNaissance',BirthdayType::class,[
                'attr'=>[
                    'class'=>'mydatenaissance',
                    'required'   => false,
                ]
            ])
            ->add('statut')
            ->add('adresse',null,[
                'attr'=>[
                    'class'=>'form-control myadresse',
                   
                    
                ]
            ])
            ->add('inshoused',null,[
                'attr'=>[
                    'class'=>'inshoused'
                ]
            ])
            ->add('idTypeBourse',null,[
                'attr'=>[
                    'class'=>'form-control myidtypebourse'
                ]
            ])
            ->add('numeroChambre',null,[
                'attr'=>[
                    'class'=>'form-control mynumerochambre'
                ]
            ])
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
