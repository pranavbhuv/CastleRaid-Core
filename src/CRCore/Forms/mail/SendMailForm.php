<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */

namespace CRCore\Forms\mail;

use CRCore\API;
use CRCore\Person\Mail;
use CRCore\Person\Person;
use pocketmine\form\CustomForm;
use pocketmine\form\Form;
use pocketmine\OfflinePlayer;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class SendMailForm extends CustomForm{
    /** @var array $data */
    private $data;

    public function onSubmit(Player $player) : ?Form{
        if(!$player instanceof Person) return null;
        if(is_null($this->data)) return null;

        if(!file_exists(API::$main->getDataFolder() . "/players/" . strtolower($this->data[0]) . ".json")){
            $player->sendMessage(Mail::prefix . TextFormat::RED . "Player " . TextFormat::DARK_RED . $this->data[0] . TextFormat::RED . " has never been here.");
            return null;
        }
        $person = API::$main->getServer()->getPlayer($this->data[0]);
        if($person instanceof Person){
            $person->addMail(new Mail($player, date("F j, Y, g:i a"), $this->data[1], count($person->getMails()) + 1));
            $person->sendPopup("You got new mail biatch", "subtitle");
            $player->sendMessage(Mail::prefix . TextFormat::GREEN . "Successfully sent mail to player " . TextFormat::YELLOW . $this->data[0] . TextFormat::GREEN . "!");
            $person->cfg->save();
            return null;
        }
        $offlineplayer = API::$main->getServer()->getOfflinePlayer($this->data[0]);
        if($offlineplayer instanceof OfflinePlayer){
            $cfg = new Config(API::$main->getDataFolder() . "/players/" . $offlineplayer->getName() . ".json");
            $mail = new Mail($player, date("F j, Y, g:i a"), $this->data[1], count($cfg->get("mails")) + 1);
            $arr = ["id" => $mail->getId(), "sender" => $mail->getSender()->getName(), "date" => $mail->getDate(), "message" => $mail->getMsg()];
            $mails = $cfg->get("mails");
            array_push($mails, $arr);
            $cfg->set("mails", $mails);
            $cfg->save();
            $player->sendMessage(Mail::prefix . TextFormat::GREEN . "Successfully sent mail to offline player " . TextFormat::GOLD . $this->data[0] . TextFormat::GREEN . "!");
            return null;
        }
        $player->sendMessage("Oh god. One of our devs (Nick) wrote something wrong. Sorry. Contact Unickorn#8830 on discord or @NickTehUnicorn on twitter. Or just leave a message to our discord.");
        return null;
    }

    public function handleResponse(Player $player, $data) : ?Form{
        $this->data = $data;
        return parent::handleResponse($player, $data);
    }
}