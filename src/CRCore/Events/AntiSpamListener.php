<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\Events;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\TextFormat;

use CRCore\Loader;

class AntiSpamListener implements Listener{

    private $main;
    private $badwords;
    private $links;

    public function __construct(Loader $main){
        $this->main = $main;
        $main->getServer()->getPluginManager()->registerEvents($this, $main);
        $this->badwords = ["anal", "anus", "ass", "bastard", "bitch", "boob", "cock", "cum", "cunt", "dick", "dildo", "dyke", "fag", "faggot", "fuck", "fuk", "handjob", "homo", "jizz", "cunt", "kike", "kunt", "muff", "nigger", "penis", "piss", "poop", "pussy", "queer", "rape", "semen", "sex", "shit", "slut", "titties", "twat", "vagina", "vulva", "wank"];
        $this->links = [".cc", ".net", ".com", ".us", ".co", ".co.uk", ".ddns", ".ddns.net", ".cf", ".me", "leet", ".leet.cc", "lifeboat", "mineplex", "inpvp", ".tk", "discord.gg", "discord.io"];
    }

    public function onSwearing(PlayerChatEvent $event) : void{
        $msg = $event->getMessage();
        $player = $event->getPlayer();
        foreach($this->badwords as $badwords){
            if(stripos($msg, $badwords) !== false){
                $player->sendMessage(TextFormat::DARK_BLUE . "CRCore " . TextFormat::GREEN . Loader::CORE_VERSION . TextFormat::AQUA . " > " . TextFormat::RED . "No swearing!");
                $event->setCancelled();
                return;
            }
        }
    }

    public function onAdvertising(PlayerChatEvent $event) : void{
        $msg = $event->getMessage();
        $player = $event->getPlayer();
        foreach($this->links as $links){
            if(stripos($msg, $links) !== false){
                $player->sendMessage(TextFormat::DARK_BLUE . "CRCore " . TextFormat::GREEN . Loader::CORE_VERSION . TextFormat::AQUA . " > " . TextFormat::RED . "No advertising!");
                $event->setCancelled(true);
                return;
            }
        }
    }
}
