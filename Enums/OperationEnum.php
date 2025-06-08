<?php

namespace App\Enums;

enum OperationEnum: string {

case GENERATIVE = 'generative';
case RESTORE = 'restore';
case REMOVE = 'remove';
case RECOLOR = 'recolor';

public function credits(): int {

    return match ($this) {
        self::GENERATIVE => 3,
        self::RESTORE => 3,
        self::REMOVE => 2,
        self::RECOLOR => 1,
    };
}

public static function listOfCredits(): array {
    return [
        self::GENERATIVE->value => self::GENERATIVE->credits(),
        self::RESTORE->value => self::RESTORE->credits(),
        self::REMOVE->value => self::REMOVE->credits(),
        self::RECOLOR->value => self::RECOLOR->credits(),
    ];

}

}