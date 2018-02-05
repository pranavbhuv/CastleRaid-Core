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
use CRCore\API;

use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\event\player\PlayerInteractEvent;

class QuestListener implements Listener{

    private $main;

    public function __construct(Loader $main){
        $this->main = $main;
        $main->getServer()->getPluginManager()->registerEvents($this, $main);
    }

    public function onInteract(PlayerInteractEvent $event) : void{
        $player = $event->getPlayer();
        $inv = $player->getInventory();
        if($event->getItem()->getId() === 54){
            $damage = $event->getItem()->getDamage();
            switch($damage){
                case 10:
                    $player->sendMessage(TextFormat::AQUA . "Congrats, you have completed the quest, here are your rewards!");
                    $inv->addItem(Item::get(Item::DIAMOND, 0, 10)); //Quiver edit this depending on the quest rewards
                    $inv->removeItem(Item::get(54, 10, 1));
                    $this->main->getServer()->broadcastMessage(API::QUEST_PREFIX . TextFormat::GOLD . $player . " has completed the quest!");
                    break;
                case 11:
                    $player->sendMessage(TextFormat::AQUA . "Congrats, you have completed the quest, here are your rewards!");
                    $inv->addItem(Item::get(Item::DIAMOND, 0, 10)); //Quiver edit this depending on the quest rewards
                    $inv->removeItem(Item::get(54, 11, 1));
                    $this->main->getServer()->broadcastMessage(API::QUEST_PREFIX . TextFormat::GOLD . $player . " has completed the quest!");
                    break;
            }
        }
    }
}