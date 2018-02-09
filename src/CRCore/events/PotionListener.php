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
use pocketmine\entity\Effect;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat;

class PotionListener implements Listener{

    private $main;

    public function __construct(Loader $main){
        $this->main = $main;
        $main->getServer()->getPluginManager()->registerEvents($this, $main);
    }

    public function onConsume(PlayerItemConsumeEvent $event) : void{
        $player = $event->getPlayer();
        if($event->getItem()->getId() === 373){
            $damage = $event->getItem()->getDamage();
            switch($damage){
                case 100:
                    $player->addEffect(Effect::getEffect(Effect::SPEED)->setDuration(360 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::HASTE)->setDuration(360 * 20)->setAmplifier(2));
                    $player->addEffect(Effect::getEffect(Effect::NIGHT_VISION)->setDuration(180 * 20)->setAmplifier(1));
                    $player->getInventory()->removeItem(Item::get(Item::POTION, 100, 1));
                    $player->getInventory()->addItem(Item::get(Item::GLASS_BOTTLE, 0, 1));
                    $player->addTitle(TextFormat::DARK_GRAY . TextFormat::BOLD . "(" . TextFormat::GREEN . "!" . TextFormat::DARK_GRAY . ") " . TextFormat::RESET . TextFormat::GRAY . "Consumed:", TextFormat::RED . TextFormat::BOLD . "Raiding Potion");
                    break;

                case 101:
                    $player->addEffect(Effect::getEffect(Effect::JUMP)->setDuration(180 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::STRENGTH)->setDuration(30 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::NIGHT_VISION)->setDuration(360 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::FIRE_RESISTANCE)->setDuration(360 * 20)->setAmplifier(1));
                    $player->getInventory()->removeItem(Item::get(Item::POTION, 101, 1));
                    $player->getInventory()->addItem(Item::get(Item::GLASS_BOTTLE, 0, 1));
                    $player->addTitle(TextFormat::DARK_GRAY . TextFormat::BOLD . "(" . TextFormat::GREEN . "!" . TextFormat::DARK_GRAY . ") " . TextFormat::RESET . TextFormat::GRAY . "Consumed:", TextFormat::AQUA . TextFormat::BOLD . "Kingdom Potion");
                    break;

                case 102:
                    $player->addEffect(Effect::getEffect(Effect::JUMP)->setDuration(180 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::WATER_BREATHING)->setDuration(30 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::SATURATION)->setDuration(360 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::NIGHT_VISION)->setDuration(360 * 20)->setAmplifier(1));
                    $player->getInventory()->removeItem(Item::get(Item::POTION, 102, 1));
                    $player->getInventory()->addItem(Item::get(Item::GLASS_BOTTLE, 0, 1));
                    $player->addTitle(TextFormat::DARK_GRAY . TextFormat::BOLD . "(" . TextFormat::GREEN . "!" . TextFormat::DARK_GRAY . ") " . TextFormat::RESET . TextFormat::GRAY . "Consumed:", TextFormat::AQUA . TextFormat::BOLD . "Farming Potion");
                    break;

                case 103:
                    $player->addEffect(Effect::getEffect(Effect::SPEED)->setDuration(180 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::JUMP)->setDuration(30 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::FIRE_RESISTANCE)->setDuration(360 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::DAMAGE_RESISTANCE)->setDuration(360 * 20)->setAmplifier(1));
                    $player->getInventory()->removeItem(Item::get(Item::POTION, 103, 1));
                    $player->getInventory()->addItem(Item::get(Item::GLASS_BOTTLE, 0, 1));
                    $player->addTitle(TextFormat::DARK_GRAY . TextFormat::BOLD . "(" . TextFormat::GREEN . "!" . TextFormat::DARK_GRAY . ") " . TextFormat::RESET . TextFormat::GRAY . "Consumed:", TextFormat::AQUA . TextFormat::BOLD . "PvP Potion");
                    break;

                case 104:
                    $player->addEffect(Effect::getEffect(Effect::SPEED)->setDuration(180 * 20)->setAmplifier(2));
                    $player->addEffect(Effect::getEffect(Effect::JUMP)->setDuration(30 * 20)->setAmplifier(2));
                    $player->addEffect(Effect::getEffect(Effect::NIGHT_VISION)->setDuration(360 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::DAMAGE_RESISTANCE)->setDuration(360 * 20)->setAmplifier(1));
                    $player->getInventory()->removeItem(Item::get(Item::POTION, 104, 1));
                    $player->getInventory()->addItem(Item::get(Item::GLASS_BOTTLE, 0, 1));
                    $player->addTitle(TextFormat::DARK_GRAY . TextFormat::BOLD . "(" . TextFormat::GREEN . "!" . TextFormat::DARK_GRAY . ") " . TextFormat::RESET . TextFormat::GRAY . "Consumed:", TextFormat::AQUA . TextFormat::BOLD . "Getaway Potion");
                    break;

                case 105:
                    $player->addEffect(Effect::getEffect(Effect::SPEED)->setDuration(180 * 20)->setAmplifier(2));
                    $player->addEffect(Effect::getEffect(Effect::STRENGTH)->setDuration(30 * 20)->setAmplifier(2));
                    $player->addEffect(Effect::getEffect(Effect::JUMP)->setDuration(360 * 20)->setAmplifier(2));
                    $player->addEffect(Effect::getEffect(Effect::DAMAGE_RESISTANCE)->setDuration(360 * 20)->setAmplifier(1));
                    $player->getInventory()->removeItem(Item::get(Item::POTION, 104, 1));
                    $player->getInventory()->addItem(Item::get(Item::GLASS_BOTTLE, 0, 1));
                    $player->addTitle(TextFormat::DARK_GRAY . TextFormat::BOLD . "(" . TextFormat::GREEN . "!" . TextFormat::DARK_GRAY . ") " . TextFormat::RESET . TextFormat::GRAY . "Consumed:", TextFormat::AQUA . TextFormat::BOLD . "Kings Potion");
                    break;

            }
        }
    }

