<?php
/**
 * Created by PhpStorm.
 * User: abellaej
 * Date: 8/20/2018
 * Time: 3:50 PM
 */

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

abstract class BaseFixture extends Fixture
{
    /** @var \Doctrine\Common\Persistence\ObjectManager **/
    private $manager;

    /** @var Generator */
    protected $faker;

    abstract protected function loadData(ObjectManager $em);

    public function load(ObjectManager $manager) {
        $this->manager = $manager;

        $this->faker = Factory::create();

        $this->loadData($manager);
    }

    protected function createMany(string $className, int $count, callable $factory)
    {
        for ($i = 0; $i < $count; $i++) {
            $entity = new $className();
            $factory($entity, $i);

            $this->manager->persist($entity);

            // store for usage later as App\Entity\ClassName_#COUNT#
            $this->addReference($className . '_' . $i, $entity);
        }
    }



}