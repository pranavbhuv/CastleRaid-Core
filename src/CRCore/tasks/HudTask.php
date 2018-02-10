<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\tasks;

use CRCore\API;
use CRCore\Loader;

use pocketmine\scheduler\PluginTask;
use pocketmine\utils\TextFormat;

class HudTask extends PluginTask{

    private $plugin;

    public function __construct(Loader $owner){
        parent::__construct($owner);
        $this->plugin = $owner;
    }

    public function onRun(int $currentTick){
        $onlineplayers = $this->plugin->getServer()->getOnlinePlayers();
        $msg = count($onlineplayers) === 1 ? TextFormat::GRAY ."There is only" . TextFormat::YELLOW . " 1 " . TextFormat::GRAY . "player online." : TextFormat::GRAY . "There are " . TextFormat::YELLOW . count($this->plugin->getServer()->getOnlinePlayers()) . TextFormat::GRAY ." players online.";
        foreach($onlineplayers as $player){
            $player->sendTip(TextFormat::GRAY . "     -==+" . TextFormat::GREEN . "CastleRaid" . TextFormat::GRAY . "+==-\n" . $msg);
        }
    }
}