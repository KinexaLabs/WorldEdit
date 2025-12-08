<?php

declare(strict_types=1);

namespace dev\kinexa\worldedit\lib\item\presentation\listener;

use dev\kinexa\worldedit\lib\item\presentation\ItemRegistry;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;

final class ItemBlockBreakListener implements Listener {

    /**
     * @priority HIGHEST
     */
    public function onBlockBreak(BlockBreakEvent $event) {
        $item = $event->getItem();
        if (!$item->hasCompoundTag()) {
            return;
        }

        if (!$item->getNamedTag()->offsetExists(ItemRegistry::NBT_KEY_CUSTOM_ID)) {
            return;
        }

        $customItemId = $item->getNamedTag()->offsetGet(ItemRegistry::NBT_KEY_CUSTOM_ID);
        ItemRegistry::processBlockBreak($event, $customItemId);
    }
}
