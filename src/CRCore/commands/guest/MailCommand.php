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
use CRCore\Loader;
use CRCore\person\Mail;
use CRCore\person\Person;
use jojoe77777\FormAPI\FormAPI;
use pocketmine\command\CommandSender;
use pocketmine\OfflinePlayer;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class MailCommand extends BaseCommand{

    private $sender;

    public function __construct(Loader $owner){
        parent::__construct($owner, "mails", "Send mails and stuff.", TextFormat::RED . "Usage: /mail list|send|deleteall", ["mail", "m"]);
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
                $this->sendDeleteForm($sender);
                return true;
            case "ls":
            case "see":
            case "list":
                $sender->cfg->reload();
                if(!empty($sender->getMails())){
                    $this->sendListForm($sender);
                    return true;
                }else{
                    $sender->sendMessage(Mail::prefix . TextFormat::RED . "You have no mails! #DontWorryIGotNoFriendsEither");
                    return true;
                }
            case "send":
                $this->sendSendForm($sender);
                return true;
            default:
                $sender->sendMessage($this->getUsage());
                return false;
        }
    }

    public function sendListForm(Person $person) : void{
        /** @var FormAPI $api */
        $api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Person $person, ?string $data){
            if(!isset($data)) return;
            $this->sendSeeForm($person, intval($data));
        });
        $form->setTitle(TextFormat::BLUE . "Mails");
        $form->setContent(TextFormat::YELLOW . "Pick the mail you want to see.");
        foreach($person->getMails() as $m){
            $form->addButton(API::getRandomColor() . "#" . $m["id"] . TextFormat::WHITE . " from " . TextFormat::DARK_AQUA . $m["sender"], -1, "", strval($m["id"]));
        }
        $form->sendToPlayer($person);
    }

    public function sendSendForm(Person $person) : void{
        $names = ["QuiverlyRivalry", "NickTehUnicorn", "iiFlamiinBlaze", "uselesswaifu", "Angel", "PotatoTheDev", "jasonwynn10", "Donald Trump", "Hillary Clinton", "Justin Timberlake"];
        $msgshint = ["I hate you.", "You're ugly.", "Do you even lift?", "It is wednesday my dude.", "Follow me on Twitter.", "I'll have what she's having.", "You have failed this city.", "Hello darkness my old friend", "NO! DON'T TOUCH THAT!", "May the force be with you.", "Frankly, my dear, I don't give a damn.", "FR E SH A VOCA DO"];
        /** @var FormAPI $api */
        $api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createCustomForm(function (Person $player, ?array $data){
            if(!isset($data)) return;

            if(!file_exists(API::$main->getDataFolder() . "/players/" . strtolower($data[0]) . ".json")){
                $player->sendMessage(Mail::prefix . TextFormat::RED . "Player " . TextFormat::DARK_RED . $data[0] . TextFormat::RED . " has never been here.");
                return;
            }
            $person = API::$main->getServer()->getOfflinePlayer($data[0]);
            if($person instanceof Person){
                $person->addMail(new Mail($player, date("F j, Y, g:i a"), $data[1], count($person->getMails()) + 1));
                $person->sendPopup(TextFormat::YELLOW . "You got a new mail from " . API::getRandomColor() . $player->getName(), TextFormat::GREEN . "Use /mail list!");
                $player->sendMessage(Mail::prefix . TextFormat::GREEN . "Successfully sent mail to player " . TextFormat::YELLOW . $data[0] . TextFormat::GREEN . "!");
                $person->cfg->save();
                return;
            }
            if($person instanceof OfflinePlayer){
                $cfg = new Config(API::$main->getDataFolder() . "/players/" . $person->getName() . ".json");
                $mail = new Mail($player, date("F j, Y, g:i a"), $data[1], count($cfg->get("mails")) + 1);
                $arr = ["id" => $mail->getId(), "sender" => $mail->getSender()->getName(), "date" => $mail->getDate(), "message" => $mail->getMsg()];
                $mails = $cfg->get("mails");
                array_push($mails, $arr);
                $cfg->set("mails", $mails);
                $cfg->save();
                $player->sendMessage(Mail::prefix . TextFormat::GREEN . "Successfully sent mail to offline player " . TextFormat::GOLD . $data[0] . TextFormat::GREEN . "!");
                return;
            }
            $player->sendMessage("Oh god. One of our devs (Nick) wrote something wrong. Sorry. Contact Unickorn#8830 on discord or @NickTehUnicorn on twitter. Or just leave a message to our discord.");
            return;
        });
        $form->setTitle(API::getRandomColor() . "Send Mail");
        $form->addInput(TextFormat::GOLD . "Who is this mail to?", $names[array_rand($names)]);
        $form->addInput(TextFormat::GOLD . "Enter your message here.", $msgshint[array_rand($msgshint)]);
        $form->sendToPlayer($person);
    }

    public function sendDeleteForm(Person $person) : void{
        /** @var FormAPI $api */
        $api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Person $player, ?bool $data){
            if(!isset($data)) return;
            if($data != true) return;
            $player->deleteAllMails();
        });
        $form->setTitle(TextFormat::DARK_RED . "Cleanup Mailbox");
        $form->setContent(TextFormat::RED . "Are you sure you want to delete all your mails?");
        $form->setButton1(TextFormat::RED . ["Yeah, delete them all please kthx.", "Yes"][mt_rand(0, 1)]);
        $form->setButton2(TextFormat::DARK_GREEN . ["No", "Nope"][mt_rand(0, 1)]);
        $form->sendToPlayer($person);
    }

    public function sendSeeForm(Person $person, int $mailid) : void{
        $m = $person->getMailById($mailid);
        /** @var FormAPI $api */
        $api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createCustomForm(function (Person $player, ?array $data){
        });
        $form->setTitle("Showing mail with id " . TextFormat::BOLD . $m["id"]);
        $form->addLabel("From: " . TextFormat::GREEN . $m["sender"] . TextFormat::WHITE . "\n"
                                . "Date & Time: " . TextFormat::AQUA . $m["date"] . TextFormat::WHITE . "\n\n"
                                . "Message: " . TextFormat::YELLOW . $m["message"]);
        $form->sendToPlayer($person);
    }

}
