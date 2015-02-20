<?php

namespace Epi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Question
 *
 * @ORM\Table(name="QUESTION", uniqueConstraints={@ORM\UniqueConstraint(name="ID_UNIQUE", columns={"ID"})}, indexes={@ORM\Index(name="fk_QUESTION_USER1_idx", columns={"USER_ID"}), @ORM\Index(name="fk_QUESTION_ANSWER1_idx", columns={"BEST_ANSWER"}), @ORM\Index(name="fk_QUESTION_CATEGORY1_idx", columns={"CATEGORY_ID"})})
 * @ORM\Entity(repositoryClass="Epi\AppBundle\Entity\QuestionRepository")
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
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACTIVE", type="integer", nullable=false)
     */
    private $active;

    public function __construct()
    {
        $this->active = 1;
    }


    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function getAbsolutePath()
    {
        return null === $this->cover
            ? null
            : $this->getUploadRootDir().'/'.$this->cover;
    }

    public function getWebPath()
    {
        return null === $this->cover
            ? null
            : $this->getUploadDir().'/'.$this->cover;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/covers';
    }

    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->getFile()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->cover = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

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
        return $this->getWebPath();
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

    /**
     * Set active
     *
     * @param integer $active
     * @return Answer
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer 
     */
    public function getActive()
    {
        return $this->active;
    }
}
