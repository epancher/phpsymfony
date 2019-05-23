<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PictureRepository")
 * @Vich\Uploadable
 */
class Picture
{
        ///////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////
        ///////////////////////////     ATTRIBUTS     /////////////////////////////
        ///////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Evenements", inversedBy="pictures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $evenements;

    /**
     * @var File|null
     * @Assert\Image(
     *      mimeTypes="image/jpeg"
     * )
     * @Vich\UploadableField(mapping="evenement_image", fileNameProperty="filename")
     */
    private $imageFile;    



        ///////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////
        //////////////////////////     ACCESSEURS     /////////////////////////////
        ///////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////

    public function getId(): ?int
    {return $this->id;}

    /**
     * @return null|string
     */
    public function getFilename(): ?string
    {return $this->filename;}

    /**
     * @param null|string $filename
     * @return Evenements
     */    
    public function setFilename(?string $filename): self
    {$this->filename = $filename;
     return $this;}

    public function getEvenements(): ?Evenements
    {return $this->evenements;}

    public function setEvenements(?Evenements $evenements): self
    {$this->evenements = $evenements;
     return $this;}

    /**
     * @return null|File
     */
    public function getImageFile(): ?File
    {return $this->imageFile;}

    /**
     * @param null|File $imageFile
     * @return Evenements
     */
    public function setImageFile(?File $imageFile): self
    {$this->imageFile = $imageFile;
        return $this;}


        
        ///////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////
        /////////////////////////     CONSTRUCTEURS     ///////////////////////////
        ///////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////


        

        ///////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////
        ////////////////////////////     METHODES     /////////////////////////////
        ///////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////

}
