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

namespace CRCore\Events;

use CRCore\Loader;
use pocketmine\block\Diamond;
use pocketmine\block\Stone;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Compass;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat;

class RelicListener implements Listener {

    private $main;

    public function __construct(Loader $main) {
        $this->main = $main;
        $main->getServer()->getPluginManager()->registerEvents($this, $main);
    }

    public function onBreak(BlockBreakEvent $break) {
        $loot = Item::get(Compass::COMPASS);
        $loot->setCustomName("Relic");
        $player = $break->getPlayer();
        if ($break->getBlock()->getId() == Stone::STONE) {
            if (mt_rand(1, 100) === 8) {
                $player->getInventory()->addItem($loot);
            }
        }
    }

    public function onClick(PlayerInteractEvent $event) {
        $p = $event->getPlayer();
        $pii = $event->getPlayer()->getInventory();
        $pi = $event->getPlayer()->getInventory()->getItemInHand();

        if ($pi->getName() == "Relic") {
            $pii->remove(Compass::COMPASS);
            $p->sendMessage(TextFormat::GRAY . "Opening your Relic...");
            $p->sendMessage(TextFormat::GREEN . "Opened!");
            $pii->addItem(Diamond::DIAMOND_BLOCK);
        }
    }
}
