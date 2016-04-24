<?php

namespace JamStorageBundle\Services;

use Doctrine\ORM\EntityManager;
use JamStorageBundle\Entity\JamJar;

class JamJarService
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * JamJarService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Clone $jamJar object $amount times
     *
     * @param JamJar $jamJar
     * @param $amount
     */
    public function cloneJams(JamJar $jamJar, $amount)
    {
        if (!is_int($amount) || $amount < 1) {
            return;
        }

        while ($amount--) {
            // todo: it's better to make additional service for cloning. it will be easier to test this class
            $cloneJamJar = clone $jamJar;
            $this->entityManager->persist($cloneJamJar);
        }

        $this->entityManager->flush();
    }
}
