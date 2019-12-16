<?php

namespace ApiBundle\Manager\ChinaBrands;

use ApiBundle\Entity\ChinaBrands\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;


class CategoryManager extends Controller
{

    /** @var EntityManagerInterface */
    protected $em;

    /**
     * CategoryManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param int $catID
     * @param string $catName
     * @param int $parentId
     * @param int $level
     * @param string|null $node
     */
    public function insertCategory(int $catID , string $catName, int $parentId, int $level, string $node = null)
    {
        $category = new Category();

        if ($catID === 0){
            throw new Exception("Incorrect data category id");
        }
        if (trim($catName) === ''){
            throw new Exception("Incorrect data category name");
        }
        if (!$level){
            throw new Exception("Incorrect data level");
        }

        $category->setCatId($catID);
        $category->setCatName($catName);
        $category->setParentId($parentId);
        $category->setLevel($level);
        $category->setNode($node);

        $this->em->persist($category);
    }
}

