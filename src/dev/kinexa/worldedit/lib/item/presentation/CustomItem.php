<?php

declare(strict_types=1);

namespace dev\kinexa\worldedit\lib\item\presentation;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\player\PlayerInteractEvent;

interface CustomItem {
    public function onPlayerInteract(PlayerInteractEvent $event);

    public function onBlockBreak(BlockBreakEvent $event);
}
