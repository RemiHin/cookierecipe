<?php

namespace App\Http\Livewire;

use App\Helpers\IngredientsHelper;
use Livewire\Component;

class Calculator extends Component
{
    public $result = [];

    public $sprinkles_amount = 0;
    public $butterscotch_amount = 0;
    public $chocolate_amount = 0;
    public $candy_amount = 0;
    public $teaspoons_remaining = 100;

    public $maxValue = ['total' => 0];
    public $maxValueWithCalories = ['total' => 0];

    public $calculated = false;

    public function updated()
    {
        $this->sprinkles_amount = $this->sprinkles_amount > 0 ? $this->sprinkles_amount : 0;
        $this->butterscotch_amount = $this->butterscotch_amount > 0 ? $this->butterscotch_amount : 0;
        $this->chocolate_amount = $this->chocolate_amount > 0 ? $this->chocolate_amount : 0;
        $this->candy_amount = $this->candy_amount > 0 ? $this->candy_amount : 0;

        $this->updateTeaspoonsRemaining();

        if($this->teaspoons_remaining === 0)
        {
            $ingredientsHelper = new IngredientsHelper();
            $this->result = $ingredientsHelper->calculateProperties($this->sprinkles_amount, $this->butterscotch_amount, $this->chocolate_amount, $this->candy_amount);
        }
    }

    public function calculateMax()
    {
        $this->updateTeaspoonsRemaining();

        for ($s = 0; $s <= 100; $s++) {
            $this->sprinkles_amount = $s;
            $this->updateTeaspoonsRemaining();

            for ($b = 0; $b <= 100; $b++) {
                $this->butterscotch_amount = $b;
                $this->updateTeaspoonsRemaining();

                for ($ch = 0; $ch <= 100; $ch++) {
                    $this->chocolate_amount = $ch;
                    $this->updateTeaspoonsRemaining();

                    for ($ca = 0; $ca <= 100; $ca++) {
                        $this->candy_amount = $ca;
                        $this->updateTeaspoonsRemaining();

                        if($this->teaspoons_remaining === 0)
                        {
                            $ingredientsHelper = new IngredientsHelper();
                            $this->result = $ingredientsHelper->calculateProperties($this->sprinkles_amount, $this->butterscotch_amount, $this->chocolate_amount, $this->candy_amount);

                            if ($this->result['total'] > $this->maxValue['total'])
                            {
                                $this->maxValue = [
                                    'sprinkles' => $s,
                                    'butterscotch' => $b,
                                    'chocolate' => $ch,
                                    'candy' => $ca,
                                    'capacity' => $this->result['capacity'],
                                    'durability' => $this->result['durability'],
                                    'flavor' => $this->result['flavor'],
                                    'texture' => $this->result['texture'],
                                    'calories' => $this->result['calories'],
                                    'total' => $this->result['total'],
                                ];
                            }
                            if ($this->result['total'] > $this->maxValueWithCalories['total'] && $this->result['calories'] === 500)
                            {
                                $this->maxValueWithCalories = [
                                    'sprinkles' => $s,
                                    'butterscotch' => $b,
                                    'chocolate' => $ch,
                                    'candy' => $ca,
                                    'capacity' => $this->result['capacity'],
                                    'durability' => $this->result['durability'],
                                    'flavor' => $this->result['flavor'],
                                    'texture' => $this->result['texture'],
                                    'calories' => $this->result['calories'],
                                    'total' => $this->result['total']
                                ];
                            }
                        }
                    }
                }
            }
        }
        $this->calculated = true;
        $this->clearSearch();
    }

    public function clearSearch()
    {
        $this->teaspoons_remaining = 100;
        $this->sprinkles_amount = 0;
        $this->butterscotch_amount = 0;
        $this->chocolate_amount = 0;
        $this->candy_amount = 0;
        $this->result = [];
    }

    public function updateTeaspoonsRemaining()
    {
        $this->teaspoons_remaining = 100 - $this->sprinkles_amount - $this->butterscotch_amount - $this->chocolate_amount - $this->candy_amount;
    }

    public function render()
    {
        return view('livewire.calculator');
    }
}
