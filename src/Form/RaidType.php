<?php

namespace App\Form;

use App\Entity\Character;
use App\Entity\Raid;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class RaidType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dayOne', CheckboxType::class, [
                'label' => false,
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
            ])
            ->add('dayTwo', CheckboxType::class, [
                'label' => false,
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
            ])
            ->add('dayThree', CheckboxType::class, [
                'label' => false,
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
            ])

            ->add('userCharacter', ChoiceType::class, [
                'choices' => $this->getUserCharacter(),
                'label' => false,
                'attr' => ['class' => 'custom-select'],
            ])
        ;
    }

    public function getUserCharacter()
    {
        $characters = $this->security->getUser()->getCharacters();
        $choices = [];
        foreach ($characters as $character) {
            $choices[$character->getName()] = $character->getId();
        }
        return $choices;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}
