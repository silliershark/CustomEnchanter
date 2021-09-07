<?php

namespace Vqnic\CustomEnchanter\CEs\Weapons;

use pocketmine\entity\Entity;
use pocketmine\nbt\tag\ByteArrayTag;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\Player;

use Vqnic\CustomEnchanter\Entities\PlagueSkull;
use Vqnic\CustomEnchanter\Main;

class Plague extends WeaponCE{

    /*
     *  PLAGUE
     *  MAXIMUM LEVEL : 4
     *  CHANCE: 2%
     *  DESCRIPTION: Spawns a giant skull that gives lethal poison and heavy damage to nearby enemies, and despawns after some seconds.
     *               For each level, the skull lasts longer by two seconds. The skull, by the default level, lives for four seconds.
     */


    private int $CElevel;
    private Player $attacker;
    private Player $victim;

    function __construct($l, $a, $v){
        $this->CElevel = $l;
        $this->attacker = $a;
        $this->victim = $v;
    }

    public function trigger(){
        if(mt_rand(1, 100) <= 2){ // 2% chance
            //SPAWN ENTITY WITH ONE PARAMETER BEING THE LEVEL
            //Code below copied from github.com/xXKHaLeD098Xx/SpinningCoin
            $nbt = Entity::createBaseNBT($this->attacker->getPosition());
            $path = Main::getMain()->getDataFolder() . "/PlagueSkull/texture.png";
            $img = @imagecreatefrompng($path);
            $skinbytes = "";
            $s = (int)@getimagesize($path)[1];
            for($y = 0; $y < $s; $y++) {
                for($x = 0; $x < 64; $x++) {
                    $colorat = @imagecolorat($img, $x, $y);
                    $a = ((~((int)($colorat >> 24))) << 1) & 0xff;
                    $r = ($colorat >> 16) & 0xff;
                    $g = ($colorat >> 8) & 0xff;
                    $b = $colorat & 0xff;
                    $skinbytes .= chr($r) . chr($g) . chr($b) . chr($a);
                }
            }

            @imagedestroy($img);
            $skinTag = new CompoundTag("Skin", [
                "Name" => new StringTag("Name", $this->attacker->getSkin()->getSkinId()),
                "Data" => new ByteArrayTag("Data", $skinbytes),
                "GeometryName" => new StringTag("GeometryName", "geometry.geometry.coin"),
                "GeometryData" => new ByteArrayTag("GeometryData", file_get_contents(Main::getMain()->getDataFolder()."/PlagueSkull/geometry.json"))
            ]);
            $nbt->setTag($skinTag);
            //xXKHaLeD098Xx's code stops here
            $skull = new PlagueSkull($this->attacker->getLevel(), $nbt, (2*$this->CElevel) + 2);
            $skull->spawnToAll();
        }
    }
}
