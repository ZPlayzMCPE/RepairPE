<?php

namespace RepairPE;

use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\item\item;
use pocketmine\inventory\inventory;
use pocketmine\inventory\ArmourInventory;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {
    
public function onEnable(){
    $this->getLogger()->info("Plugin has been enabled. Let the repairing begin!");
}
public function onDisable(){
    $this->getLogger()->info("Plugin has been disabled. Did the server stop?");
}
public function onCommand(CommandSender $sender, Command $command, string $labal, array $args) : bool{
    if(strtolower($command->getName()) == "repair") {
        if($sender->hasPermission("repair.use")){
        if(!isset($args[0])){
            $sender->sendMessage(TextFormat::GOLD . "Please use /repair all|hand");
           return true;
       }
if ($args[0] == "all") {
    if ($sender->hasPermission("repair.all")){
    if (!$sender instanceof Player) {
            $sender = getInventory()->getContents();
            
            foreach($sender->getInventory()->getContents() as $i => $item){
            $item->setDamage(0);
            $sender->sendMessage(TextFormat::GREEN . "You have repaired everything in your inventory.");
            return true;
            }
            $sender = getArmorInventory()->getContents();
    }
    foreach($sender->getArmorInventory()->getContents() as $i => $item){
            $sender->sendMessage(TextFormat:: GREEN . "Including your equipped armour.");
            return true;
    }
    if ($args[0] == "hand") {
                   if ($sender->hasPermission("repair.hand")) {
                       if ($sender instanceof Player) {
                           $sender->getInventory()->getItemInHand()->setDamage(0, true);
                           $sender->getInventory()->setItem($i, $item, true);
                           $sender->sendMessage(TextFormat::GREEN . "The item named $item has been repaired succesfully.");
                        }
                    }
                    return true;
                }
            }
        }
        return true;
    }
}
   
