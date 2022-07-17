<?php

namespace markhuot\craftpest\console;

use craft\console\Controller;
use Symfony\Component\Process\Process;
use Craft;

class TestController extends Controller {

    /**
     * Run the Pest tests
     */
    function actionIndex() {
        $this->runInit();
        $this->runTests();
        return 1;
    }

    /**
     * Install Pest
     */
    function actionInit() {
        $this->runInit();
        return 1;
    }

    /**
     * Do the install
     */
    protected function runInit() {
        if (!file_exists(CRAFT_BASE_PATH . '/phpunit.xml')) {
            $process = new Process(['./vendor/bin/pest', '--init']);
            $process->setTty(false);
            $process->start();

            foreach ($process as $type => $data) {
                if ($type === $process::OUT) {
                    echo $data;
                } else {
                    echo $data;
                }
            }

            copy(__DIR__ . DIRECTORY_SEPARATOR . '../../stubs/init/ExampleTest.php', Craft::getAlias('@root') . '/tests/ExampleTest.php');
            copy(__DIR__ . DIRECTORY_SEPARATOR . '../../stubs/init/Pest.php', Craft::getAlias('@root') . '/tests/Pest.php');
        }
        
    }

    /**
     * Run the tests
     */
    protected function runTests() {
        $process = new Process(['./vendor/bin/pest']);
        $process->setTty(false);
        $process->setTimeout(null);
        $process->start();

        foreach ($process as $type => $data) {
            if ($type === $process::OUT) {
                echo $data;
            } else {
                echo $data;
            }
        }
    }


}
