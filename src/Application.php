<?php

namespace FaDoe\StandaloneWebserver;

use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Bundle\WebServerBundle\Command;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class Application
 *
 * @package FaDoe\StandaloneWebserver
 */
class Application extends ConsoleApplication
{
    /**
     * Application constructor.
     *
     * @param string $docRoot
     * @param string $env
     */
    public function __construct(string $docRoot, string $env)
    {
        parent::__construct('Standalone local webserver');
        $inputDefinition = $this->getDefinition();
        $inputDefinition->addOption(
            new InputOption('--env', '-e', InputOption::VALUE_REQUIRED, 'The Environment name.', $env)
        );

        $this->setWebserverCommands($docRoot, $env);
    }

    /**
     * @param string $docRoot
     * @param string $environment
     */
    private function setWebserverCommands(string $docRoot, string $environment)
    {
        $this->add(new Command\ServerLogCommand());
        $this->add(new Command\ServerRunCommand($docRoot, $environment));
        $this->add(new Command\ServerStartCommand($docRoot, $environment));
        $this->add(new Command\ServerStatusCommand());
        $this->add(new Command\ServerStopCommand());
    }
}
