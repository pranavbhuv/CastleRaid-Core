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

namespace CRshit\Commands;

use CRshit\Loader;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\PluginCommand;
use pocketmine\Player;

/**
 * Class NickCommand
 * @package CRshit\Commands
 */
class NickCommand extends PluginCommand implements CommandExecutor
{

    /**
     * NickCommand constructor.
     * @param Loader $plugin
     */
    public function __construct(Loader $plugin)
    {
        $this->setAliases(["nicky"]);
        $this->setPermission("castleraid.nick");
        $this->setDescription("NickCommand");
        parent::__construct("nickme", $plugin);
    }

    /**
     * @param CommandSender $sender
     * @param Command $command
     * @param string $label
     * @param array $args
     * @return bool|mixed
     */
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        $cmd = strtolower($command->getName());
        switch ($cmd) {
            case "nickme":
                if ($sender instanceof Player) {
                    if ($sender->hasPermission("castleraid.nick")) {
                        if (!isset($args[0])) {
                            $sender->sendMessage("Provide a nickname.");
                            return false;
                        }
                        if ($args[0] === "off") {
                            $this->removeNick($sender);
                        } else {
                            $this->setNick($sender, $args[0]);
                        }
                    }
                }
                break;
        }

        return true;
    }

    /**
     * @param $player
     * @param $nick
     */
    public function setNick(Player $player, $nick)
    {
        $player->setDisplayName($nick);
        $player->sendMessage("§l§7[§a!§7]§r§7 You're Now Nicked As '$nick'");
    }

    /**
     * @param $player
     */
    public function removeNick(Player $player)
    {
        $player->setDisplayName($player->getName());

    }
}