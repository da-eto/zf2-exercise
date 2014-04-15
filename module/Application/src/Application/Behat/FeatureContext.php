<?php

namespace Application\Behat;

use Application\Entity\Department;
use Application\Entity\Vacancy;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Zend\Mvc\Application;

/**
 * Class FeatureContext
 * Basic BDD context for vacancies application
 *
 * @package Application\Behat
 */
class FeatureContext extends MinkContext
{
    /**
     * @var Application Zend application
     */
    private static $app;

    /**
     * Initialize Zend Framework kernel and clear testing environment
     *
     * @BeforeSuite
     */
    public static function initZendFramework()
    {
        if (null == self::$app) {
            $path = __DIR__ . "/../../../../../config/test_application.config.php";
            self::$app = Application::init(require $path);
        }

        $em = self::getEntityManager();
        $metadatas = $em->getMetadataFactory()->getAllMetadata();
        $tool = new SchemaTool($em);
        $tool->dropSchema($metadatas);
        $tool->createSchema($metadatas);
    }

    /**
     * Clear data before each scenario
     *
     * @BeforeScenario
     */
    public function purgeData()
    {
        $em = self::getEntityManager();
        $purger = new ORMPurger($em);
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_DELETE);
        $purger->purge();
    }

    /**
     * @return EntityManager
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    private static function getEntityManager()
    {
        return self::$app->getServiceManager()->get('Doctrine\ORM\EntityManager');
    }

    /**
     * @Given /^there are departments on site:$/
     */
    public function thereAreDepartmentsOnSite(TableNode $table)
    {
        $em = self::getEntityManager();

        foreach ($table->getHash() as $row) {
            $department = new Department();
            $department->setName($row['name']);

            $em->persist($department);
        }

        $em->flush();
        $em->clear();
    }

    /**
     * @Given /^there are vacancies on site:$/
     */
    public function thereAreVacanciesOnSite(TableNode $table)
    {
        $em = self::getEntityManager();
        $departmentRepo = $em->getRepository('Application\Entity\Department');

        foreach ($table->getHash() as $row) {
            $vacancy = new Vacancy();
            $vacancy->setName($row['name']);

            if (!empty($row['description'])) {
                $vacancy->setDescription($row['description']);
            }

            $department = $departmentRepo->findOneBy(['name' => $row['department']]);
            $vacancy->setDepartment($department);

            $em->persist($vacancy);
        }

        $em->flush();
        $em->clear();
    }
}
