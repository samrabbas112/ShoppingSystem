<?php
namespace App\Form;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product_name',TextType::class,[
                'label'=>'Enter Email',
                'required'=>true,
            ])
            ->add('product_price',TextType::class,[
                'label'=>'ENTER PASSWORD',
            ])
            ->add('Category',EntityType::class,[
                'class'=>Category::class,
                'query_builder'=>function (EntityRepository $er){
                        return $er->createQueryBuilder('c')
                            ->orderBy('c.category_name','ASC');
                },
                'choice_label'=>'category_name',
                    ]);

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>Product::class,
        ]);
    }
}
