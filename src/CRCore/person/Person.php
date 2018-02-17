<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\person;

use CRCore\API;
use onebone\economyapi\EconomyAPI;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class Person extends Player{

    //TODO: Learn SQL.

    /** @var Config $cfg */
    public $cfg;

    public function genCfg() : void{
        if(file_exists(API::$main->getDataFolder() . "/players/" . strtolower($this->getName()) . ".json")){
            $this->cfg = new Config(API::$main->getDataFolder() . "/players/" . strtolower($this->getName()) . ".json", Config::JSON);
        }else{
            $this->cfg = new Config(API::$main->getDataFolder() . "/players/" . strtolower($this->getName()) . ".json", Config::JSON, ["mails" => []]);
        }
    }

    public function getMoney() : float{
        return EconomyAPI::getInstance()->myMoney($this);
    }

    public function addMoney(float $amount) : void{
        EconomyAPI::getInstance()->addMoney($this, $amount);
    }

    public function reduceMoney(float $amount) : void{
        EconomyAPI::getInstance()->reduceMoney($this, $amount);
    }

    public function getMails() : array{
        $this->cfg->reload();
        return $this->cfg->get("mails");
    }

    public function getMailById(int $id) : ?array{
        foreach($this->getMails() as $m){
            if($m["id"] === $id){
                return $m;
            }
        }
        return null;
    }

    public function addMail(Mail $mail) : void{
        $mails = $this->cfg->get("mails");
        $nm = ["id" => $mail->getId(), "sender" => $mail->getSender()->getName(), "date" => $mail->getDate(), "message" => $mail->getMsg()];
        array_push($mails, $nm);
        $this->cfg->set("mails", $mails);
        $this->cfg->save();
    }

    public function deleteAllMails() : void{
        $this->cfg->set("mails", []);
        $this->cfg->save();
        $this->sendMessage(Mail::prefix . TextFormat::GREEN . "Your mailbox has been successfully cleared!");
    }
}
