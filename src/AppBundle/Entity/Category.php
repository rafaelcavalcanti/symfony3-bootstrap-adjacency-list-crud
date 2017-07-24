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
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children", cascade={"all"})
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     */
    protected $parentId = null;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parentId", cascade={"all"})
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
     * @param integer $parentId
     *
     * @return Categorias
     */
    public function setParentId(Category $parentId = null) {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer
     */
    public function getParentId() {
        return $this->parentId;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

}
