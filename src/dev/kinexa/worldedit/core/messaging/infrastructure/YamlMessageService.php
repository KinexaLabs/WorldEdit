<?php

declare(strict_types=1);

namespace dev\kinexa\worldedit\core\messaging\infrastructure;

use dev\kinexa\worldedit\core\messaging\application\MessageService;

final class YamlMessageService implements MessageService {

    /** @var array<string, string> */
    private $messages;
    /** @var string */
    private $prefix;

    public function __construct(array $messages, string $prefix) {
        $this->messages = $messages;
        $this->prefix = $prefix;
    }

    public function get(string $key, array $params = []): string {
        if (!isset($this->messages[$key])) {
            return "Mensaje no configurado {$key}";
        }

        $message = $this->messages[$key];

        if (!empty($params)) {
            $message = $this->replacePlaceholders($message, $params);
        }

        if ($this->prefix !== "") {
            $message = $this->prefix . " " . $message;
        }

        return $message;
    }

    private function replacePlaceholders(string $message, array $params): string {
        $search = [];
        $replace = [];

        foreach ($params as $key => $value) {
            $search[] = '{' . $key . '}';
            $replace[] = (string) $value;
        }

        return str_replace($search, $replace, $message);
    }
}
