<?php

namespace App\Form;

use App\Entity\Chambre;
use App\Entity\Etudiant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('prenom')
            ->add('nom')
            ->add('mail')
            ->add('departement',ChoiceType::class, array(
                'choices'=> array('Sciences Economiques'=>'Sciences Economiques',
                    'Langues étrangères'=>'Langues étrangères', 'Informatique'=>'Informatique')
            ))
            ->add('adresse')
            ->add('telephone')
            ->add('type_etudiant',ChoiceType::class, array(
                'choices'=> array('Boursier logé'=>'Boursier logé',
                    'Boursier non-logé'=>'Boursier non-logé', 'Non-boursier'=>'Non-boursier')
            ))
            ->add('type_bourse', ChoiceType::class, array(
                'choices'=> array('Demi-bourse'=> 'Demi-bourse', 'Pension complète'=> 'Pension complète')
            ))
            ->add('num_chambre',  EntityType::class, [
                'class' => Chambre::class,
                'choice_label'=> 'num_chambre',
            ]);


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
