<?php

$env = file_get_contents(ROOT . '/.env');
$lines = explode("\n", $env);

foreach ($lines as $line) {
    $line = trim($line);
    if (empty($line)) {
        continue;
    }

    putenv($line);
}

foreach (glob(ROOT . '/Shared/*Interface.php') as $filename) {
    require_once($filename);
}

foreach (glob(ROOT . '/Shared/Abstract*.php') as $filename) {
    require_once($filename);
}

foreach (glob(ROOT . '/Contracts/*.php') as $filename) {
    require_once($filename);
}

foreach (glob(ROOT . '/Concerns/*.php') as $filename) {
    require_once($filename);
}

foreach (glob(ROOT . '/Repositories/*.php') as $filename) {
    require_once($filename);
}

foreach (glob(ROOT . '/Models/*.php') as $filename) {
    require_once($filename);
}

foreach (glob(ROOT . '/Services/*.php') as $filename) {
    require_once($filename);
}

foreach (glob(ROOT . '/Infrastructure/*.php') as $filename) {
    require_once($filename);
}


