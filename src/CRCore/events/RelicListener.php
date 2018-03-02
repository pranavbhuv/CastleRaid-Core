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
use pocketmine\block\Stone;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\IntTag;
use pocketmine\utils\TextFormat;

class RelicListener implements Listener{

    private $main;

    public function __construct(Loader $main){
        $this->main = $main;
        $main->getServer()->getPluginManager()->registerEvents($this, $main);
    }

    public function onBreak(BlockBreakEvent $event) : void{
        $nbt = new CompoundTag("", [new IntTag("relic", 1)]);
        $loot = Item::get(Item::COMPASS)->setCustomName("Relic")->setCustomBlockData($nbt);
        $loot->setCustomName("Relic");
        $player = $event->getPlayer();
        if($event->getBlock()->getId() == Stone::STONE){
            if(mt_rand(1, 100) <= 8){
                $player->getInventory()->addItem($loot);
            }
        }
    }

    public function onClick(PlayerInteractEvent $event) : void{
        $item = $event->getItem();
        $player = $event->getPlayer();
        $inv = $player->getInventory();
        if($item->getId() !== Item::COMPASS) return;
        if(!$item->hasCustomName() || !$item->hasCustomBlockData()) return;
        if($item->getCustomBlockData()->getInt("relic") !== 1) return;
        $inv->removeItem($item);
        $player->sendMessage(TextFormat::GRAY . "Opening your Relic...");
        $player->sendMessage(TextFormat::GREEN . "Opened!");
        $inv->addItem(Item::get(Item::DIAMOND_BLOCK));
    }
}