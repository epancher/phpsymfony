<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EvenementsRepository")
 * 
 * pour que chaque évènement possède un nom unique non réutilisable:
 * @UniqueEntity("titre_evnmt")
 */
class Evenements
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
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min="5", max="100")
     */
    private $titre_evnmt;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(max="500")
     */
    private $txt_evnmt;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_evnmt;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heure_evnmt;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime|null
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Picture", mappedBy="evenements", orphanRemoval=true, cascade={"persist"})
     */
    private $pictures;

    /**
     * @Assert\All({
     *   @Assert\Image(mimeTypes="image/jpeg")
     * })
     */
    private $pictureFiles;



        ///////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////
        //////////////////////////     ACCESSEURS     /////////////////////////////
        ///////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////

    public function getId(): ?int
    {return $this->id;}

    public function getTitreEvnmt(): ?string
    {return $this->titre_evnmt;}

    public function setTitreEvnmt(?string $titre_evnmt): self
    {$this->titre_evnmt = $titre_evnmt;
     return $this;}

    public function getSlug() : string
    {return (new Slugify())->slugify($this->titre_evnmt);}

    public function getTxtEvnmt(): ?string
    {return $this->txt_evnmt;}

    public function setTxtEvnmt(?string $txt_evnmt): self
    {$this->txt_evnmt = $txt_evnmt;
     return $this;}

    public function getDateEvnmt(): ?\DateTimeInterface
    {return $this->date_evnmt;}

    public function setDateEvnmt(?\DateTimeInterface $date_evnmt): self
    {$this->date_evnmt = $date_evnmt;
     return $this;}

    public function getHeureEvnmt(): ?\DateTimeInterface
    {return $this->heure_evnmt;}

    public function setHeureEvnmt(?\DateTimeInterface $heure_evnmt): self
    {$this->heure_evnmt = $heure_evnmt;
     return $this;}

    public function getUpdatedAt(): ?\DateTimeInterface
    {return $this->updated_at;}

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {$this->updated_at = $updated_at;
     return $this;}

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {return $this->pictures;}

    public function getPicture(): ?Picture
    {if ($this->pictures->isEmpty()){
        return null;}
        return $this->pictures->first();}

    public function addPicture(Picture $picture): self
    {if (!$this->pictures->contains($picture)) {
        $this->pictures[] = $picture;
        $picture->setEvenements($this);}
     return $this;}

    public function removePicture(Picture $picture): self
    {if ($this->pictures->contains($picture)) {
        $this->pictures->removeElement($picture);
        // set the owning side to null (unless already changed)
        if ($picture->getEvenements() === $this) {
            $picture->setEvenements(null);}}
        return $this;}
    
    /**
     * @return mixed
     */
    public function getPictureFiles()
    {return $this->pictureFiles;}

    /**
     * @param mixed $pictureFiles
     * @return Evenements
     */
    public function setPictureFiles($pictureFiles): self
    {foreach($pictureFiles as $pictureFile)
        {$picture = new Picture();
            $picture->setImageFile($pictureFile);
            $this->addPicture($picture);}
        $this->pictureFiles = $pictureFiles;
     return $this;}


        ///////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////
        /////////////////////////     CONSTRUCTEURS     ///////////////////////////
        ///////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////

        public function __construct()
        {
            $this->pictures = new ArrayCollection();
        }



        ///////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////
        ////////////////////////////     METHODES     /////////////////////////////
        ///////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////

}
