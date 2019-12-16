<?php

namespace ApiBundle\Entity\ChinaBrands;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="cb_category")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\ChinaBrands\CategoryRepository")
 */
class Category
{
    /**
     *
     */
    public const STATUS_DRAFT = 0;
    /**
     *
     */
    public const STATUS_PUBLISHED = 1;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_id", type="integer")
     */
    private $catId;

    /**
     * @var string
     *
     * @ORM\Column(name="cat_name", type="string", length=255)
     */
    private $catName;

    /**
     * @var int
     *
     * @ORM\Column(name="parent_id", type="integer")
     */
    private $parentId;

    /**
     * @var int
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var string|null
     *
     * @ORM\Column(name="node", type="string", length=255, nullable=true)
     */
    private $node;

    /**
     * @ORM\ManyToOne(targetEntity="\ApiBundle\Entity\Category", inversedBy="catChina")
     *
     */
    private $catLocal;

    /**
     * @return mixed
     */
    public function getCatLocal()
    {
        return $this->catLocal;
    }

    /**
     * @param mixed $catLocal
     */
    public function setCatLocal(\ApiBundle\Entity\Category $catLocal): void
    {
        $this->catLocal = $catLocal;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set catId.
     *
     * @param int $catId
     *
     * @return Category
     */
    public function setCatId($catId)
    {
        $this->catId = $catId;

        return $this;
    }

    /**
     * Get catId.
     *
     * @return int
     */
    public function getCatId()
    {
        return $this->catId;
    }

    /**
     * Set catName.
     *
     * @param string $catName
     *
     * @return Category
     */
    public function setCatName($catName)
    {
        $this->catName = $catName;

        return $this;
    }

    /**
     * Get catName.
     *
     * @return string
     */
    public function getCatName()
    {
        return $this->catName;
    }

    /**
     * Set parentId.
     *
     * @param int $parentId
     *
     * @return Category
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId.
     *
     * @return int
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set level.
     *
     * @param int $level
     *
     * @return Category
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level.
     *
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set node.
     *
     * @param string|null $node
     *
     * @return Category
     */
    public function setNode($node = null)
    {
        $this->node = $node;

        return $this;
    }

    /**
     * Get node.
     *
     * @return string|null
     */
    public function getNode()
    {
        return $this->node;
    }
}
