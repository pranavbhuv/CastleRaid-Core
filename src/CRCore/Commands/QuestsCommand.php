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

class QuestsCommand extends PluginCommand {

    public function __construct(Loader $plugin) {
        parent::__construct("quests", $plugin);
        $this->setDescription("Quests Command");
        $this->setPermission("castleraid.quests");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if ($this->testPermission($sender) and $sender instanceof Player) {
            $sender->sendMessage(TextFormat::RED . "Coming Soon");
        }
    }
}