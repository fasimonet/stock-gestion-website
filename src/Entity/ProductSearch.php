<?php 

namespace App\Entity;

class ProductSearch 
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $barCode;

    /**
     * @var Category|null
     */
    private $category;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return ProductSearch
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBarCode(): ?string
    {
        return $this->barCode;
    }

    /**
     * @param string|null $barCode
     * @return ProductSearch
     */
    public function setBarCode(string $barCode): self
    {
        $this->barCode = $barCode;
        return $this;
    }

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category|null $category
     * @return Category
     */
    public function setCategory(Category $category): self
    {
        $this->category = $category;
        return $this;
    }
}