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

class API{

    /** @var Loader $main */
    public static $main;

    public static $songs = ["narwhalsong", "narwhal"];

    /**
     * @return Loader
     */
    public static function getMain(): Loader{
        return self::$main;
    }

    /**
     * @param string $songname
     * @return string
     */
    public static function singasong(string $songname) : string{
        if(!in_array($songname, self::$songs)) return "Hello darkness my old friend\n I've come to talk to you again";
        if(strtolower($songname) === "narwhalsong" || strtolower($songname) === "narwhal") return
            "§bNarwhals narwhals\n
        Swimming in the ocean\n
        Causing a commotion\n
        Coz they are so awesome\n\n
        Narwhals narwhals\n
        Swimming in the ocean\n
        Pretty big and pretty white\n
        They beat a polar bear in a fight\n\n
        Like an underwater unicorn\n
        They've got a kick-ass facial horn\n
        They're the jedi of the sea\n
        They stop Cthulu eating ye\n\n
        Narwhals\n
        They are narwhals\n
        Narwhals\n
        Just don't let 'em touch your balls\n
        Narwhals\n
        They are narwhals\n
        Inventors of the shish kebab";
        return "Error.";
    }
}
