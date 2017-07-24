<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Gedmo\Mapping\Annotation as Gedmo,
    Symfony\Component\Validator\Constraints as Assert,
    Doctrine\Common\Collections\ArrayCollection;

/**
 * Categories
 *
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="nome", type="text", nullable=false)
     * @Assert\NotBlank(message="entity.category.name.notblank")
     */
    private $name;

    /**
     * @var integer
     *
     * @Gedmo\TreeLeft
     * @ORM\Column(name="tree_left", type="integer")
     */
    private $treeLeft;

    /**
     * @var integer
     *
     * @Gedmo\TreeLevel
     * @ORM\Column(name="tree_level",type="integer")
     */
    private $treeLevel;

    /**
     * @var integer
     *
     * @Gedmo\TreeRight
     * @ORM\Column(name="tree_right",type="integer")
     */
    private $treeRight;

    /**
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     * @ORM\OrderBy({"treeLeft" = "ASC"})
     */
    private $children;

    /**
     * 
     */
    public function __construct() {
        $this->children = new ArrayCollection;
    }

    /**
     * 
     * @return ArrayCollection
     */
    public function getChildCategories() {
        return $this->children;
    }

    /**
     * Set nome
     *
     * @param string $name
     *
     * @return Categorias
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set parentId
     *
     * @param integer $parent
     *
     * @return Categorias
     */
    public function setParent(Category $parent = null) {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get treeLeft
     *
     * @return integer
     */
    public function getTreeLeft() {
        return $this->treeLeft;
    }

    /**
     * Get treeLevel
     *
     * @return integer
     */
    public function getTreeLevel() {
        return $this->treeLevel;
    }

    /**
     * Get treeRight
     *
     * @return integer
     */
    public function getTreeRight() {
        return $this->treeRight;
    }

    public function getRoot() {
        return $this->root;
    }

}
