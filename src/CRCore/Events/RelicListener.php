<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Nice.
 */

namespace CRCore\Events;

use CRCore\Loader;
use pocketmine\block\Stone;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\event\Block;
use pocketmine\item\Compass;
use pocketmine\item\Item;

class RelicListener implements Listener {

    private $main;

    public function __construct(Loader $main) {
        $this->main = $main;
        $main->getServer()->getPluginManager()->registerEvents($this, $main);
    }

    public function onBreak(BlockBreakEvent $break) {
        $loot = Item::get(Compass::COMPASS);
        $loot->setCustomName("Relic");

        $p = $break->getPlayer();

        if ($break->getBlock()->getId() == Stone::STONE) {
            if (mt_rand(1, 100) === 8) {
                $p->getInventory()->addItem($loot);
            }

        }

    }
    //TODO, REWARDS
}
