<?php

namespace Models\Logic;


use Core\Database2;
use Models\Tables\Taxonomy;
use Models\Tables\User;

class Home
{

    public function getItems()
    {
        $database = new Database2();
        $user = new User();
        $alamakota = new Taxonomy();

        try {
            $database
                ->select([
                    new class {
                        private $id;
                    },
                    $alamakota
                ])
                ->from(array($user, $alamakota))
                ->where(function() use ($user, $alamakota){
                    return $user->id < $alamakota->id and ($user->id >= $alamakota->id or $user->id != $alamakota->id);
                });
        } catch (\Exception $exception){

        }

        echo "<pre>";
        print_r($database->renderQuery());
        echo "</pre>";
    }
}