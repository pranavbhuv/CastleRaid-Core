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
 * Class HealCommand
 * @package CRCore\Commands
 */
class HealCommand extends PluginCommand implements CommandExecutor
{
    /**
     * HealCommand constructor.
     * @param Loader $plugin
     */
    public function __construct(Loader $plugin)
    {
        $this->setDescription("Heals a player");
        $this->setPermission("castleraid.heal");
        parent::__construct("heal", $plugin);
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
            case "heal":
                if($sender->hasPermission("castleraid.heal")) {
                    $sender->setHealth(20);
                    $sender->sendMessage(TextFormat::AQUA . "You have been healed!");
                    $sender->addTitle(TextFormat::DARK_RED . "You have been healed!");
                }
                break;
        }
        return true;
    }
}