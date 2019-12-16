<?php

namespace ApiBundle\Command\ChinaBrands;


use ApiBundle\Manager\ChinaBrands\Api;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddCategories extends ContainerAwareCommand
{

    protected function configure(): void
    {
        $this
            ->setName('cb:persist_categories')
            ->setDescription('Uploading china brands categories')
            ->setHelp('Uploading china brands categories to database');
        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException

     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Api $chinaBrandsApiManager */
        $chinaBrandsApiManager = $this->getContainer()->get('api.cb_api_manager');
        $categories = $chinaBrandsApiManager->getCategories();

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $categoryManager = $this->getContainer()->get('api.china_category_manager');

        foreach ($categories as $category ) {
            $catID = $category['cat_id'];
            $catName = $category['cat_name'];
            $parentId = $category['parent_id'];
            $level = $category['level'];
            $node = $category['node'];

            $categoryManager->insertCategory($catID, $catName, $parentId, $level, $node);
        }

        $em->flush();

        $output->writeln('Done!');
    }
}