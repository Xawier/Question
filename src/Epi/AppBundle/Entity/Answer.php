<?php

namespace Epi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Answer
 *
 * @ORM\Table(name="ANSWER", uniqueConstraints={@ORM\UniqueConstraint(name="ID_UNIQUE", columns={"ID"})}, indexes={@ORM\Index(name="fk_ANSWER_USER1_idx", columns={"USER_ID"}), @ORM\Index(name="fk_ANSWER_QUESTION1_idx", columns={"QUESTION_ID"})})
 * @ORM\Entity(repositoryClass="Epi\AppBundle\Entity\AnswerRepository")
 */
class Answer
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
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Epi\AppBundle\Entity\Question
     *
     * @ORM\ManyToOne(targetEntity="Epi\AppBundle\Entity\Question")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="QUESTION_ID", referencedColumnName="ID")
     * })
     */
    private $question;

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
     * @return Answer
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
     * @return Answer
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set question
     *
     * @param \Epi\AppBundle\Entity\Question $question
     * @return Answer
     */
    public function setQuestion(\Epi\AppBundle\Entity\Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \Epi\AppBundle\Entity\Question 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set user
     *
     * @param \Epi\AppBundle\Entity\User $user
     * @return Answer
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
