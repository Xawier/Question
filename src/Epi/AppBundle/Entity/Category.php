<?php
/**
 * Category
 *
 * PHP version 5.3.3
 *
 * @category Entity
 * @package  Epi\AppBundle
 * @author   Mateusz Haber <mateusz.haber@uj.edu.pl>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://wierzba.wzks.uj.edu.pl/~11_haber/Question/
 */
namespace Epi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table            (name="CATEGORY", uniqueConstraints={
 * @ORM\UniqueConstraint (name="ID_UNIQUE", columns={"ID"})})
 * @ORM\Entity           (repositoryClass="Epi\AppBundle\Entity\CategoryRepository")
 *
 * @category Entity
 * @package  Epi\AppBundle\Entity
 * @author   Mateusz Haber <mateusz.haber@uj.edu.pl>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://wierzba.wzks.uj.edu.pl/~11_haber/Question/
 */
class Category
{
    /**
     * Value
     *
     * @var string
     *
     * @ORM\Column(name="VALUE", type="string", length=45, nullable=false)
     */
    private $value;

    /**
     * Id
     *
     * @var integer
     *
     * @ORM\Column         (name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue (strategy="IDENTITY")
     */
    private $id;



    /**
     * Set value
     *
     * @param string $value value
     *
     * @return Category
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
