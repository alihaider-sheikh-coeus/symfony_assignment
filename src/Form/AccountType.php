<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AccountType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options):void
{
    $builder
        ->add('account_id', TextType::class)
        ->add('name', TextType::class)
        ->add('password', TextType::class);
}
}