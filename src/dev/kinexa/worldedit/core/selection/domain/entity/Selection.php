<?php

declare(strict_types=1);

namespace dev\kinexa\worldedit\core\selection\domain\entity;

use dev\kinexa\worldedit\core\selection\domain\vo\Position;

final class Selection {
    /** @var Position */
    private $firstPosition;
    /** @var Position */
    private $secondPosition;

    public function __construct(Position $firstPosition, Position $secondPosition) {
        $this->firstPosition = $firstPosition;
        $this->secondPosition = $secondPosition;
    }

    public function forEachBlock(callable $callback) {
        $minX = min($this->firstPosition->getX(), $this->secondPosition->getX());
        $maxX = max($this->firstPosition->getX(), $this->secondPosition->getX());

        $minY = min($this->firstPosition->getY(), $this->secondPosition->getY());
        $maxY = max($this->firstPosition->getY(), $this->secondPosition->getY());

        $minZ = min($this->firstPosition->getZ(), $this->secondPosition->getZ());
        $maxZ = max($this->firstPosition->getZ(), $this->secondPosition->getZ());

        for ($x = $minX; $x <= $maxX; $x++) {
            for ($y = $minY; $y <= $maxY; $y++) {
                for ($z = $minZ; $z <= $maxZ; $z++) {
                    $callback(new Position($x, $y, $z));
                }
            }
        }
    }
}
