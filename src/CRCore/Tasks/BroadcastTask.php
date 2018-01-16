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

use CRCore\Loader;
use pocketmine\Server;
use pocketmine\scheduler\PluginTask;
use pocketmine\utils\TextFormat;

class BroadcastTask extends PluginTask {

    private $main;

    public function __construct(Loader $main) {
        $this->main = $main;
    }

    public function onRun(int $currentTick) {
        $input = [
            "Message 1",
		    	  "Message 2",
            "Message 3"
        ];
		   $details = array_rand($input);
		   Server::getInstance()->broadcastMessage($input[$details]);
    }
}
