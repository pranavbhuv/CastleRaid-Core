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

# Loader use:
use CRCore\Loader;

# Base PocketMine uses:
use pocketmine\entity\Effect;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;

class PotionListener implements Listener {

	public function onConsume(PlayerIte<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Nice.
 */


namespace CRCore\Events;

# Loader use:
use CRCore\Loader;

# Base PocketMine uses:
use pocketmine\entity\Effect;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;

class PotionListener implements Listener
{
    private $main;

    /**
     * EventListener constructor.
     * @param Loader $main
     */
    public function __construct(Loader $main)
    {
        $this->main = $main;
    }


    public function onConsume(PlayerItemConsumeEvent $event)
    {
        $player = $event->getPlayer();
        if ($event->getItem()->getId() === 373) {
            $damage = $event->getItem()->getDamage();
            switch ($damage) {
                case 100:
                    $player->addEffect(Effect::getEffect(Effect::SPEED)->setDuration(360 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::HASTE)->setDuration(360 * 20)->setAmplifier(2));
                    $player->addEffect(Effect::getEffect(Effect::NIGHT_VISION)->setDuration(180 * 20)->setAmplifier(1));
                    $player->getInventory()->removeItem(Item::get(Item::POTION, 100, 1));
                    $player->getInventory()->addItem(Item::get(Item::GLASS_BOTTLE, 0, 1));
                    $player->addTitle(TF::DARK_GRAY . TF::BOLD . "(" . TF::GREEN . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::GRAY . "Consumed:", TF::RED . TF::BOLD . "Raiding Potion");
                    break;

                case 101:
                    $player->addEffect(Effect::getEffect(Effect::JUMP)->setDuration(180 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::STRENGTH)->setDuration(30 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::NIGHT_VISION)->setDuration(360 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::FIRE_RESISTANCE)->setDuration(360 * 20)->setAmplifier(1));
                    $player->getInventory()->removeItem(Item::get(Item::POTION, 101, 1));
                    $player->getInventory()->addItem(Item::get(Item::GLASS_BOTTLE, 0, 1));
                    $player->addTitle(TF::DARK_GRAY . TF::BOLD . "(" . TF::GREEN . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::GRAY . "Consumed:", TF::AQUA . TF::BOLD . "Kingdom Potion");
                    break;

                case 102:
                    $player->addEffect(Effect::getEffect(Effect::JUMP)->setDuration(180 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::WATER_BREATHING)->setDuration(30 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::SATURATION)->setDuration(360 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::NIGHT_VISION)->setDuration(360 * 20)->setAmplifier(1));
                    $player->getInventory()->removeItem(Item::get(Item::POTION, 102, 1));
                    $player->getInventory()->addItem(Item::get(Item::GLASS_BOTTLE, 0, 1));
                    $player->addTitle(TF::DARK_GRAY . TF::BOLD . "(" . TF::GREEN . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::GRAY . "Consumed:", TF::AQUA . TF::BOLD . "Farming Potion");
                    break;

                case 103:
                    $player->addEffect(Effect::getEffect(Effect::SPEED)->setDuration(180 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::JUMP)->setDuration(30 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::FIRE_RESISTANCE)->setDuration(360 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::DAMAGE_RESISTANCE)->setDuration(360 * 20)->setAmplifier(1));
                    $player->getInventory()->removeItem(Item::get(Item::POTION, 103, 1));
                    $player->getInventory()->addItem(Item::get(Item::GLASS_BOTTLE, 0, 1));
                    $player->addTitle(TF::DARK_GRAY . TF::BOLD . "(" . TF::GREEN . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::GRAY . "Consumed:", TF::AQUA . TF::BOLD . "PvP Potion");
                    break;

                case 104:
                    $player->addEffect(Effect::getEffect(Effect::SPEED)->setDuration(180 * 20)->setAmplifier(2));
                    $player->addEffect(Effect::getEffect(Effect::JUMP)->setDuration(30 * 20)->setAmplifier(2));
                    $player->addEffect(Effect::getEffect(Effect::NIGHT_VISION)->setDuration(360 * 20)->setAmplifier(1));
                    $player->addEffect(Effect::getEffect(Effect::DAMAGE_RESISTANCE)->setDuration(360 * 20)->setAmplifier(1));
                    $player->getInventory()->removeItem(Item::get(Item::POTION, 104, 1));
                    $player->getInventory()->addItem(Item::get(Item::GLASS_BOTTLE, 0, 1));
                    $player->addTitle(TF::DARK_GRAY . TF::BOLD . "(" . TF::GREEN . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::GRAY . "Consumed:", TF::AQUA . TF::BOLD . "Getaway Potion");
                    break;

                case 105:
                    $player->addEffect(Effect::getEffect(Effect::SPEED)->setDuration(180 * 20)->setAmplifier(2));
                    $player->addEffect(Effect::getEffect(Effect::STRENGTH)->setDuration(30 * 20)->setAmplifier(2));
                    $player->addEffect(Effect::getEffect(Effect::JUMP)->setDuration(360 * 20)->setAmplifier(2));
                    $player->addEffect(Effect::getEffect(Effect::DAMAGE_RESISTANCE)->setDuration(360 * 20)->setAmplifier(1));
                    $player->getInventory()->removeItem(Item::get(Item::POTION, 104, 1));
                    $player->getInventory()->addItem(Item::get(Item::GLASS_BOTTLE, 0, 1));
                    $player->addTitle(TF::DARK_GRAY . TF::BOLD . "(" . TF::GREEN . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::GRAY . "Consumed:", TF::AQUA . TF::BOLD . "Kings Potion");
                    break;

            }
        }
    }

    public function onHeld(PlayerItemHeldEvent $event)
    {
        $player = $event->getPlayer();
        if ($event->getItem()->getId() === 373) {
            $damage = $event->getItem()->getDamage();
            $hand = $player->getInventory()->getItemInHand();
            switch ($damage) {
                case 100:
                    $item = Item::get(Item::POTION, 100, 1);
                    $player->getInventory()->removeItem($item);
                    $item->setCustomName(TF::RESET . TF::RED . TF::BOLD . "Raiding Potion" . PHP_EOL . PHP_EOL .
                        TF::RESET . TF::DARK_GRAY . " * " . TF::GREEN . "Speed I" . TF::GRAY . " (6:00)" . PHP_EOL .
                        TF::DARK_GRAY . " * " . TF::GREEN . "Haste II" . TF::GRAY . " (6:00)" . PHP_EOL .
                        TF::DARK_GRAY . " * " . TF::GREEN . "Night Vision" . TF::GRAY . " (3:00)");
                    $player->getInventory()->addItem($item);
                    break;

                case 101:
                    $item = Item::get(Item::POTION, 101, 1);
                    $player->getInventory()->removeItem($item);
                    $item->setCustomName(TF::RESET . TF::AQUA . TF::BOLD . "Kingdom Potion" . PHP_EOL . PHP_EOL .
                        TF::RESET . TF::DARK_GRAY . " * " . TF::GREEN . "Jump Boost I" . TF::GRAY . " (3:00)" . PHP_EOL .
                        TF::DARK_GRAY . " * " . TF::GREEN . "Strength I" . TF::GRAY . " (0:30)" . PHP_EOL .
                        TF::DARK_GRAY . " * " . TF::GREEN . "Night Vision" . TF::GRAY . " (6:00)" . PHP_EOL .
                        TF::DARK_GRAY . " * " . TF::GREEN . "Fire Resistance" . TF::GRAY . " (6:00)");
                    $player->getInventory()->addItem($item);
                    break;

                case 102:
                    $item = Item::get(Item::POTION, 102, 1);
                    $player->getInventory()->removeItem($item);
                    $item->setCustomName(TF::RESET . TF::AQUA . TF::BOLD . "Farming Potion" . PHP_EOL . PHP_EOL .
                        TF::RESET . TF::DARK_GRAY . " * " . TF::GREEN . "Jump Boost I" . TF::GRAY . " (3:00)" . PHP_EOL .
                        TF::DARK_GRAY . " * " . TF::GREEN . "Water Breathing I" . TF::GRAY . " (0:30)" . PHP_EOL .
                        TF::DARK_GRAY . " * " . TF::GREEN . "Saturation 1" . TF::GRAY . " (6:00)" . PHP_EOL .
                        TF::DARK_GRAY . " * " . TF::GREEN . "Night Vision 1" . TF::GRAY . " (6:00)");
                    $player->getInventory()->addItem($item);
                    break;

                case 103:
                    $item = Item::get(Item::POTION, 103, 1);
                    $player->getInventory()->removeItem($item);
                    $item->setCustomName(TF::RESET . TF::AQUA . TF::BOLD . "PvP Potion" . PHP_EOL . PHP_EOL .
                        TF::RESET . TF::DARK_GRAY . " * " . TF::GREEN . "Speed I" . TF::GRAY . " (3:00)" . PHP_EOL .
                        TF::DARK_GRAY . " * " . TF::GREEN . "Jump I" . TF::GRAY . " (0:30)" . PHP_EOL .
                        TF::DARK_GRAY . " * " . TF::GREEN . "Resistance 1" . TF::GRAY . " (6:00)" . PHP_EOL .
                        TF::DARK_GRAY . " * " . TF::GREEN . "Night Vision 1" . TF::GRAY . " (6:00)");
                    $player->getInventory()->addItem($item);
                    break;

                case 104:
                    $item = Item::get(Item::POTION, 104, 1);
                    $player->getInventory()->removeItem($item);
                    $item->setCustomName(TF::RESET . TF::AQUA . TF::BOLD . "Getaway Potion" . PHP_EOL . PHP_EOL .
                        TF::RESET . TF::DARK_GRAY . " * " . TF::GREEN . "Swiftness II" . TF::GRAY . " (3:00)" . PHP_EOL .
                        TF::DARK_GRAY . " * " . TF::GREEN . "Jump Boost II" . TF::GRAY . " (0:30)" . PHP_EOL .
                        TF::DARK_GRAY . " * " . TF::GREEN . "Night Vision 1" . TF::GRAY . " (6:00)" . PHP_EOL .
                        TF::DARK_GRAY . " * " . TF::GREEN . "Resistance 1" . TF::GRAY . " (6:00)");
                    $player->getInventory()->addItem($item);
                    break;

                case 105:
                    $item = Item::get(Item::POTION, 105, 1);
                    $player->getInventory()->removeItem($item);
                    $item->setCustomName(TF::RESET . TF::AQUA . TF::BOLD . "Kings Potion" . PHP_EOL . PHP_EOL .
                        TF::RESET . TF::DARK_GRAY . " * " . TF::GREEN . "Swiftness II" . TF::GRAY . " (3:00)" . PHP_EOL .
                        TF::DARK_GRAY . " * " . TF::GREEN . "Strength II" . TF::GRAY . " (0:30)" . PHP_EOL .
                        TF::DARK_GRAY . " * " . TF::GREEN . "Jump Boost II" . TF::GRAY . " (6:00)" . PHP_EOL .
                        TF::DARK_GRAY . " * " . TF::GREEN . "Resistance 1" . TF::GRAY . " (6:00)");
                    $player->getInventory()->addItem($item);
                    break;
            }

            if ($hand->hasCustomName()) {
                $event->setCancelled();
            }
        }
    }
}
mConsumeEvent $event) {
		$player = $event->getPlayer();
		if($event->getItem()->getId() === 373) {
			$damage = $event->getItem()->getDamage();
			switch($damage) {
				case 100:
				$player->addEffect(Effect::getEffect(Effect::SPEED)->setDuration(360*20)->setAmplifier(1));
				$player->addEffect(Effect::getEffect(Effect::HASTE)->setDuration(360*20)->setAmplifier(2));
				$player->addEffect(Effect::getEffect(Effect::NIGHT_VISION)->setDuration(180*20)->setAmplifier(1));
				$player->getInventory()->removeItem(Item::get(Item::POTION, 100, 1));
				$player->getInventory()->addItem(Item::get(Item::GLASS_BOTTLE, 0, 1));
				$player->addTitle(TF::DARK_GRAY . TF::BOLD . "(" . TF::GREEN . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::GRAY . "Consumed:", TF::RED . TF::BOLD . "Raiding Elixir");
				break;
				
				case 101:
				$player->addEffect(Effect::getEffect(Effect::JUMP)->setDuration(180*20)->setAmplifier(1));
				$player->addEffect(Effect::getEffect(Effect::STRENGTH)->setDuration(30*20)->setAmplifier(1));
				$player->addEffect(Effect::getEffect(Effect::NIGHT_VISION)->setDuration(360*20)->setAmplifier(1));
				$player->addEffect(Effect::getEffect(Effect::FIRE_RESISTANCE)->setDuration(360*20)->setAmplifier(1));
				$player->getInventory()->removeItem(Item::get(Item::POTION, 101, 1));
				$player->getInventory()->addItem(Item::get(Item::GLASS_BOTTLE, 0, 1));
				$player->addTitle(TF::DARK_GRAY . TF::BOLD . "(" . TF::GREEN . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::GRAY . "Consumed:", TF::AQUA . TF::BOLD . "PVP Elixir");
				break;
			}
		}
	}

