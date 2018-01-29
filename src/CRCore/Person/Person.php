<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Jason.
 */
declare(strict_types=1);
namespace CRCore;

use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\network\SourceInterface;
use onebone\economyapi\EconomyAPI;

class Person extends Player{
  
    //TODO: Learn SQL.
  
    /** @var Config $cfg */
    private $cfg;
    
    public function __construct(SourceInterface $interface, $clientID, string $ip, int $port){
        parent::__construct($interface, $clientID, $ip, $port);
    }
    
    public function genCfg() : void{
        if(file_exists(API::$main->getDataFolder() . "/players/" . $this->getName() . ".json")){
            $this->cfg = new Config(API::$main->getDataFolder() . "/players/" . $this->getName() . ".json", Config::JSON);
        }else{
            $this->cfg = new Config(API::$main->getDataFolder() . "/players/" . $this->getName() . ".json", Config::JSON, ["mails" => []]);
        }
    }
  
    public function getMoney() : float{
        return EconomyAPI::getInstance()->myMoney($this->getName());
    }
  
    public function getMails() : array{
        return $this->cfg->get("mails");
    }
}
