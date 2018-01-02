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
use pocketmine\inventory\Inventory;
use pocketmine\utils\TextFormat;

/**
 * Class ClearInventoryCommand
 * @package CRCore\Commands
 */
class ClearInventoryCommand extends PluginCommand implements CommandExecutor
{
    /**
     * ClearInventoryCommand constructor.
     * @param Loader $plugin
     */
    public function __construct(Loader $plugin)
    {
        $this->setDescription("Clears a player's inventory");
        $this->setPermission("castleraid.clearinv");
        parent::__construct("clearinv", $plugin);
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
            case "clearinv":
                if($sender->hasPermission("castleraid.clearinv")) {
                    $sender->getInventory()->clearAll();
                    $sender->sendMessage(TextFormat::AQUA . "You have now cleared your inventory!");
                    $sender->addTitle(TextFormat::DARK_RED . "Inventory Cleared!");
                }
                break;
        }
        return true;
    }
}