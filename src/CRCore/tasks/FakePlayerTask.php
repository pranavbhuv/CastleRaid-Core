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
use specter\api\DummyPlayer;

class FakePlayerTask extends PluginTask{

    private $plugin;

    public function __construct(Loader $owner){
        parent::__construct($owner);
        $this->plugin = $owner;
    }


    public function onRun(int $currentTick){
        $peep = new DummyPlayer(API::getRandomName(), "SPECTER", mt_rand(10000, 20000));
        $this->plugin->getServer()->getScheduler()->scheduleDelayedTask(new FakePlayerChatTask(API::$main, $peep->getPlayer()), 50);
    }
}