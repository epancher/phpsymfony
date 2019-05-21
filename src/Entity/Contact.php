<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
        ///////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////
        ///////////////////////////     ATTRIBUTS     /////////////////////////////
        ///////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $firstname;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $lastname;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Regex (pattern="/[0-9]{10}/")
     */
    private $phone;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;
    
    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
    private $message;

    /**
     * @var Evenements|null
     */
    private $evenement;


        ///////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////
        //////////////////////////     ACCESSEURS     /////////////////////////////
        ///////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////

    /**
     * @return null|string
     */
    public function getFirstName(): ?string
    {return $this->firstname;}

    /**
     * @param null|string $firstname
     * @return Contact
     */
    public function setFirstName(?string $firstname): Contact
    {$this->firstname = $firstname;
     return $this;}

    /**
     * @return null|string
     */
    public function getLastName(): ?string
    {return $this->lastname;}

    /**
     * @param null|string $lastname
     * @return Contact
     */
    public function setLastName(?string $lastname): Contact
    {$this->lastname = $lastname;
     return $this;}

    /**
     * @return null|string
     */
    public function getPhone(): ?string
    {return $this->phone;}

    /**
     * @param null|string $phone
     * @return Contact
     */
    public function setPhone(?string $phone): Contact
    {$this->phone = $phone;
     return $this;}

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {return $this->email;}

    /**
     * @param null|string $email
     * @return Contact
     */
    public function setEmail(?string $email): Contact
    {$this->email = $email;
     return $this;}

    /**
     * @return null|string
     */
    public function getMessage(): ?string
    {return $this->message;}

    /**
     * @param null|string $message
     * @return Contact
     */
    public function setMessage(?string $message): Contact
    {$this->message = $message;
     return $this;}
     
    /**
     * @return Evenements|string
     */
    public function getEvenement(): ?Evenements
    {return $this->evenement;}

    /**
     * @param Evenements|null $evenement
     * @return Contact
     */
    public function setEvenement(?Evenements $evenement): Contact
    {$this->evenement = $evenement;
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