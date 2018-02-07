<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore;

use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class API{
    /** @var Loader $main */
    public static $main;

    /** @var Config $names */
    public static $names;

    /** @var Config $chat */
    public static $chat;

    /** @var Config $msg */
    public static $msg;
    
    const NOT_PLAYER = TextFormat::BOLD . TextFormat::GRAY . "(" . TextFormat::RED . "!" . TextFormat::GRAY . ")" . TextFormat::RED . "Use this command in-game!";

    public static function getRandomName() : string{
        $n = self::$names->getNested("names");
        return $n[array_rand($n)];
    }

    public static function getRandomChat() : string{
        $c = self::$chat->getNested("chat");
        return $c[array_rand($c)];
    }

    public static function getRandomBcast() : string{
        $b = self::$msg->getAll()["broadcast"];
        return $b[array_rand($b)];
    }
  
    public static function getRandomTextFormat(){
        return array_rand([TextFormat::BLACK,
            TextFormat::DARK_BLUE,
            TextFormat::DARK_GREEN,
            TextFormat::DARK_AQUA,
            TextFormat::DARK_RED,
            TextFormat::DARK_PURPLE,
            TextFormat::GOLD,
            TextFormat::GRAY,
            TextFormat::DARK_GRAY,
            TextFormat::BLUE,
            TextFormat::GREEN,
            TextFormat::AQUA,
            TextFormat::RED,
            TextFormat::LIGHT_PURPLE,
            TextFormat::YELLOW,
            TextFormat::WHITE]);

    }
}
