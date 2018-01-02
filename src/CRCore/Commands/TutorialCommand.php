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

# CRCore Loader File:
use CRCore\Loader;

# Base PocketMine uses:
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\PluginCommand;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

# Plugin Dependencies:
use jojoe77777\FormAPI;

/**
 * Class TutorialCommand
 * @package CRShit\Commands
 */
class TutorialCommand extends PluginCommand implements CommandExecutor
{

    /**
     * TutorialCommand constructor.
     * @param Loader $plugin
     */
    public function __construct(Loader $plugin)
    {
        $this->setPermission("castleraid.tutorial");
        $this->setDescription("Tutorial Command");
        parent::__construct("tutorial", $plugin);
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
        $player = $sender->getPlayer();
        $cmd = strtolower($command->getName());
        switch ($cmd) {
            case "tutorial":
                $this->tutorialForm($player);
                break;
        }
        return true;
    }

    /**
     * @param Player $player
     */
    public function tutorialForm(Player $player){
        //TODO: TutorialForm UI (Quiver)
    }
}