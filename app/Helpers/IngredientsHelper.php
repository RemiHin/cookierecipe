<?php

namespace App\Helpers;

class IngredientsHelper
{
    public $sprinkles = [
        'capacity' => 2,
        'durability' => 0,
        'flavor' => -1,
        'texture' => 0,
        'calories' => 3,
    ];

    public $butterscotch = [
        'capacity' => 0,
        'durability' => 5,
        'flavor' => -3,
        'texture' => 0,
        'calories' => 3,
    ];

    public $chocolate = [
        'capacity' => 0,
        'durability' => 0,
        'flavor' => 5,
        'texture' => -1,
        'calories' => 8,
    ];

    public $candy = [
        'capacity' => 0,
        'durability' => -1,
        'flavor' => 0,
        'texture' => 5,
        'calories' => 8,
    ];

    /**
     * Calculates the capacity, durability, flavor, texture and calories of the cookie
     * based on the input
     * @param $s = amount of Sprinkles
     * @param $b = amount of Butterscotch
     * @param $ch = amount of Chocolate
     * @param $ca = amount of Candy
     */
    public function calculateProperties($s, $b, $ch, $ca)
    {
        $output['capacity'] =
            ($s * $this->sprinkles['capacity'] >= 0 ? $s * $this->sprinkles['capacity'] : 0) +
            ($b * $this->butterscotch['capacity'] >= 0 ? $b * $this->butterscotch['capacity'] : 0) +
            ($ch * $this->chocolate['capacity'] >= 0 ? $ch * $this->chocolate['capacity'] : 0) +
            ($ca * $this->candy['capacity'] >= 0 ? $ca * $this->candy['capacity'] : 0);
        $output['durability'] =
            ($s * $this->sprinkles['durability'] >= 0 ? $s * $this->sprinkles['durability'] : 0) +
            ($b * $this->butterscotch['durability'] >= 0 ? $b * $this->butterscotch['durability'] : 0) +
            ($ch * $this->chocolate['durability'] >= 0 ? $ch * $this->chocolate['durability'] : 0) +
            ($ca * $this->candy['durability'] >= 0 ? $ca * $this->candy['durability'] : 0);
        $output['flavor'] =
            ($s * $this->sprinkles['flavor'] >= 0 ? $s * $this->sprinkles['flavor'] : 0) +
            ($b * $this->butterscotch['flavor'] >= 0 ? $b * $this->butterscotch['flavor'] : 0) +
            ($ch * $this->chocolate['flavor'] >= 0 ? $ch * $this->chocolate['flavor'] : 0) +
            ($ca * $this->candy['flavor'] >= 0 ? $ca * $this->candy['flavor'] : 0);
        $output['texture'] =
            ($s * $this->sprinkles['texture'] >= 0 ? $s * $this->sprinkles['texture'] : 0) +
            ($b * $this->butterscotch['texture'] >= 0 ? $b * $this->butterscotch['texture'] : 0) +
            ($ch * $this->chocolate['texture'] >= 0 ? $ch * $this->chocolate['texture'] : 0) +
            ($ca * $this->candy['texture'] >= 0 ? $ca * $this->candy['texture'] : 0);
        $output['calories'] =
            ($s * $this->sprinkles['calories'] >= 0 ? $s * $this->sprinkles['calories'] : 0) +
            ($b * $this->butterscotch['calories'] >= 0 ? $b * $this->butterscotch['calories'] : 0) +
            ($ch * $this->chocolate['calories'] >= 0 ? $ch * $this->chocolate['calories'] : 0) +
            ($ca * $this->candy['calories'] >= 0 ? $ca * $this->candy['calories'] : 0);
        $output['total'] = $output['capacity'] * $output['durability'] * $output['flavor'] * $output['texture'];

        return $output;
    }
}
