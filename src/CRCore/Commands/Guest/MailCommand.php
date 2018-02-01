<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */

namespace CRCore\Commands\Guest;

use CRCore\API;
use CRCore\Commands\BaseCommand;
use CRCore\Forms\ListMailsForm;
use CRCore\Forms\SendMailForm;
use CRCore\Loader;
use CRCore\Person\Person;
use pocketmine\command\CommandSender;
use pocketmine\form\element\Input;
use pocketmine\form\FormIcon;
use pocketmine\form\MenuOption;
use pocketmine\utils\TextFormat;

class MailCommand extends BaseCommand{
    private $sender;

    public function __construct(Loader $owner){
        parent::__construct($owner, "mails", "Send mails and stuff.", "/mail list|send", ["mail"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        $this->sender = $sender;
        if(!$sender instanceof Person){
            $sender->sendMessage(API::NOT_PLAYER);
            return false;
        }

        if(!$sender->hasPermission("castleraid.feedback")){
            $sender->sendMessage(parent::NO_PERMISSION);
            return false;
        }

        if(!isset($args[0])){
            $sender->sendMessage($this->getUsage());
            return false;
        }

        switch($args[0]){
            case "see":
            case "list":
                if(!empty($sender->getMails())){
                    $sender->sendForm($this->makeListForm());
                    return true;
                }else{
                    $sender->sendMessage(TextFormat::RED . "You have no mails! #DontWorryIGotNoFriendsEither");
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
        if($this->sender instanceof Person){
            $mails = [new MenuOption("Test", new FormIcon("http://www.iralovestolaugh.com/wp-content/uploads/2015/08/Orange-Star-Icon-300x277.png"))];
            foreach($this->sender->getMails() as $m){
                array_push($mails, new MenuOption(API::getRandomTextFormat() . "#" . $m["id"] . TextFormat::WHITE . "from " . TextFormat::DARK_AQUA . $m["sender"]));
            }
        }
        $f = new ListMailsForm(TextFormat::BLUE . "Mails", "Pick the mail you want to see.", $mails);
        return $f;
    }

    public function makeSendForm() : SendMailForm{
        $names = ["QuiverlyRivalry", "NickTehUnicorn", "iiFlamiinBlaze", "Teamblocket", "PotatoTheDev"];
        $msgshint = ["I hate you.", "You're ugly.", "Do you even lift?", "Do you know de wae?", "The ting goes skrrra.", "It is wednesday my dude.", "Follow me on Twitter."];
        $targetinput = new Input(TextFormat::GOLD . "Who is this mail to?", $names[array_rand($names)]);
        $messageinput = new Input(TextFormat::GOLD . "Enter your message here.", $msgshint[array_rand($msgshint)]);
        $f = new SendMailForm(TextFormat::DARK_RED . "Send Mail", [$targetinput, $messageinput]);
        return $f;
    }
}