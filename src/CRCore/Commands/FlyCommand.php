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

namespace CRCore\Commands;

use CRCore\Loader;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class FlyCommand extends PluginCommand {

    public function __construct(Loader $plugin) {
        parent::__construct("fly", $plugin);
        $this->setDescription("Allows you to fly in survival");
        $this->setPermission("castleraid.fly");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if ($sender->hasPermission("castleraid.fly")) {
            if ($sender instanceof Player) {
                if (!$sender->isCreative()) {
                    if (!$sender->getAllowFlight()) {
                        $sender->setAllowFlight(true);
                        $sender->setFlying(true);
                        $sender->sendMessage(TextFormat::GREEN . "Fly mode enabled.");
                    } else {
                        $sender->setAllowFlight(false);
                        $sender->setFlying(false);
                        $sender->sendMessage(TextFormat::RED . "Fly mode disabled.");
                    }
                } else {
                    $sender->sendMessage(TextFormat::RED . "You are already in creative mode!");
                }
            } else {
                $sender->sendMessage(Loader::NOT_PLAYER);
            }
        } else {
            $sender->sendMessage(Loader::NO_PERMISSION);
        }
    }
}