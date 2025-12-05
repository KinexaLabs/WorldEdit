<?php

declare(strict_types=1);

namespace dev\kinexa\worldedit\core\selection\domain\repository;

use dev\kinexa\worldedit\core\selection\domain\entity\Selection;

interface SelectionRepository {
    public function save(string $playerName, Selection $selection);

    /**
     * @return Selection|null
     */
    public function findByPlayerName(string $playerName);

    public function remove(string $playerName);
}
