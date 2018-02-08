<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\events;

use CRCore\Loader;
use pocketmine\block\Diamond;
use pocketmine\block\Stone;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat;

class RelicListener implements Listener{

    private $main;

    public function __construct(Loader $main){
        $this->main = $main;
        $main->getServer()->getPluginManager()->registerEvents($this, $main);
    }

    public function onBreak(BlockBreakEvent $event) : void{
        $loot = Item::get(Item::COMPASS);
        $loot->setCustomName("Relic");
        $player = $event->getPlayer();
        if($event->getBlock()->getId() == Stone::STONE){
            if(mt_rand(1, 100) === 8){
                $player->getInventory()->addItem($loot);
            }
        }
    }

    public function onClick(PlayerInteractEvent $event) : void{
        $player = $event->getPlayer();
        $pii = $player->getInventory();
        $pi = $player->getInventory()->getItemInHand();
        if($pi->getName() === "Relic"){
            $pii->removeItem(Item::COMPASS);
            $player->sendMessage(TextFormat::GRAY . "Opening your Relic...");
            $player->sendMessage(TextFormat::GREEN . "Opened!");
            $pii->addItem(Diamond::DIAMOND_BLOCK);
        }
    }
}
