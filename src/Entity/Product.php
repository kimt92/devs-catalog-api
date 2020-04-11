<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\CreateProductImageAction;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ApiResource(
 *     iri="http://schema.org/Product",
 *     normalizationContext={
 *         "groups"={"product:read"}
 *     },
 *     collectionOperations={
 *         "post"={
 *             "controller"=CreateProductImageAction::class,
 *             "deserialize"=false,
 *             "validation_groups"={"Default", "product:create"},
 *             "openapi_context"={
 *                 "requestBody"={
 *                     "content"={
 *                         "multipart/form-data"={
 *                             "schema"={
 *                                 "type"="object",
 *                                 "properties"={
 *                                     "imageFile"={
 *                                         "type"="string",
 *                                         "format"="binary"
 *                                     },
                                        "name"={
 *                                         "type"="string"
 *                                     },
                                        "price"={
 *                                         "type"="int"
 *                                     },
                                        "quantity"={
 *                                         "type"="int"
 *                                     },
 *                                 }
 *                             }
 *                         }
 *                     }
 *                 }
 *             }
 *         },
 *         "get"
 *         
 *                 
 *     },
 *     itemOperations={
 *         "get",
 *         "put",
 *         "patch",
 *         "delete"
 *     }
 * )
 * @Vich\Uploadable
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"product:read","category:read"})
     */
    private $id;

     /**
     * @var string|null
     *
     * @ApiProperty(iri="http://schema.org/contentUrl")
     * @Groups({"product:read","category:read"})
     */
    public $contentUrl;

     /**
     * @var File|null
     *
     * @Assert\NotNull(groups={"product:create"})
     * @Vich\UploadableField(mapping="media_product", fileNameProperty="image")
     */
    public $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"product:read","category:read"})
     */
    public $image;



    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"product:read","category:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     * @Groups({"product:read","category:read"})
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"product:read","category:read"})
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
     */
    private $category;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCategory(): ?category
    {
        return $this->category;
    }

    public function setCategory(?category $category): self
    {
        $this->category = $category;

        return $this;
    }

    
}
