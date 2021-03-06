<?php

namespace spec\Behat\SpawnerExtension\Listener;

use Behat\Testwork\EventDispatcher\Event\ExerciseCompleted;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SuiteListenerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Behat\SpawnerExtension\Listener\SuiteListener');
    }

    function it_is_event_subscriber()
    {
        $this->shouldHaveType('Symfony\Component\EventDispatcher\EventSubscriberInterface');
    }

    function it_subscribes_to_beforeSuite_and_afterSuite_events()
    {
        $this::getSubscribedEvents()->shouldHaveKey(ExerciseCompleted::BEFORE);
        $this::getSubscribedEvents()->shouldHaveKey(ExerciseCompleted::AFTER);
    }

    function it_assign_commands_on_construct()
    {
        $commands = array(array("vim", "test.txt"), array("hi"));

        $this->beConstructedWith($commands, null, "", "");
        $this->getCommands()->shouldBe($commands);
    }

    function it_assign_working_directory_on_construct()
    {
        $workingDirectory = "./bin";

        $this->beConstructedWith(array(), $workingDirectory, "", "");
        $this->getWorkingDirectory()->shouldBe($workingDirectory);
    }

    function it_assign_sleep_time_on_construct()
    {
        $sleep = 10;

        $this->beConstructedWith(array(), null, "", "", $sleep);
        $this->getSleep()->shouldBe($sleep);
    }

    function it_assign_prefixes_on_construct()
    {
        $winPrefix = "win";
        $nixPrefix = "nix";

        $this->beConstructedWith(array(), null, $nixPrefix, $winPrefix);
        $this->getNixPrefix()->shouldBe("nix");
        $this->getwinPrefix()->shouldBe("win");
    }

    function it_has_void_function_spawnProcesses()
    {
        $this->spawnProcesses()->shouldBe(null);
    }

    function it_has_void_function_stopProcesses()
    {
        $this->stopProcesses()->shouldBe(null);
    }

    function it_should_store_processes_between_spawn_and_stop_and_clear_after()
    {
        $commands = array(array("php", "-v"), array("php", "-v"));

        $this->beConstructedWith($commands, null);
        $this->getProcesses()->shouldHaveCount(0);

        $this->spawnProcesses();
        $this->getProcesses()->shouldHaveCount(count($commands));

        $this->stopProcesses();
        $this->getProcesses()->shouldHaveCount(0);
    }

    public function getMatchers()
    {
        return array(
            'haveKey' => function ($subject, $key) {
                return array_key_exists($key, $subject);
            },
        );
    }
}
