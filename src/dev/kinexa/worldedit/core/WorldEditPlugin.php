<?php

declare(strict_types=1);

namespace dev\kinexa\worldedit\core;

use dev\kinexa\worldedit\core\messaging\infrastructure\MessageServiceFactory;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

final class WorldEditPlugin extends PluginBase {

    public function onLoad() {
        $isInDev = strpos("-dev", $this->getDescription()->getVersion()) !== false;
        $this->saveResource("messages.yml", $isInDev);
    }

    public function onEnable() {
        $messageService = MessageServiceFactory::fromConfig(
            new Config($this->getDataFolder() . "messages.yml")
        );
    }
}
