<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyRepository")
 * @UniqueEntity(
 *      fields="title",
 *      message="Ce titre existe déjà."
 * )
 * @UniqueEntity(
 *      fields="address",
 *      message="Cette adresse est déjà utilisée."
 * )
 */
class Property
{

    const HEAT=[
        0 => 'Electrique',
        1 => 'Gaz',
        2 => 'Cheminée'
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 10,
     *      max = 200,
     *      minMessage = "Le titre doit contenir au minimum {{ limit }} caractères.",
     *      maxMessage = "Le titre ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 30,
     *      max = 1500,
     *      minMessage = "La surface doit être supérieure ou égale à {{ limit }} m².",
     *      maxMessage = "La surface doit être inférieure ou égale à {{ limit }} m²."
     * )
     */
    private $surface;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 1,
     *      max = 30,
     *      minMessage = "Le nombre de pièces doit être supérieur ou égal à {{ limit }}.",
     *      maxMessage = "Le nombre de pièces doit être inférieur ou égal à {{ limit }}."
     * )
     */
    private $rooms;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 1,
     *      max = 30,
     *      minMessage = "Le nombre de chambre doit être inférieur ou égal à {{ limit }}.",
     *      maxMessage = "Le nombre de chambre doit être supérieur ou égal à {{ limit }}."
     * )
     */
    private $bedrooms;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 50,
     *      minMessage = "L'étage doit être supérieur ou égal à {{ limit }}.",
     *      maxMessage = "L'étage doit être inférieur ou égal à {{ limit }}."
     * )
     */
    private $floor;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 10000,
     *      max = 100000000,
     *      minMessage = "Le prix doit être supérieur ou égal à {{ limit }} euros.",
     *      maxMessage = "Le prix doit être inférieur ou égal à {{ limit }} euros."
     * )
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $heat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *      pattern="/^[0-9]{5}$/",
     *      match=true,
     *      message="Le code postal doit contenir 5 chiffres."
     * )
     */
    private $postal_code;

    /**
     * @ORM\Column(type="boolean",options={"default": false})
     */
    private $sold=false;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * Constructeur
     * Rempli la propriété created_at lors de l'instanciation d'un nouvel objet Property
     */
    public function __construct()
    {
        $this->created_at=new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Retourne le slug d'un titre
     * @return string
     */
    public function getSlug(): string
    {
        //$slugify = new Slugify();
        //return $slugify->slugify($this->$title);
        return (new Slugify())->slugify($this->title);
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getBedrooms(): ?int
    {
        return $this->bedrooms;
    }

    public function setBedrooms(int $bedrooms): self
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Retourne le prix formaté
     * @return string
     */
    public function getFormattedPrice(): string
    {
        return number_format($this->price,0,'',' ');
    }

    public function getHeat(): ?int
    {
        return $this->heat;
    }

    public function setHeat(int $heat): self
    {
        $this->heat = $heat;

        return $this;
    }

    public function getHeatType(): string {
        return self::HEAT[$this->heat];
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getSold(): ?bool
    {
        return $this->sold;
    }

    public function setSold(bool $sold): self
    {
        $this->sold = $sold;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
