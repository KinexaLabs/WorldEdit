<?php

declare(strict_types=1);

namespace dev\kinexa\worldedit\core\selection\domain\vo;

final class Position {
    /** @var int */
    private $x;
    /** @var int */
    private $y;
    /** @var int */
    private $z;

    public function __construct(int $x, int $y, int $z) {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public function getX() {
        return $this->x;
    }

    public function getY() {
        return $this->y;
    }

    public function getZ() {
        return $this->z;
    }
}
