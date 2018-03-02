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
        $potion = $event->getItem();
        if($potion->getId() !== Item::POTION) return;
        if(!$potion->hasCustomBlockData()) return;
        $nbt = $potion->getCustomBlockData()->getString("type");
        switch($nbt){
            case "raiding":
                $player->addEffect(Effect::getEffect(Effect::SPEED)->setDuration(360 * 20)->setAmplifier(1));
                $player->addEffect(Effect::getEffect(Effect::HASTE)->setDuration(360 * 20)->setAmplifier(2));
                $player->addEffect(Effect::getEffect(Effect::NIGHT_VISION)->setDuration(180 * 20)->setAmplifier(1));
                $player->getInventory()->removeItem($potion);
                $player->getInventory()->addItem(Item::get(Item::GLASS_BOTTLE));
                $player->addTitle(TextFormat::DARK_GRAY . TextFormat::BOLD . "(" . TextFormat::GREEN . "!" . TextFormat::DARK_GRAY . ") " . TextFormat::RESET . TextFormat::GRAY . "Consumed:", TextFormat::RED . TextFormat::BOLD . "Raiding Potion");
                break;
            case "kingdom":
                $player->addEffect(Effect::getEffect(Effect::JUMP)->setDuration(180 * 20)->setAmplifier(1));
                $player->addEffect(Effect::getEffect(Effect::STRENGTH)->setDuration(30 * 20)->setAmplifier(1));
                $player->addEffect(Effect::getEffect(Effect::NIGHT_VISION)->setDuration(360 * 20)->setAmplifier(1));
                $player->addEffect(Effect::getEffect(Effect::FIRE_RESISTANCE)->setDuration(360 * 20)->setAmplifier(1));
                $player->getInventory()->removeItem($potion);
                $player->getInventory()->addItem(Item::get(Item::GLASS_BOTTLE));
                $player->addTitle(TextFormat::DARK_GRAY . TextFormat::BOLD . "(" . TextFormat::GREEN . "!" . TextFormat::DARK_GRAY . ") " . TextFormat::RESET . TextFormat::GRAY . "Consumed:", TextFormat::AQUA . TextFormat::BOLD . "Kingdom Potion");
                break;
            case "farming":
                $player->addEffect(Effect::getEffect(Effect::JUMP)->setDuration(180 * 20)->setAmplifier(1));
                $player->addEffect(Effect::getEffect(Effect::WATER_BREATHING)->setDuration(30 * 20)->setAmplifier(1));
                $player->addEffect(Effect::getEffect(Effect::SATURATION)->setDuration(360 * 20)->setAmplifier(1));
                $player->addEffect(Effect::getEffect(Effect::NIGHT_VISION)->setDuration(360 * 20)->setAmplifier(1));
                $player->getInventory()->removeItem($potion);
                $player->getInventory()->addItem(Item::get(Item::GLASS_BOTTLE));
                $player->addTitle(TextFormat::DARK_GRAY . TextFormat::BOLD . "(" . TextFormat::GREEN . "!" . TextFormat::DARK_GRAY . ") " . TextFormat::RESET . TextFormat::GRAY . "Consumed:", TextFormat::AQUA . TextFormat::BOLD . "Farming Potion");
                break;
            case "pvp":
                $player->addEffect(Effect::getEffect(Effect::SPEED)->setDuration(180 * 20)->setAmplifier(1));
                $player->addEffect(Effect::getEffect(Effect::JUMP)->setDuration(30 * 20)->setAmplifier(1));
                $player->addEffect(Effect::getEffect(Effect::FIRE_RESISTANCE)->setDuration(360 * 20)->setAmplifier(1));
                $player->addEffect(Effect::getEffect(Effect::DAMAGE_RESISTANCE)->setDuration(360 * 20)->setAmplifier(1));
                $player->getInventory()->removeItem($potion);
                $player->getInventory()->addItem(Item::get(Item::GLASS_BOTTLE));
                $player->addTitle(TextFormat::DARK_GRAY . TextFormat::BOLD . "(" . TextFormat::GREEN . "!" . TextFormat::DARK_GRAY . ") " . TextFormat::RESET . TextFormat::GRAY . "Consumed:", TextFormat::AQUA . TextFormat::BOLD . "PvP Potion");
                break;
            case "getaway":
                $player->addEffect(Effect::getEffect(Effect::SPEED)->setDuration(180 * 20)->setAmplifier(2));
                $player->addEffect(Effect::getEffect(Effect::JUMP)->setDuration(30 * 20)->setAmplifier(2));
                $player->addEffect(Effect::getEffect(Effect::NIGHT_VISION)->setDuration(360 * 20)->setAmplifier(1));
                $player->addEffect(Effect::getEffect(Effect::DAMAGE_RESISTANCE)->setDuration(360 * 20)->setAmplifier(1));
                $player->getInventory()->removeItem($potion);
                $player->getInventory()->addItem(Item::get(Item::GLASS_BOTTLE));
                $player->addTitle(TextFormat::DARK_GRAY . TextFormat::BOLD . "(" . TextFormat::GREEN . "!" . TextFormat::DARK_GRAY . ") " . TextFormat::RESET . TextFormat::GRAY . "Consumed:", TextFormat::AQUA . TextFormat::BOLD . "Getaway Potion");
                break;
            case "kings":
                $player->addEffect(Effect::getEffect(Effect::SPEED)->setDuration(180 * 20)->setAmplifier(2));
                $player->addEffect(Effect::getEffect(Effect::STRENGTH)->setDuration(30 * 20)->setAmplifier(2));
                $player->addEffect(Effect::getEffect(Effect::JUMP)->setDuration(360 * 20)->setAmplifier(2));
                $player->addEffect(Effect::getEffect(Effect::DAMAGE_RESISTANCE)->setDuration(360 * 20)->setAmplifier(1));
                $player->getInventory()->removeItem($potion);
                $player->getInventory()->addItem(Item::get(Item::GLASS_BOTTLE));
                $player->addTitle(TextFormat::DARK_GRAY . TextFormat::BOLD . "(" . TextFormat::GREEN . "!" . TextFormat::DARK_GRAY . ") " . TextFormat::RESET . TextFormat::GRAY . "Consumed:", TextFormat::AQUA . TextFormat::BOLD . "Kings Potion");
                break;
        }
    }

    public function onHeld(PlayerItemHeldEvent $event) : void{
        $potion = $event->getItem();
        $inv = $event->getPlayer()->getInventory();
        if($potion->getId() !== Item::POTION) return;
        if(!$potion->hasCustomBlockData()) return;
        if($potion->hasCustomName() && stripos($potion->getCustomName(), "potion")) return;
        $nbt = $potion->getCustomBlockData()->getString("type");
        switch($nbt){
            case "raiding":
                $inv->removeItem($potion);
                $potion->setCustomName(TextFormat::RESET . TextFormat::RED . TextFormat::BOLD . "Raiding Potion" . TextFormat::EOL . TextFormat::EOL .
                    TextFormat::RESET . TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Speed I" . TextFormat::GRAY . " (6:00)" .
                    TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Haste II" . TextFormat::GRAY . " (6:00)" .
                    TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Night Vision" . TextFormat::GRAY . " (3:00)");
                $inv->addItem($potion);
                break;
            case "kingdom":
                $inv->removeItem($potion);
                $potion->setCustomName(TextFormat::RESET . TextFormat::AQUA . TextFormat::BOLD . "Kingdom Potion" . TextFormat::EOL . TextFormat::EOL .
                    TextFormat::RESET . TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Jump Boost I" . TextFormat::GRAY . " (3:00)" . TextFormat::EOL .
                    TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Strength I" . TextFormat::GRAY . " (0:30)" . TextFormat::EOL .
                    TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Night Vision" . TextFormat::GRAY . " (6:00)" . TextFormat::EOL .
                    TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Fire Resistance" . TextFormat::GRAY . " (6:00)");
                $inv->addItem($potion);
                break;
            case "farming":
                $inv->removeItem($potion);
                $potion->setCustomName(TextFormat::RESET . TextFormat::AQUA . TextFormat::BOLD . "Farming Potion" . TextFormat::EOL . TextFormat::EOL .
                    TextFormat::RESET . TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Jump Boost I" . TextFormat::GRAY . " (3:00)" . TextFormat::EOL .
                    TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Water Breathing I" . TextFormat::GRAY . " (0:30)" . TextFormat::EOL .
                    TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Saturation 1" . TextFormat::GRAY . " (6:00)" . TextFormat::EOL .
                    TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Night Vision 1" . TextFormat::GRAY . " (6:00)");
                $inv->addItem($potion);
                break;
            case "pvp":
                $inv->removeItem($potion);
                $potion->setCustomName(TextFormat::RESET . TextFormat::AQUA . TextFormat::BOLD . "PvP Potion" . TextFormat::EOL . TextFormat::EOL .
                    TextFormat::RESET . TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Speed I" . TextFormat::GRAY . " (3:00)" . TextFormat::EOL .
                    TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Jump Boost I" . TextFormat::GRAY . " (0:30)" . TextFormat::EOL .
                    TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Resistance 1" . TextFormat::GRAY . " (6:00)" . TextFormat::EOL .
                    TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Night Vision 1" . TextFormat::GRAY . " (6:00)");
                $inv->addItem($potion);
                break;
            case "getaway":
                $inv->removeItem($potion);
                $potion->setCustomName(TextFormat::RESET . TextFormat::AQUA . TextFormat::BOLD . "Getaway Potion" . TextFormat::EOL . TextFormat::EOL .
                    TextFormat::RESET . TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Swiftness II" . TextFormat::GRAY . " (3:00)" . TextFormat::EOL .
                    TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Jump Boost II" . TextFormat::GRAY . " (0:30)" . TextFormat::EOL .
                    TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Night Vision 1" . TextFormat::GRAY . " (6:00)" . TextFormat::EOL .
                    TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Resistance 1" . TextFormat::GRAY . " (6:00)");
                $inv->addItem($potion);
                break;
            case "kings":
                $inv->removeItem($potion);
                $potion->setCustomName(TextFormat::RESET . TextFormat::AQUA . TextFormat::BOLD . "Kings Potion" . TextFormat::EOL . TextFormat::EOL .
                    TextFormat::RESET . TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Swiftness II" . TextFormat::GRAY . " (3:00)" . TextFormat::EOL .
                    TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Strength II" . TextFormat::GRAY . " (0:30)" . TextFormat::EOL .
                    TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Jump Boost II" . TextFormat::GRAY . " (6:00)" . TextFormat::EOL .
                    TextFormat::DARK_GRAY . " * " . TextFormat::GREEN . "Resistance 1" . TextFormat::GRAY . " (6:00)");
                $inv->addItem($potion);
                break;
        }
    }
}
