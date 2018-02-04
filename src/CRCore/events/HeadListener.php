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


use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

use onebone\economyapi\EconomyAPI;

class HeadListener implements Listener{

    private $main;

    public function __construct(Loader $main){
        $this->main = $main;
        $main->getServer()->getPluginManager()->registerEvents($this, $main);
    }

    public function onDeath(PlayerDeathEvent $event) : void{
        $player = $event->getPlayer();
        $ldc = $player->getLastDamageCause();
        if($ldc instanceof EntityDamageEvent){
            $killer = $ldc->getDamager();
            if($killer instanceof Player){
                $item = Item::get(397, 0, 1);
                $nbt = new CompoundTag("", [new IntTag("head", 1), new StringTag("owner", $player->getName())]);
                $item->setCustomBlockData($nbt);
                $item->setCustomName($player->getName() . "'s Head");
                $killer->getInventory()->addItem($item);
                $killer->sendMessage(TextFormat::BOLD . TextFormat::GREEN . "+ You got " . $player . "'s head!");
            }
        }
    }

    public function onTap(PlayerInteractEvent $event) : void{
        $item = $event->getItem();
        $player = $event->getPlayer();
        if($item->hasCustomBlockData()){
            if($item->getCustomBlockData()->getInt("head") === 1){
                $owner = $item->getCustomBlockData()->getString("owner");
                $player->sendMessage("Redeemed $owner's head");
                $player->getInventory()->removeItem($item);
                $cash = EconomyAPI::getInstance()->myMoney($owner) * 0.05;
                EconomyAPI::getInstance()->addMoney($player, $cash);
                EcnonomyAPI::getInstance()->reduceMoney($owner, $cash);
                
            }
        }
    }
}
