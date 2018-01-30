<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Jason.
 */

namespace CRCore\Commands;

use CRCore\API;
use CRCore\Forms\MailForm;
use CRCore\Forms\SeeMailForm;
use CRCore\Forms\SendMailForm;
use CRCore\Loader;
use CRCore\Person\Person;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\form\element\Input;
use pocketmine\utils\TextFormat;

class MailCommand extends PluginCommand{
    private $sender;

    public function __construct(Loader $owner){
        parent::__construct("seemails", $owner);
        $this->setAliases(["seemail"]);
        $this->setDescription("Send mails and stuff.");
        $this->setPermission("castleraid.mail");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        $this->sender = $sender;
        if($sender->hasPermission("castleraid.mail")){
            if($sender instanceof Person){
            	if($args[0] === "see"){
	               $sender->sendForm($this->makeSeeForm());
               }elseif($args[0] === "send"){
            		$sender->sendForm($this->makeSendForm());
               }


            }else{
                $sender->sendMessage(API::NOT_PLAYER);
            }
        }else{
            $sender->sendMessage(API::NO_PERMISSION);
        }
    }

    public function makeSeeForm() : SeeMailForm{
        if($this->sender instanceof Person){
            $mails = [];
            foreach($this->sender->getMails() as $mail){
                array_push($mails, new Button$mail);
            }
        }
        $f = new SeeMailForm(TextFormat::BLUE . "Mails", );
        return $f;
    }

    public function makeSendForm() : SendMailForm{

    }

}