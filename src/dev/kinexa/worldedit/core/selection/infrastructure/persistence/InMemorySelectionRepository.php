<?php

declare(strict_types=1);

namespace dev\kinexa\worldedit\core\selection\infrastructure\persistence;

use dev\kinexa\worldedit\core\selection\domain\entity\Selection;
use dev\kinexa\worldedit\core\selection\domain\repository\SelectionRepository;

final class InMemorySelectionRepository implements SelectionRepository {
    /** @var array<string, Selection> */
    private $selections = [];

    public function save(string $playerName, Selection $selection) {
        $this->selections[$playerName] = $selection;
    }

    public function findByPlayerName(string $playerName) {
        return $this->selections[$playerName] ?? null;
    }

    public function remove(string $playerName) {
        unset($this->selections[$playerName]);
    }
}
