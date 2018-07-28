<?php


namespace Muhammed0232\BUHC;

use pocketmine\plugin\PluginBase;
use pocketmine\command\{Command, CommandSender};
use pocketmine\event\Listener;
use pocketmine\{Player, Server};
use pocketmine\level\{Position, Level};
use pocketmine\math\Vector3;
use pocketmine\event\player\{PlayerDeathEvent, PlayerInteractEvent};
use pocketmine\utils\Config;
use pocketmine\item\Item;
use pocketmine\item\enchantment\{Encahntment, EnchantmentInstance};

class Base extends PluginBase implements Listener{
	
	
	
	public function onEnable(){
		$this->getLogger()->info("§6» §bLoading BuildUHC\n   §6» §bLoad Complate All Arenas \n  §6» §bCoding by Muhammed0232");
		@mkdir($this->getDataFolder());
		@mkdir($this->getDataFolder()."Arenas/");
		        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		        
 
		$this->prefix = "§c[§aBuild§eUHC§c]";
	}
	
	
	
	public function onCommand(CommandSender $g, Command $kmt, string $label, array $args): bool{
		
		if($kmt->getName() == "buhc"){
			
			if(empty($args[0]) && empty($args[1])){
				$g->sendMessage("§c--==".$this->prefix."§c==--");
				$g->sendMessage("§a/buhc make <arenaname>: §cCreate Builduhc Arena");
				$g->sendMessage("§a/buhc join <arenaname>: §cJoin Builduhc Arena");
				return false;
			}
			
			if($args[0] == "make"){
				$aname = $args[1];
				
				if($g->hasPermission("buhc.command.make")){
					
				if(!file_exists($this->getDataFolder()."Arenas/$aname.yml")){
					
				$cfg = new Config($this->getDataFolder()."Arenas/$aname.yml", Config::YAML);
				
				
				$cfg->set("Dunya", $g->getLevel()->getFolderName());
				$cfg->set("Durum", "Kurulum1");
				$cfg->set("kurulumyapan", $g->getName());
				$cfg->save();
				$g->sendMessage($this->prefix." §6» §7You Are Now Setup Mode \n §bPlease Click Blue Team Spawn");
				
				
				
				}else{
					$g->sendMessage($this->prefix." §4Arena Exists");
				}
				
				
				
			}else{
				$g->sendMessage($this->prefix." You Have Don't Permissison");
			}
			
			
		}elseif($args[0] == "join"){
			
			$aname = $args[1];
							if($g->hasPermission("buhc.command.join")){
					
				if(file_exists($this->getDataFolder()."Arenas/$aname.yml")){
					
							$cfg = new Config($this->getDataFolder()."Arenas/$aname.yml", Config::YAML);
							
							
							if($cfg->get("Durum") == "Aktif"){
								
								$cfg->set("Oyuncu1", $g->getName());
								$cfg->set("Durum", "Aktif2");
										$cfg->save();
										
								$g->sendMessage($this->prefix." §6» §bYou Joinend Arena \n".$this->prefix." §6» §bWait To 1 Players");
								
								
							}elseif($cfg->get("Durum") == "Aktif2"){
								
								$cfg->set("Oyuncu2", $g->getName());
								$cfg->set("Durum", "Dolu");
								$cfg->save();
								$this->arenaBaslat($cfg);
								
							}else{
								$g->sendMessage($this->prefix." §4Arena Full");
							}
	
			
		}else{
			$g->sendMessage($this->prefix." §4Arena Not Found");
		}
		
		
	}else{
		$g->sendMessage($this->prefix." You Have Don't Permission");
    	}
   }
 }
 return true;
}



   public function arenaBaslat($cfg){
   	$oyuncu1 = $cfg->get("Oyuncu2");
   	$oyuncu2 = $cfg->get("Oyuncu1");
   	$dunya = $cfg->get("Dunya");
   	
   	$o1 = $this->getServer()->getPlayer($oyuncu1);
   	$o2 = $this->getServer()->getPlayer($oyuncu2);
   	
   	if($o1 instanceof Player && $o2 instanceof Player){
     $this->getServer()->loadLevel($dunya);
     $dnya = $this->getServer()->getLevelByName($dunya);
 
     $x = $cfg->get("Oyuncu1X");
     $y = $cfg->get("Oyuncu1Y");
     $z = $cfg->get("Oyuncu1Z");
     $x2 = $cfg->get("Oyuncu2X");
     $y2 = $cfg->get("Oyuncu2Y");
     $z2 = $cfg->get("Oyuncu2Z");
                        
   	$o1->teleport(new Vector3($x, $y, $z, $dnya));
   	
    	$o2->teleport(new Vector3($x2, $y2, $z2, $dnya));
   	
   	
   	
   $o1->sendMessage($this->prefix." §aGame Started");
   $o2->sendMessage($this->prefix." §aGame Started");
   
   
   $o1->setHealth(20);
   $o1->setFood(20);
   $o1->getInventory()->clearAll();
  
   $o2->setHealth(20);
   $o2->setFood(20);
   $o2->getInventory()->clearAll();
   $this->kitVer($o1, $o2);
     }
    }
    
    
 public function kitVer($o1, $o2){
 	   $o2env = $o2->getInventory();
   $o1env = $o1->getInventory();
   
   $o1env->addItem(Item::get(276,0,1));
   $o1env->addItem(Item::get(278,0,1));
   $o1env->addItem(Item::get(279,0,1));
   $o1env->addItem(Item::get(276,0,1));
   $o1env->addItem(Item::get(346,0,1));
   $o1env->addItem(Item::get(310,0,1));
   $o1env->addItem(Item::get(311,0,1));
   $o1env->addItem(Item::get(312,0,1));
   $o1env->addItem(Item::get(313,0,1));
   $o1env->addItem(Item::get(297,0,10));
   $o1env->addItem(Item::get(259,0,1));
   $o1env->addItem(Item::get(322,0,1));
   
   $o2env->addItem(Item::get(276,0,1));
   $o2env->addItem(Item::get(278,0,1));
   $o2env->addItem(Item::get(279,0,1));
   $o2env->addItem(Item::get(276,0,1));
   $o2env->addItem(Item::get(346,0,1));
   $o2env->addItem(Item::get(310,0,1));
   $o2env->addItem(Item::get(311,0,1));
   $o2env->addItem(Item::get(312,0,1));
   $o2env->addItem(Item::get(313,0,1));
   $o2env->addItem(Item::get(297,0,10));
   $o2env->addItem(Item::get(259,0,1));
   $o2env->addItem(Item::get(322,0,1));
   
 }
   }
?>
