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

/**
 * Class FlyCommand
 * @package CRCore\Commands
 */
class FlyCommand extends PluginCommand {

    /**
     * FlyCommand constructor.
     * @param Loader $plugin
     */
    public function __construct(Loader $plugin) {
        parent::__construct("fly", $plugin);
        $this->setDescription("Allows you to fly in survival");
        $this->setPermission("castleraid.fly");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     * @return bool|mixed|void
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if ($this->testPermission($sender) and $sender instanceof Player) {
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

        }
    }
}