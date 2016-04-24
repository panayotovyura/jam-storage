<?php

namespace JamStorageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JamJar
 *
 * @ORM\Table(name="jam_jars")
 * @ORM\Entity
 */
class JamJar
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="JamType", cascade={"persist"})
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="JamYear", cascade={"persist"})
     */
    private $year;

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
     * Set comment
     *
     * @param string $comment
     * @return JamJar
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return JamType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param JamType $type
     */
    public function setType(JamType $type)
    {
        $this->type = $type;
    }

    /**
     * @return JamYear
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param JamYear $year
     */
    public function setYear(JamYear $year)
    {
        $this->year = $year;
    }
}
