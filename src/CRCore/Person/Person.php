<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\Person;

use CRCore\API;
use onebone\economyapi\EconomyAPI;
use pocketmine\network\SourceInterface;
use pocketmine\Player;
use pocketmine\utils\Config;

class Person extends Player{

    //TODO: Learn SQL.

    /** @var Config $cfg */
    public $cfg;

    public function __construct(SourceInterface $interface, $clientID, string $ip, int $port){
        parent::__construct($interface, $clientID, $ip, $port);
    }

    public function genCfg() : void{
        if(file_exists(API::$main->getDataFolder() . "/players/" . strtolower($this->getName()) . ".json")){
            $this->cfg = new Config(API::$main->getDataFolder() . "/players/" . strtolower($this->getName()) . ".json", Config::JSON);
        }else{
            $this->cfg = new Config(API::$main->getDataFolder() . "/players/" . strtolower($this->getName()) . ".json", Config::JSON, ["mails" => []]);
        }
    }

    public function getMoney() : float{
        return EconomyAPI::getInstance()->myMoney($this->getName());
    }

    public function getMails() : array{
        return $this->cfg->get("mails");
    }

    public function getMailById(int $id) : ?Mail{
        foreach($this->getMails() as $m){
            if($m["id"] === $id){
                return $m;
            }
        }
        return null;
    }

    public function addMail(Mail $mail) : void{
        $this->cfg->set("mails"[$mail->getId()], ["id" => $mail->getId(), "sender" => $mail->getSender()->getName(), "date" => $mail->getDate(), "message" => $mail->getMsg()]);
        //$mails[$mail->getId()] = ["id" => $mail->getId(), "sender" => $mail->getSender()->getName(), "date" => $mail->getDate(), "message" => $mail->getMsg()];
        $this->cfg->save();
    }
}
