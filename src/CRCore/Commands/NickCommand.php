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

class NickCommand extends PluginCommand {

    public function __construct(Loader $plugin) {
        parent::__construct("nickme", $plugin);
        $this->setAliases(["nicky"]);
        $this->setPermission("castleraid.nick");
        $this->setDescription("CastleRaid Core Nick Command");
    }
    
    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if ($this->testPermission($sender) and $sender instanceof Player) {
            if (!isset($args[0])) {
                $sender->sendMessage("Please provide a nickname.");
                return false;
            }
            if ($args[0] === "off") {
                $sender->setDisplayName($sender->getName());
            } else {
                $sender->setDisplayName($args[0]);
                $sender->sendMessage(TextFormat::BOLD . TextFormat::GRAY . "[" . TextFormat::GREEN . "!" . TextFormat::GRAY . "]" . TextFormat::RESET . TextFormat::GRAY . " You're now nicked as " . TextFormat::RED . "$args[0]" . TextFormat::GRAY . "!");
            }
            return true;
        } else {
            return false;
        }
    }
}