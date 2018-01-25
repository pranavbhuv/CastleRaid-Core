<?php
/**
 * Created by PhpStorm.
 * User: pacma
 * Date: 1/25/2018
 * Time: 7:14 PM
 */

namespace CRCore\Events;


use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\Player;

class HeadListener implements Listener {

    private $main;

    public function __construct(Loader $main)
    {
        $this->main = $main;
        $main->getServer()->getPluginManager()->registerEvents($this, $main);
    }

    public function onDeath(PlayerDeathEvent $event): void
    {
        $player = $event->getPlayer();
        $ldc = $player->getLastDamageCause();
        if ($ldc instanceof EntityDamageEvent) {
            $killer = $ldc->getDamager();
            if ($killer instanceof Player) {
                $item = Item::get(397, 0, 1);
                $item->setCustomName($player->getName());
                $killer->getInventory()->addItem($item);
                $killer->sendMessage(TextFormat::BOLD . TextFormat::GREEN . "+ You got ".$player."'s head!");
            }

        }
    }

    public function onTap(PlayerInteractEvent $event) {
        $event->getNam
    }


}
