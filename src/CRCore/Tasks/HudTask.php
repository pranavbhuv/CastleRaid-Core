<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\Tasks;

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
        foreach($this->plugin->getServer()->getOnlinePlayers() as $player){
            $player->sendTip(TextFormat::GRAY . "-==+" . TextFormat::GREEN . "CastleRaid" . TextFormat::GRAY . "+==-" . PHP_EOL .
                             "There are " . TextFormat::YELLOW . count($this->plugin->getServer()->getOnlinePlayers()) . TextFormat::GRAY ." players online."); //Edit this with the message you want for the hud Quiver
        }
    }
}