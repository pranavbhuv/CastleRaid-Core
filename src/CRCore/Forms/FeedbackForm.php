<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\Forms;

use CRCore\API;
use pocketmine\form\CustomForm;
use pocketmine\form\Form;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class FeedbackForm extends CustomForm{

    private $data;

    const FEEDBACK_PREFIX = TextFormat::BLUE . "Feedback" . "> " . TextFormat::WHITE;

    public function __construct(string $title, $elements){
        parent::__construct($title, $elements);
    }

    public function onSubmit(Player $player) : ?Form{
        $f = fopen(API::$main->getDataFolder() . "/feedback/" . $player->getName() . ".txt", "a");
        fwrite($f, $this->data[0]."\n");
        fclose($f);
        $player->sendMessage(FeedbackForm::FEEDBACK_PREFIX . TextFormat::GREEN . "Thanks for your feedback! Our developers will take a look to it ASAP.");
        return null;
    }

    public function handleResponse(Player $player, $data) : ?Form{
        $this->data = $data;
        return parent::handleResponse($player, $data);
    }
}