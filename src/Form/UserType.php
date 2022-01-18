<?php
namespace App\Form;
use App\Entity\User;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Email',EmailType::class,[
                'label'=>'Enter Email',
                'required'=>true,
            ])
            ->add('password',PasswordType::class,[
                'label'=>'ENTER PASSWORD',
            ])
            ->add('phone_number',NumberType::class,[
                'label'=>'Enter NUmber',
            ])
            ->add('address',TextType::class,[
                'label'=>'Enter Address',
            ])
            ->add('country',TextType::class,[
                'label'=>'Enter Country',
            ])
            ->add('cnic',TextType::class,[
                'label'=>'Enter CNIC',
            ]);

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>User::class,
        ]);
    }
}


