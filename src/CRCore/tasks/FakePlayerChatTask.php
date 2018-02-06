<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */

namespace CRCore\tasks;

use CRCore\API;

use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\scheduler\PluginTask;

class FakePlayerChatTask extends PluginTask{

    /** @var Player $p */ 
    private $p;

    public function __construct(Plugin $owner, Player $player){
        $this->p = $player;
        parent::__construct($owner);
    }

    public function onRun(int $currentTick){
        $this->p->chat(API::getRandomChat());
    }
}
