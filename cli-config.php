<?php

use App\Boot;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

Boot::init();
return ConsoleRunner::createHelperSet(Boot::$entityManager);
