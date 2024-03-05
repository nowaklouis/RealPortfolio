<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'E-mail',
                'label_attr' => [
                    'class' => 'white-label', // Ajoutez une classe CSS personnalisée pour le label
                ],
            ])
            ->add('sujet', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Sujet',
                'label_attr' => [
                    'class' => 'white-label', // Ajoutez une classe CSS personnalisée pour le label
                ],
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 4
                ],
                'label' => 'Votre message ici',
                'label_attr' => [
                    'class' => 'white-label', // Ajoutez une classe CSS personnalisée pour le label
                ],
            ])
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'index',
                'hide_badge' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
