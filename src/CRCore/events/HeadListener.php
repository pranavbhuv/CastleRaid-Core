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
use CRCore\person\Person;
use onebone\economyapi\EconomyAPI;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\nbt\tag\{
    CompoundTag, IntTag, StringTag
};
use pocketmine\tile\Skull;
use pocketmine\utils\TextFormat;

class HeadListener implements Listener{

    private $main;

    public function __construct(Loader $main){
        $this->main = $main;
        $main->getServer()->getPluginManager()->registerEvents($this, $main);
    }

    public function onDeath(PlayerDeathEvent $event) : void{
        $player = $event->getPlayer();
        $item = Item::get(Item::SKULL, Skull::TYPE_HUMAN, 1);
        $nbt = new CompoundTag("", [new IntTag("head", 1), new StringTag("owner", $player->getName())]);
        $item->setCustomBlockData($nbt);
        $item->setCustomName(TextFormat::YELLOW . $player->getName() . "'s Head");
        $player->getLevel()->dropItem($player, $item);
    }

    public function onTap(PlayerInteractEvent $event) : void{
        $item = $event->getItem();
        /** @var Person $player */
        $player = $event->getPlayer();
        if($item->hasCustomBlockData()){
            if($item->getCustomBlockData()->getInt("head") === 1){
                $event->setCancelled();
                $owner = $item->getCustomBlockData()->getString("owner");
                $player->getInventory()->removeItem($item);
                $cash = round(EconomyAPI::getInstance()->myMoney($owner) * 0.05);
                $player->addTitle(TextFormat::AQUA . "Redeemed $owner's head", TextFormat::GOLD . "Received $$cash ");
                $player->addMoney($cash);
                EconomyAPI::getInstance()->reduceMoney($owner, $cash);
            }
        }
    }
}