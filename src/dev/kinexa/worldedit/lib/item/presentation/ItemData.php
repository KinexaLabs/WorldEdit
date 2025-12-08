<?php

declare(strict_types=1);

namespace dev\kinexa\worldedit\lib\item\presentation;

final class ItemData {
    /** @var int */
    private $itemId;
    /** @var int */
    private $itemMeta;
    /** @var int */
    private $itemCount;
    /** @var string */
    private $itemName;
    /** @var string */
    private $customItemId;

    public function __construct(
        int $itemId,
        int $itemMeta,
        int $itemCount,
        string $itemName,
        string $customItemId
    ) {
        $this->itemId = $itemId;
        $this->itemMeta = $itemMeta;
        $this->itemCount = $itemCount;
        $this->itemName = $itemName;
        $this->customItemId = $customItemId;
    }

    public function getItemId(): int {
        return $this->itemId;
    }

    public function getItemMeta(): int {
        return $this->itemMeta;
    }

    public function getItemCount(): int {
        return $this->itemCount;
    }

    public function getItemName(): string {
        return $this->itemName;
    }

    public function getCustomItemId(): string {
        return $this->customItemId;
    }
}
