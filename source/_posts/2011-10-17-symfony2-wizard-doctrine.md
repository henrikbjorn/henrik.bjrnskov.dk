---
layout: post
title: 'Symfony2: How to do a Wizard (multistep form) with Doctrine2'
permalink: symfony2-wizard-doctrine
---

__Update:__ The real code for our Wizard with Working example and tests have been released at [github.com/Peytz/Wizard](http://github.com/peytz/wizard)

It happens that in #symfony-dev there is a question about multistep forms and wizards and how to do them. Obviously there are different answers dependending on the implementation requirements.

The easy ways is doing it with Javascript and just show/hide the correct `fieldset`s when needed. The downside with this approach is that the data is only saved and validated once at the end. So if the user reloads the page the entered information is gone :(.

The other way is to have every Step in the Wizard being a seperate form and validate the data based on what step you are on and save the necesarry fields.

## How i did it for a work project

When tasked with doing a application for calculating reports for a customer at work i sat down and thought about how it would work with the requirement being non javascript. The solution is quite simple.

With inspiration from Fabien Potencier's SensioDistributionBundle i decided to create a Manager (Wizard class) which have Steps.

A Step is an interface with methods to return the correct names, forms and templates.

A Wizard gets injected a ReportInterface object in its controller. a ReportInterface object is the Entity that will be persisted when a step have been completed.

#### `StepInterface`

    <?php

    namespace Acme\DemoBundle\Wizard;

    interface StepInterface
    {
        function getFormType();

        function isVisible(ReportInterface $report);

        function getName();
    }

#### `ReportInterface`

    <?php

    namespace Acme\DemoBundle\Wizard;

    interface ReportInterface
    {
    }

#### `Wizard`

    <?php

    namespace Acme\DemoBundle\Wizard;

    class Wizard implements \IteratorAggregate
    {
        protected $report;

        protected $steps = array();

        public function __construct(ReportInterface $report)
        {
            $this->report = $report;
        }

        public function add(StepInterface $step)
        {
            $this->steps[$step->getName()] = $step;
        }

        public function getReport()
        {
            return $this->report;
        }

        public function getTemplatePathByStep(StepInterface $step)
        {
            return sprintf('AcmeDemoBundle:Wizard/steps:%s.twig.html', $step->getName());
        }

        public function get($step)
        {
            // Obviously do a check on the index here.
            return $this->steps[$step];
        }

        public function all()
        {
            return $this->steps;
        }

        public function getIterator()
        {
            return new \ArrayIterator($this->all());
        }
    }

## Using it in a Symfony context.

As it should be quite clear for the average developer, it is needed to implement a Wizard, Steps and a Report for every Wizard you need.

    <?php

    namespace Acme\DemoBundle\Controller;

    class DemoController extends Controller
    {
        protected function getWizard()
        {
            // Should get the ReportInterface $report from Doctrine
            return new CustomWizard(new Report());
        }

        public function wizardAction($step)
        {
            $wizard = $this->getWizard();
            $report = $wizard->getReport();
            $step = $wizard->getStep($step);

            if (!$step || !$step->isVisible($report)) {
                throw $this->createNotFoundException('Step Not Found or Not Visible');
            }

            $form = $this->createForm($step->getFormType(), $report, array(
                'validation_groups' => array($step->getName()),
            ));

            // Bind the form if the request is valid
            if ($form->isValid()) {
                // Persist with Doctrine
            }

            return $this->render($wizard->getTemplatePath($step), compact('form', 'wizard', 'report', 'step'));
        }
    }

The controller example is simple and incomplete but should give you a general overview of how it could be done, and how i have done it with my project.
