<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Jason.
 */
declare(strict_types=1);

namespace CRCore\Tasks;

use CRCore\API;

use pocketmine\plugin\Plugin;
use pocketmine\scheduler\PluginTask;
use specter\api\DummyPlayer;

class FakePlayerTask extends PluginTask {

    public function __construct(Plugin $owner, Player $player) {
        parent::__construct($owner);
        $this->player = $player;
    }


    public function onRun(int $currentTick) {
        $peep = new DummyPlayer(API::getRandomName(), "SPECTER", mt_rand(10000, 20000));
        API::$main->getServer()->getScheduler()->scheduleDelayedTask(new FakePlayerChatTask(API::$main, $peep->getPlayer()), 50);
    }
}
