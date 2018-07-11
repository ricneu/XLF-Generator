<?php

// src/Entity/Task.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

class Task
{


    /**
     * @ORM\Column(type="string")
     *
     * @Assert\File(mimeTypes={ "text/xml" })
     */
    private $xlfFile;

    protected $sourceLanguage;

    protected $targetLanguage;

    protected $productName;

    /*
    * @ORM\ManyToMany(targetEntity="XliffElement", cascade={"persist"})
    */
    protected $xliffElements;


    public function __construct()
    {
    $this->xliffElements = new ArrayCollection();
    }

    public function getXlfFile()
    {
        return $this->xlfFile;
    }

    public function setXlfFile($xlfFile)
    {
        $this->xlfFile = $xlfFile;

        return $this;
    }

    public function getSourceLanguage()
    {
        return $this->sourceLanguage;
    }

    public function setSourceLanguage($sourceLanguage)
    {
        $this->sourceLanguage = $sourceLanguage;
    }

    public function getTargetLanguage()
    {
        return $this->targetLanguage;
    }

    public function setTargetLanguage($targetLanguage)
    {
        $this->targetLanguage = $targetLanguage;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    public function getXliffElements()
    {
        return $this->xliffElements;
    }


    public function addXliffElement(XliffElement $xliffElement)
    {
        $this->xliffElements->add($xliffElement);
    }

    public function removeXliffElement(XliffElement $xliffElement)
    {
        $this->xliffElements->removeElement($xliffElement);
    }
}