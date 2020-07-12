<?php

namespace App\Form;

use App\Entity\EtudiantSearch;
use Doctrine\DBAL\Types\StringType;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Exception\StringCastException;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\String\ByteString;

class EtudiantSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom')
            ->add('nom')
            ->add('departement', ChoiceType::class, array(
                'choices'=> array(''=>'0',
                    'Sciences Economiques'=>'Sciences Economiques',
                    'Langues étrangères'=>'Langues étrangères', 'Informatique'=>'Informatique')
            ))
            ->add('typeEtudiant',ChoiceType::class, [
                'choices'=> [''=>'0',
                    'Boursier logé'=>'Boursier logé',
                    'Boursier non-logé'=>'Boursier non-logé', 'Non-boursier'=>'Non-boursier']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EtudiantSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
