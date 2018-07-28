<?php

namespace Muhammed0232\BUHC;

use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerInteractEvent;

class EventListener implements Listener{


 /* __construct */
     public function __construct(Base $plugin){
        $this->p = $plugin;
    }


  /* events */

	public function olum(PlayerDeathEvent $e){
		
		$olen = $e->getPlayer();
		$olduren = $olen->getDamageCause();
		$oldurenisim = $olduren->getName();
		$olenisim = $olen->getName();
		$olendunya = $olen->getLevel();
		$olendunyaismi = $olendunya->getName();
		
		     if(!file_exists($this->p->getDataFolder()."Arenas/$olendunyaismi.yml")){
 
		$cfg = new Config($this->p->getDataFolder()."Arenas/$olendunyaismi.yml", Config::YAML);
		
  if($cfg->get("Oyuncu1") == $olenisim){
  	$cfg->set("Oyuncu1", 0);
  	$cfg->set("Oyuncu1", 0);
  	
  	
   	$this->p->getServer()->broadcastMessage($this->p->prefix." �b".$olenisim." Killed By".$oldurenisim."And ".$oldurenisim."Won The BuildUHC arena ");
  	
  	
          $olen->teleport($this->getServer()->getDefaultLevel()->getSafeSpawn(),0,0);
          $olduren->teleport($this->getServer()->getDefaultLevel()->getSafeSpawn(),0,0);
                      
  	$cfg->save();
  
  }elseif($cfg->get("Oyuncu2") == $olenisim){
  	  	$cfg->set("Oyuncu2", 0);
  	$cfg->set("Oyuncu2", 0);
  	

  	      	
   	$this->p->getServer()->broadcastMessage($this->p->prefix." �b".$olenisim." Killed By".$oldurenisim."And ".$oldurenisim."Won The BuildUHC arena ");
  	
  	          $olen->teleport($this->getServer()->getDefaultLevel()->getSafeSpawn(),0,0);
          $olduren->teleport($this->getServer()->getDefaultLevel()->getSafeSpawn(),0,0);
  	$cfg->save();
  }
	}
}
	
	
	public function kurulum(PlayerInteractEvent $e){
		$o = $e->getPlayer();
		$isim = $o->getName();
		$blok = $e->getBlock();
		$x = $blok->getX();
		$y = $blok->getY();
		$z = $blok->getZ();
	 $dunya = $o->getLevel()->getFolderName();
		
		if(file_exists($this->p->getDataFolder()."Arenas/".$dunya.".yml")){
			$cfg = new Config($this->p->getDataFolder()."Arenas/$dunya.yml", Config::YAML);
			if($cfg->get("kurulumyapan") == $isim){
				
				if($cfg->get("Durum") == "Kurulum1"){
					
					$cfg->set("Oyuncu1X", $x);
					$cfg->set("Oyuncu1Y", $y);
					$cfg->set("Oyuncu1Z", $z);
					$cfg->set("Durum", "Kurulum2");
					$cfg->save();
   $o->sendMessage($this->p->prefix." Pls Click Red Team Spawn");
					
					
				}elseif($cfg->get("Durum") == "Kurulum2"){
					
					$cfg->set("Oyuncu2X", $x);
					$cfg->set("Oyuncu2Y", $y);
					$cfg->set("Oyuncu2Z", $z);
					$cfg->set("Durum", "Aktif");
					$cfg->save();

					$o->sendMessage("Arena Setup Finish ????");
					
				}
			}
		}
	}
	
}
