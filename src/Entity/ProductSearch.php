<?php 

namespace App\Entity;

class ProductSearch 
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var int|null
     */
    private $barcode;

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
     * @return int|null
     */
    public function getBarcode(): ?int
    {
        return $this->barcode;
    }

    /**
     * @param int|null $barcode
     * @return ProductSearch
     */
    public function setBarcode(int $barcode): self
    {
        return $this;
    }


}