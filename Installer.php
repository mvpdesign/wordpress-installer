<?php

use MVPDesign\WordpressInstaller\Magic;
use Composer\Script\Event;

class Installer
{
    public static function run(Event $event)
    {
        Magic::happens($event);
    }
}
