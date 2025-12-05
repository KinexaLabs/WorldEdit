<?php

declare(strict_types=1);

namespace dev\kinexa\worldedit\core\messaging\application;

interface MessageService {

    public function get(string $key, array $params = []): string;
}
