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

namespace CRCore\Tasks;

use pocketmine\Server;
use pocketmine\scheduler\PluginTask;
use pocketmine\utils\TextFormat;

class AlertTask extends PluginTask{

    /** @var Loader $main */
    public static $main;
    private static $messages = array("Woah Cool Message", "Another Cool Message");
  
    public function onRun(){
      index = array_rand($messages);
      foreach(Server::getInstance()->getDefaultLevel()->getPlayers() as $player){
        $player->sendMessage(TextFormat::RED . 'Alert' . TextFormat::GRAY . $messages[$index]);
      }
    }  
}