	public function onHeld(PlayerItemHeldEvent $event) {
		$player = $event->getPlayer();
		if($event->getItem()->getId() === 373) {
			$damage = $event->getItem()->getDamage();
			$hand = $player->getInventory()->getItemInHand();
			switch($damage) {
				case 100:
				$item = Item::get(Item::POTION, 100, 1);
				$player->getInventory()->removeItem($item);
				$item->setCustomName(TF::RESET . TF::RED . TF::BOLD . "Raiding Elixir" . PHP_EOL . PHP_EOL .
									 TF::RESET . TF::DARK_GRAY . " * " . TF::GREEN . "Speed I" . TF::GRAY . " (6:00)" . PHP_EOL .
									 TF::DARK_GRAY . " * " . TF::GREEN . "Haste II" . TF::GRAY . " (6:00)" . PHP_EOL .
									 TF::DARK_GRAY . " * " . TF::GREEN . "Night Vision" . TF::GRAY . " (3:00)");
				
				$player->getInventory()->addItem($item);
				break;
				
				case 101:
				$item = Item::get(Item::POTION, 101, 1);
				$player->getInventory()->removeItem($item);
				$item->setCustomName(TF::RESET . TF::AQUA . TF::BOLD . "PVP Elixir" . PHP_EOL . PHP_EOL .
									 TF::RESET . TF::DARK_GRAY . " * " . TF::GREEN . "Jump Boost I" . TF::GRAY . " (3:00)" . PHP_EOL .
									 TF::DARK_GRAY . " * " . TF::GREEN . "Strength I" . TF::GRAY . " (0:30)" . PHP_EOL .
									 TF::DARK_GRAY . " * " . TF::GREEN . "Night Vision" . TF::GRAY . " (6:00)" . PHP_EOL .
									 TF::DARK_GRAY . " * " . TF::GREEN . "Fire Resistance" . TF::GRAY . " (6:00)");
									 
				$player->getInventory()->addItem($item);
				break;
			}
			
			if($hand->hasCustomName()) {
				$event->setCancelled();
			}
		}
	}
}
