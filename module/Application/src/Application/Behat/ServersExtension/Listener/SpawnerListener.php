<?php

namespace Application\Behat\ServersExtension\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Process\ProcessBuilder;

class SpawnerListener implements EventSubscriberInterface
{
    private $commands = [
        [
            "php",
            "-S",
            "localhost:8642",
            "-t",
            "./public",
            "./public/index_test.php",
        ],
    ];

    /** @var array|\Symfony\Component\Process\Process[] */
    private $processes = [];

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        return [
            'beforeSuite' => ['startServers', -20],
            'afterSuite' => ['stopServers', -20],
        ];
    }

    /**
     * Starts (spawn) extension servers
     *
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     * @throws \Symfony\Component\Process\Exception\LogicException
     */
    public function startServers()
    {
        $workingDirectory = realpath(__DIR__ . "/../../../../../../../");
        $execPrefix = defined('PHP_WINDOWS_VERSION_BUILD') ? '' : 'exec'; // exec does not work on Windows

        foreach ($this->commands as $arguments) {
            $builder = new ProcessBuilder();
            $builder->setWorkingDirectory($workingDirectory);

            if ($execPrefix) {
                $builder->add($execPrefix);
            }

            foreach ($arguments as $arg) {
                $builder->add($arg);
            }

            $process = $builder->getProcess();
            $process->start();
            $this->processes[] = $process;
        }
    }

    public function stopServers()
    {
        foreach ($this->processes as $process) {
            $process->stop();
        }

        $this->processes = [];
    }
}
