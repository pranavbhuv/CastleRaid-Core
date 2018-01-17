<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Nice.
 */
declare(strict_types=1);

namespace CRCore;

use pocketmine\utils\Config;

class API {
    /** @var Loader $main */
    public static $main;

    /** @var Config $names */
    public static $names;

    public static function getRandomName() : ?string{
        $n = self::$names->getNested("names");
        return $n[array_rand(self::$names->getNested("names"))];
    }
}