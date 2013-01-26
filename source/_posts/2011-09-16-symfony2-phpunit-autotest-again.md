---
layout: post
title: 'Symfony2: PHPUnit autotesting application (again)'
permalink: symfony2-phpunit-autotest-again/
---

Last month i [wrote a post][post] with a snippet of Ruby code that would auto run a test for a given `.php` file.

For fun i tried to rewrite it using a [experimental Symfony branch from everzet][branch] which have a `ResourceWatcher` component.
Also it shows how much difference there is in `php` and `ruby` code.

Here is the code.

    <?php

    namespace FooBar\FooBundle\Command;

    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Output\OutputInterface;
    use FooBar\FooBundle\Test\Runner;

    class AutotestCommand extends \Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand
    {
        protected function configure()
        {
            $this
                ->setName('foobar:autotest')
                ->setDescription('Autorun your PHPUnit tests when a .php file is modified.')
            ;
        }

        protected function execute(InputInterface $input, OutputInterface $output)
        {
            $runner = new Runner($this->getContainer()->getParameter('kernel.root_dir') . '/../src');
            $runner->run($output);
        }
    }

    <?php

    namespace FooBar\FooBundle\Test;

    use Symfony\Component\ResourceWatcher\ResourceWatcher;
    use Symfony\Component\ResourceWatcher\Event\Event;
    use Symfony\Component\Config\Resource\DirectoryResource;
    use Symfony\Component\Process\Process;
    use Symfony\Component\Console\Output\OutputInterface;

    /**
     * Watches resources and runs phpunit cli when a php file changes.
     *
     * @package FooBarFooBundle
     */
    class Runner
    {
        /**
         * @var string
         */
        protected $dir;

        public function __construct($dir)
        {
            $this->dir = realpath($dir);
        }

        public function run(OutputInterface $output)
        {
            $watcher = new ResourceWatcher();
            $watcher->track(new DirectoryResource(realpath($this->dir)), function ($event) use ($output) {
                $fileName = (string) $event->getResource();

                if (preg_match('/^(.*Bundle\/)(.*)(\.php)$/', $fileName, $matches)) {
                    if ('Test' !== substr($matches[2], -4)) {
                        $fileName = $matches[1] . 'Tests/' . $matches[2] . 'Test' . $matches[3];
                    }

                    $process = new Process('phpunit ' . escapeshellarg($fileName), $this->dir . '/../');
                    $process->run(function ($type, $data) use ($output) {
                        $output->writeln($data);
                    });
                }
            });

            $watcher->start();
        }
    }

[branch]: https://github.com/everzet/symfony/tree/resource-watcher-component
[post]: http://henrik.bjrnskov.dk/symfony2-phpunit-autotest/
