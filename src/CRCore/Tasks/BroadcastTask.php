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
use pocketmine\Server;

class BroadcastTask extends PluginTask{


    public function __construct(Loader $main){
        parent::__construct($main);
    }

    public function onRun(int $currentTick){
        Server::getInstance()->broadcastMessage(API::getRandomBcast());
    }
}