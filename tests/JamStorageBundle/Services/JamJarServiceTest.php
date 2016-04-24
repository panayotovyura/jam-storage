<?php
namespace Test\JamStorageBundle\Services;

use JamStorageBundle\Services\JamJarService;
use JamStorageBundle\Entity\JamJar;
use JamStorageBundle\Services\CloneService;
use Doctrine\ORM\EntityManager;

class JamServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $count
     * @param $expectedCount
     *
     * @dataProvider cloneJamsProvider
     */
    public function testCloneJams($count, $expectedCount)
    {
        $jam = $this->getMock(JamJar::class);

        $cloneService = $this->getMock(CloneService::class);
        $cloneService->expects($this->exactly($expectedCount))
            ->method('cloneObject')
            ->with($jam);

        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $em->expects($this->exactly($expectedCount))
            ->method('persist');
        $em->expects($this->once())
            ->method('flush');

        $jamService = new JamJarService($em, $cloneService);
        $jamService->cloneJams($jam, $count);
    }

    public function cloneJamsProvider()
    {
        return array(
            array(1, 1),
            array(2, 2),
            array(10, 10),
        );
    }
}
