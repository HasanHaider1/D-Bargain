<?php

namespace productbargain\Forms;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\FormBuilderInterface;

class BargainType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          /*  ->add('id', HiddenType::class , array(
                "attr" => array(
                    "placeholder" => "ID",
                )
            ))*/
            ->add('iterations', NumberType::class , array(
                "attr" => array(
                    "placeholder" => "Number of max iterations",
                ),
              'label' => 'No of Max Iterations'
            ))
            ->add('color', ColorType::class , array(
                "attr" => array(
                    "placeholder" => "Chat Iterface Color"
                ),
                'label' => 'Color of Chat Interface'
            ))
            ->add('chatdisplay', ChoiceType::class, [
                'choices'  => [
                    'Chat Interface Popup' => '1',
                    'Button for Chat Interface' => '0'
                ],
                'label' => 'Chat Display'
            ])
            ->add('wait', ChoiceType::class, [
                'choices'  => [
                    'Wait to show chat interface/button for 30 secs' => '1',
                    'Show Chat Interface immediately' => '0'
                ],
                'label' => 'Time before Chat Display'
            ])
            ->add('save', SubmitType::class);
    }





}