<?php

namespace Application\Behat;

use Behat\MinkExtension\Context\MinkContext;
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
     * Initialize Zend Framework kernel
     *
     * @BeforeSuite
     */
    public static function initZendFramework()
    {
        if (null == self::$app) {
            $path = __DIR__ . "/../../../../../config/test_application.config.php";
            self::$app = Application::init(require $path);
        }
    }
}