    public function onHeld(PlayerItemHeldEvent $event) : void{
        $player = $event->getPlayer();
        if($event->getItem()->getId() === 373){
            $damage = $event->getItem()->getDamage();
            $hand = $player->getInventory()->getItemInHand();
            switch($damage){
                case 100:
                    $item = Item::get(Item::POTION, 100, 1);
                    $player->getInventory()->removeItem($item);
                    $item->setCustomName(TextFormat::RESET . TextFormat::RED . TextFormat::BOLD . "Raiding Potion" . PHP_EOL . PHP_EOL .
                        TextFormat::RESET . TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Speed I" . TextFormat::GRAY . " (6:00)" . PHP_EOL .
                        TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Haste II" . TextFormat::GRAY . " (6:00)" . PHP_EOL .
                        TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Night Vision" . TextFormat::GRAY . " (3:00)");
                    $player->getInventory()->addItem($item);
                    break;

                case 101:
                    $item = Item::get(Item::POTION, 101, 1);
                    $player->getInventory()->removeItem($item);
                    $item->setCustomName(TextFormat::RESET . TextFormat::AQUA . TextFormat::BOLD . "Kingdom Potion" . PHP_EOL . PHP_EOL .
                        TextFormat::RESET . TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Jump Boost I" . TextFormat::GRAY . " (3:00)" . PHP_EOL .
                        TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Strength I" . TextFormat::GRAY . " (0:30)" . PHP_EOL .
                        TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Night Vision" . TextFormat::GRAY . " (6:00)" . PHP_EOL .
                        TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Fire Resistance" . TextFormat::GRAY . " (6:00)");
                    $player->getInventory()->addItem($item);
                    break;

                case 102:
                    $item = Item::get(Item::POTION, 102, 1);
                    $player->getInventory()->removeItem($item);
                    $item->setCustomName(TextFormat::RESET . TextFormat::AQUA . TextFormat::BOLD . "Farming Potion" . PHP_EOL . PHP_EOL .
                        TextFormat::RESET . TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Jump Boost I" . TextFormat::GRAY . " (3:00)" . PHP_EOL .
                        TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Water Breathing I" . TextFormat::GRAY . " (0:30)" . PHP_EOL .
                        TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Saturation 1" . TextFormat::GRAY . " (6:00)" . PHP_EOL .
                        TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Night Vision 1" . TextFormat::GRAY . " (6:00)");
                    $player->getInventory()->addItem($item);
                    break;

                case 103:
                    $item = Item::get(Item::POTION, 103, 1);
                    $player->getInventory()->removeItem($item);
                    $item->setCustomName(TextFormat::RESET . TextFormat::AQUA . TextFormat::BOLD . "PvP Potion" . PHP_EOL . PHP_EOL .
                        TextFormat::RESET . TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Speed I" . TextFormat::GRAY . " (3:00)" . PHP_EOL .
                        TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Jump I" . TextFormat::GRAY . " (0:30)" . PHP_EOL .
                        TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Resistance 1" . TextFormat::GRAY . " (6:00)" . PHP_EOL .
                        TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Night Vision 1" . TextFormat::GRAY . " (6:00)");
                    $player->getInventory()->addItem($item);
                    break;

                case 104:
                    $item = Item::get(Item::POTION, 104, 1);
                    $player->getInventory()->removeItem($item);
                    $item->setCustomName(TextFormat::RESET . TextFormat::AQUA . TextFormat::BOLD . "Getaway Potion" . PHP_EOL . PHP_EOL .
                        TextFormat::RESET . TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Swiftness II" . TextFormat::GRAY . " (3:00)" . PHP_EOL .
                        TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Jump Boost II" . TextFormat::GRAY . " (0:30)" . PHP_EOL .
                        TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Night Vision 1" . TextFormat::GRAY . " (6:00)" . PHP_EOL .
                        TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Resistance 1" . TextFormat::GRAY . " (6:00)");
                    $player->getInventory()->addItem($item);
                    break;

                case 105:
                    $item = Item::get(Item::POTION, 105, 1);
                    $player->getInventory()->removeItem($item);
                    $item->setCustomName(TextFormat::RESET . TextFormat::AQUA . TextFormat::BOLD . "Kings Potion" . PHP_EOL . PHP_EOL .
                        TextFormat::RESET . TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Swiftness II" . TextFormat::GRAY . " (3:00)" . PHP_EOL .
                        TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Strength II" . TextFormat::GRAY . " (0:30)" . PHP_EOL .
                        TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Jump Boost II" . TextFormat::GRAY . " (6:00)" . PHP_EOL .
                        TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Resistance 1" . TextFormat::GRAY . " (6:00)");
                    $player->getInventory()->addItem($item);
                    break;
            }

            if($hand->hasCustomName()){
                $event->setCancelled(true);
            }
        }
    }
}
