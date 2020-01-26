<?php

namespace app\repositories;


interface SpellerInterface
{
    /**
     * @param string $name
     * @return string;
     */
    public function spellByCity(string $name);
}