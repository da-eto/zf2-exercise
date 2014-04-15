<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Department
 * Entity for store department objects
 *
 * @package Application\Entity
 *
 * @ORM\Entity
 */
class Department
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var Vacancy[]|Collection
     * @ORM\OneToMany(targetEntity="Vacancy", mappedBy="department", orphanRemoval=true)
     */
    private $vacancies;

    /**
     * Creates Vacancy entity
     */
    public function __construct()
    {
        $this->vacancies = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Vacancy[]|Collection
     */
    public function getVacancies()
    {
        return $this->vacancies;
    }

    /**
     * @param Vacancy $vacancy
     */
    public function addVacancy(Vacancy $vacancy)
    {
        $vacancy->setDepartment($this);
        $this->vacancies[] = $vacancy;
    }

    public function removeVacancy(Vacancy $vacancy)
    {
        $vacancy->setDepartment(null);
        $this->vacancies->removeElement($vacancy);
    }
}
