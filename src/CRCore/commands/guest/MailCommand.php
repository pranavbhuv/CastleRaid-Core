<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\commands\guest;

use CRCore\API;
use CRCore\Commands\BaseCommand;
use CRCore\Forms\mail\DeleteAllMailsForm;
use CRCore\Forms\mail\ListMailsForm;
use CRCore\Forms\mail\SendMailForm;
use CRCore\Loader;
use CRCore\person\Mail;
use CRCore\person\Person;
use pocketmine\command\CommandSender;
use pocketmine\form\element\Input;
use pocketmine\form\MenuOption;
use pocketmine\utils\TextFormat;

class MailCommand extends BaseCommand{
    
    private $sender;

    public function __construct(Loader $owner){
        parent::__construct($owner, "mails", "Send mails and stuff.", "Usage: /mail list|send|deleteall", ["mail"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        $this->sender = $sender;
        if(!$sender instanceof Person){
            $sender->sendMessage(API::NOT_PLAYER);
            return false;
        }

        if(!$sender->hasPermission("castleraid.mail")){
            $sender->sendMessage(parent::NO_PERMISSION);
            return false;
        }

        if(!isset($args[0])){
            $sender->sendMessage($this->getUsage());
            return false;
        }

        switch($args[0]){
            case "cleanup":
            case "dl":
            case "delete":
            case "dlall":
            case "deleteall":
                $sender->cfg->reload();
                if(empty($sender->getMails())){
                    $sender->sendMessage(Mail::prefix . TextFormat::RED . "You have no mails to clean up!");
                    return false;
                }
                $sender->sendForm($this->makeDeleteForm());
                return true;
                break;
            case "ls":
            case "see":
            case "list":
                $sender->cfg->reload();
                if(!empty($sender->getMails())){
                    $sender->sendForm($this->makeListForm());
                    return true;
                }else{
                    $sender->sendMessage(Mail::prefix . TextFormat::RED . "You have no mails! #DontWorryIGotNoFriendsEither");
                    return true;
                }
                break;
            case "send":
                $sender->sendForm($this->makeSendForm());
                return true;
                break;
            default:
                $sender->sendMessage($this->getUsage());
                return false;
        }
    }

    public function makeListForm() : ListMailsForm{
	    $mails = [];
        if($this->sender instanceof Person){
            foreach($this->sender->getMails() as $m){
                array_push($mails, new MenuOption(API::getRandomColor() . "#" . $m["id"] . TextFormat::WHITE . " from " . TextFormat::DARK_AQUA . $m["sender"]));
            }
        }
        $f = new ListMailsForm(TextFormat::BLUE . "Mails", TextFormat::YELLOW . "Pick the mail you want to see.", $mails);
        return $f;
    }

    public function makeSendForm() : SendMailForm{
        $names = ["QuiverlyRivalry", "NickTehUnicorn", "iiFlamiinBlaze", "Teamblocket", "PotatoTheDev", "jasonwynn10", "Donald Trump", "Hillary Clinton", "Oliver Queen"];
        $msgshint = ["I hate you.", "You're ugly.", "Do you even lift?", "It is wednesday my dude.", "Follow me on Twitter.", "I'll have what she's having.", "You have failed this city.", "Hello darkness my old friend", "NO! DON'T TOUCH THAT!", "May the force be with you.", "Frankly, my dear, I don't give a damn.", "FR E SH A VOCA DO"];
        $targetinput = new Input(TextFormat::GOLD . "Who is this mail to?", $names[array_rand($names)]);
        $messageinput = new Input(TextFormat::GOLD . "Enter your message here.", $msgshint[array_rand($msgshint)]);
        $f = new SendMailForm(API::getRandomColor() . "Send Mail", [$targetinput, $messageinput]);
        return $f;
    }

    public function makeDeleteForm() : DeleteAllMailsForm{
        $f = new DeleteAllMailsForm(TextFormat::DARK_RED . "Cleanup Mailbox", TextFormat::RED . "Are you sure you want to delete all your mails?", TextFormat::RED . ["Yeah, delete them all please kthx.", "Yes"][mt_rand(0, 1)], TextFormat::DARK_GREEN . ["No", "Nope"][mt_rand(0, 1)]);
        return $f;
    }
}
