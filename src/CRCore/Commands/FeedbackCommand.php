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


use CRCore\API;
use CRCore\Forms\FeedbackForm;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\form\element\Input;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat;

class FeedbackCommand extends PluginCommand {

    public function __construct(string $name, Plugin $owner) {
        parent::__construct("feedback", $owner);
        $this->setAliases(["error", "suggest", "fb", "bug"]);
        $this->setDescription("Give us feedback or report bugs!");
        $this->setPermission("castleraid.feedback");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if ($sender->hasPermission("castleraid.feedback")) {
            if ($sender instanceof Player) {
                $sender->sendForm($this->makeForm());
            } else {
                $sender->sendMessage(API::NOT_PLAYER);
            }
        } else {
            $sender->sendMessage(API::NO_PERMISSION);
        }
    }

    public function makeForm(): FeedbackForm {
        $f = new FeedbackForm(TextFormat::BLUE . "Feedback", [new Input("Write your feedback/suggestion/bug report here!", "Vaults don't work.")]);
        return $f;
    }
}
