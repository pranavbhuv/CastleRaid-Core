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

use CRCore\API;

use pocketmine\plugin\Plugin;
use pocketmine\scheduler\PluginTask;

class FakePlayerTask extends PluginTask {

    public $owner;

    public function __construct(Plugin $owner) {
        $this->owner = $owner;
        parent::__construct($owner);
    }


    public function onRun(int $currentTick) {
        $peep = new \specter\api\DummyPlayer(API::getRandomName());
        $peep->getPlayer()->chat("Hello everyone!");
        // TODO: make chat more reaListic. (ARRAYS, ARRAYS, ARRAYS.)
    }
}