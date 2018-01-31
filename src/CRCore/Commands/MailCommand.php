<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors     : QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Jason.
 */

namespace CRCore\Commands;

use CRCore\API;
use CRCore\Forms\ListMailsForm;
use CRCore\Forms\MailForm;
use CRCore\Forms\SendMailForm;
use CRCore\Loader;
use CRCore\Person\Person;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\form\element\Input;
use pocketmine\form\MenuOption;
use pocketmine\utils\TextFormat;

class MailCommand extends PluginCommand{
    private $sender;

    public function __construct(Loader $owner){
        parent::__construct("mails", $owner);
        $this->setAliases(["mail"]);
        $this->setUsage("Usage: /mail list|send");
        $this->setDescription("Send mails and stuff.");
        $this->setPermission("castleraid.mail");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        $this->sender = $sender;
        if($sender->hasPermission("castleraid.mail")){
            if($sender instanceof Person){
                if($args[0] === "list" || $args[0] === "see"){
                    if(!is_null($sender->getMails())){
                        $sender->sendMessage(TextFormat::RED . "You have no mails! #DontWorryIGotNoFriendsEither");
                    }else{
                        $sender->sendForm($this->makeListForm());
                    }
                }elseif($args[0] === "send"){
                    $sender->sendForm($this->makeSendForm());
                }else{
                    $sender->sendMessage($this->getUsage());
                }
            }else{
                $sender->sendMessage(API::NOT_PLAYER);
            }
        }else{
            $sender->sendMessage(API::NO_PERMISSION);
        }
    }

    public function makeListForm() : ListMailsForm{
        if($this->sender instanceof Person){
            $mails = [];
            foreach($this->sender->getMails() as $m){
                array_push($mails, new MenuOption(API::getRandomTextFormat() . "#" . $m["id"] . TextFormat::WHITE . "from " . TextFormat::DARK_AQUA . $m["sender"]));
            }
        }
        $f = new ListMailsForm(TextFormat::BLUE . "Mails", "Pick the mail you want to see.", $mails);
        return $f;
    }

    public function makeSendForm() : SendMailForm{
        $targetinput = new Input(TextFormat::GOLD . "Who is this mail to?");
        $messageinput = new Input(TextFormat::GOLD . "Enter your message here.");
        $f = new SendMailForm(TextFormat::DARK_RED . "Send Mail", [$targetinput, $messageinput]);
        return $f;
    }
}