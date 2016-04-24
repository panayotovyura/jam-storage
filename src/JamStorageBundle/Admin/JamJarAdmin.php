<?php

namespace JamStorageBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use JamStorageBundle\Services\JamJarService;
use JamStorageBundle\Entity\JamType;
use JamStorageBundle\Entity\JamYear;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class JamJarAdmin extends Admin
{
    /**
     * Create amount-1 of new jams before real creating
     *
     * @param mixed $jamJar
     */
    public function prePersist($jamJar)
    {
        $amount = (int)$this->getForm()->get('amount')->getData();
        if ($amount > 1) {
            $this->getJamJarService()->cloneJams($jamJar, --$amount);
        }
    }

    /**
     * @param JamJarService $jamJarService
     */
    public function setJamJarService(JamJarService $jamJarService)
    {
        $this->jamJarService = $jamJarService;
    }

    /**
     * @return JamJarService
     */
    public function getJamJarService()
    {
        return $this->jamJarService;
    }

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add(
                'type',
                EntityType::class,
                ['class' => JamType::class]
            )
            ->add(
                'year',
                EntityType::class,
                ['class' => JamYear::class]
            )
            ->add(
                'comment',
                TextType::class,
                ['label' => 'jam.jar.comment.label']
            );

        $jamJar = $this->getSubject();

        if (!$jamJar->getId()) {
            $formMapper->add(
                'amount',
                NumberType::class,
                [
                    'mapped'=> false,
                    'data' => 1,
                    'label' =>
                        'jam.jar.amount.label'
                ]
            );
        }
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('type')
            ->add('year');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('type')
            ->add('year')
            ->add('comment');
    }
}
