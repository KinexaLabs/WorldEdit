<?php

declare(strict_types=1);

namespace dev\kinexa\worldedit\lib\item\presentation;

use InvalidArgumentException;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\StringTag;

final class ItemRegistry {
    const NBT_KEY_DISPLAY = "display";
    const NBT_KEY_NAME = "Name";
    const NBT_KEY_CUSTOM_ID = "CustomId";

    /** @var array<string, ItemData> */
    private static $itemsData = [];
    /** @var array<string, CustomItem> */
    private static $customItems = [];

    public static function register(CustomItem $customItem, ItemData $itemData) {
        self::$itemsData[$itemData->getCustomItemId()] = $itemData;
        self::$customItems[$itemData->getCustomItemId()] = $customItem;
    }

    private static function getItemData(string $itemId): ItemData {
        if (!isset(self::$itemsData[$itemId])) {
            throw new InvalidArgumentException("No item data with id: {$itemId}");
        }

        return self::$itemsData[$itemId];
    }

    public static function createRealItem(string $itemId): Item {
        $itemData = self::getItemData($itemId);

        $item = Item::get(
            $itemData->getItemId(),
            $itemData->getItemMeta(),
            $itemData->getItemCount()
        );
        $item->setCompoundTag(new CompoundTag("", [
            self::NBT_KEY_DISPLAY => new CompoundTag(self::NBT_KEY_DISPLAY, [
                self::NBT_KEY_NAME => new StringTag(
                    self::NBT_KEY_NAME,
                    $itemData->getItemName()
                )
            ]),
            self::NBT_KEY_CUSTOM_ID => new StringTag(
                self::NBT_KEY_CUSTOM_ID,
                $itemData->getCustomItemId()
            )
        ]));

        return $item;
    }

    public static function processInteract(PlayerInteractEvent $event, string $customItemId) {
        $customItem = self::$customItems[$customItemId] ?? null;
        if ($customItem === null) {
            throw new InvalidArgumentException("No item with id: {$customItemId}");
        }

        $customItem->onPlayerInteract($event);
    }

    public static function processBlockBreak(BlockBreakEvent $event, string $customItemId) {
        $customItem = self::$customItems[$customItemId] ?? null;
        if ($customItem === null) {
            throw new InvalidArgumentException("No item with id: {$customItemId}");
        }

        $customItem->onBlockBreak($event);
    }
}
