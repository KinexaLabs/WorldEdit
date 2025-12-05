<?php

declare(strict_types=1);

namespace dev\kinexa\worldedit\core\messaging\infrastructure;

use dev\kinexa\worldedit\core\messaging\application\MessageService;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

final class MessageServiceFactory {

    public static function fromConfig(Config $config): MessageService {
        $all = $config->getAll();

        $prefix = '';
        if (isset($all['prefix']) && is_string($all['prefix'])) {
            $prefix = $all['prefix'];
            unset($all['prefix']);
        }

        $messages = self::convertMessages($all);

        return new YamlMessageService($messages, $prefix);
    }

    private static function convertMessages(array $allMessages): array {
        $messages = [];

        foreach ($allMessages as $key => $value) {
            if (is_array($value)) {
                $messages[$key] = implode(TextFormat::RESET . "\n", $value);
                continue;
            }

            $messages[$key] = $value;
        }

        return $messages;
    }
}
