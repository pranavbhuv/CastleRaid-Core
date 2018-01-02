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
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\PluginCommand;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

/**
 * Class FlyCommand
 * @package CRCore\Commands
 */
class FlyCommand extends PluginCommand implements CommandExecutor
{
    /**
     * FlyCommand constructor.
     * @param Loader $plugin
     */
    public function __construct(Loader $plugin)
    {
        $this->setDescription("Allows player to fly in survival");
        $this->setPermission("castleraid.fly");
        parent::__construct("fly", $plugin);
    }

    /**
     * @param CommandSender $sender
     * @param Command $command
     * @param string $label
     * @param array $args
     * @return bool
     */
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        $cmd = strtolower($command->getName());
        switch ($cmd) {
            case "fly":
                if($sender->hasPermission("castleraid.fly")) {
                    if (!$sender->getAllowFlight()) {
                        $sender->setAllowFlight(true);
                        $sender->sendMessage(TextFormat::GREEN . "Fly mode enabled.");
                    } else {
                        if ($sender->getAllowFlight()) {
                            $sender->setAllowFlight(false);
                            $sender->sendMessage(TextFormat::RED . "Fly mode disabled.");
                        }
                    }
                }
                break;
        }
        return true;
    }
}