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
     * @var CloneService
     */
    private $cloneService;

    /**
     * JamJarService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager, CloneService $cloneService)
    {
        $this->entityManager = $entityManager;
        $this->cloneService = $cloneService;
    }

    /**
     * Clone $jamJar object $amount times
     *
     * @param JamJar $jamJar
     * @param int $amount
     */
    public function cloneJams(JamJar $jamJar, int $amount)
    {
        while ($amount--) {
            $this->entityManager->persist(
                $this->cloneService->cloneObject($jamJar)
            );
        }

        $this->entityManager->flush();
    }
}
