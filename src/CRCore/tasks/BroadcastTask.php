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

class BroadcastTask extends PluginTask{

    private $main;

    public function __construct(Loader $main){
        parent::__construct($main);
        $this->main = $main;
    }

    public function onRun(int $currentTick){
        $this->main->getServer()->broadcastMessage(API::getRandomBcast());
    }
}