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
    
    const NOT_PLAYER = TextFormat::BOLD . TextFormat::GRAY . "(" . TextFormat::RED . "!" . TextFormat::GRAY . ")" . TextFormat::RED . " Use this command in-game!";

    const QUEST_PREFIX = "";

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

    public static function getRandomColor() : string{
        $ltr = "abcdef";
        return TextFormat::ESCAPE . (mt_rand(0, 1) == 1 ? $ltr[mt_rand(0, strlen($ltr) - 1)] : strval(mt_rand(0, 9)));
    }
}
