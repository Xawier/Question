<?php

namespace Epi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="QUESTION", uniqueConstraints={@ORM\UniqueConstraint(name="ID_UNIQUE", columns={"ID"})}, indexes={@ORM\Index(name="fk_QUESTION_USER1_idx", columns={"USER_ID"}), @ORM\Index(name="fk_QUESTION_ANSWER1_idx", columns={"BEST_ANSWER"}), @ORM\Index(name="fk_QUESTION_CATEGORY1_idx", columns={"CATEGORY_ID"})})
 * @ORM\Entity
 */
class Question
{
    /**
     * @var string
     *
     * @ORM\Column(name="VALUE", type="text", nullable=false)
     */
    private $value;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="COVER", type="string", length=45, nullable=true)
     */
    private $cover;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Epi\AppBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="Epi\AppBundle\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CATEGORY_ID", referencedColumnName="ID")
     * })
     */
    private $category;

    /**
     * @var \Epi\AppBundle\Entity\Answer
     *
     * @ORM\ManyToOne(targetEntity="Epi\AppBundle\Entity\Answer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="BEST_ANSWER", referencedColumnName="ID")
     * })
     */
    private $bestAnswer;

    /**
     * @var \Epi\AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Epi\AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="USER_ID", referencedColumnName="ID")
     * })
     */
    private $user;



    /**
     * Set value
     *
     * @param string $value
     * @return Question
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Question
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set cover
     *
     * @param string $cover
     * @return Question
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover
     *
     * @return string 
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set category
     *
     * @param \Epi\AppBundle\Entity\Category $category
     * @return Question
     */
    public function setCategory(\Epi\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Epi\AppBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set bestAnswer
     *
     * @param \Epi\AppBundle\Entity\Answer $bestAnswer
     * @return Question
     */
    public function setBestAnswer(\Epi\AppBundle\Entity\Answer $bestAnswer = null)
    {
        $this->bestAnswer = $bestAnswer;

        return $this;
    }

    /**
     * Get bestAnswer
     *
     * @return \Epi\AppBundle\Entity\Answer 
     */
    public function getBestAnswer()
    {
        return $this->bestAnswer;
    }

    /**
     * Set user
     *
     * @param \Epi\AppBundle\Entity\User $user
     * @return Question
     */
    public function setUser(\Epi\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Epi\AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
