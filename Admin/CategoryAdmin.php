<?php

namespace AdminBundle\Admin\ChinaBrands;


use ApiBundle\Entity\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\Form\Type\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategoryAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('catName', TextType::class)
            ->add('catLocal', ModelType::class, [
                'class' => Category::class,
                'property' => 'title',
            ])
        ;
    }

   protected function configureDatagridFilters(DatagridMapper $datagridMapper)
        {
            $datagridMapper
                ->add('catLocal', 'doctrine_orm_callback', [
                    'label' => 'Cat Relation',
                    'translation_domain' => 'SonataCoreBundle',
                    'callback' => function($queryBuilder, $alias, $field, $value) {
                        if (!isset($value['value'])) {
                            return;
                        }
                        if ($value['value'] == BooleanType::TYPE_YES) {
                            $queryBuilder->andWhere(sprintf('%s.%s IS NOT NULL', $alias, $field));
                        }
                        if ($value['value'] == BooleanType::TYPE_NO) {
                            $queryBuilder->andWhere(sprintf('%s.%s IS NULL', $alias, $field));
                        }

                        return true;
                    }
                ], 'choice', [
                        'translation_domain' => 'SonataCoreBundle',
                        'choices' => [
                            'Not exist' => BooleanType::TYPE_YES,
                            'Exist'  => BooleanType::TYPE_NO
                        ]
                    ],
                    [
                        'show_filter' => true,
                    ]
                )
            ;
        }


    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier(
                'catName',
                null,
                [
                    'label' => 'Category name',
                ]
            )
            ->addIdentifier(
                'catLocal',
                EntityType::class,
                [
                    'choice_label' => 'Mapped category',
                    'class' => Category::class,
                    'associated_property' => 'title',
                ]
            );

    }

}