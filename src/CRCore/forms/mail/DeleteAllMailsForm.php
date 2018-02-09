<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\forms\mail;

use CRCore\person\Person;
use pocketmine\form\Form;
use pocketmine\form\ModalForm;
use pocketmine\Player;

class DeleteAllMailsForm extends ModalForm{

    public function onSubmit(Player $player) : ?Form{
        if($this->getChoice() !== true) return null;
        if(!$player instanceof Person) return null;

        $player->deleteAllMails();
        return null;
    }
}
