<?php

namespace App\Model;

class BirdModel{

    private $birds = [
        [
            'name' => 'White bird',
            'description' => 'The chubby white bird drops an egg bomb when players tap the screen after launching the creature from the slingshot.',
            'image' => 'white.png',
            'price' => 30,
        ],
        [
            'name' => 'Black bird',
            'description' => 'Black birds act as bombs, which explode once they\'ve landed on a target, obliterating pigs and buildings around them.',
            'image' => 'black.png',
            'price' => 25,
        ],
        [
            'name' => 'Red bird',
            'description' => 'The first avian missile players encounter when they start the game, the red bird follows a simple trajectory when launched.',
            'image' => 'red.png',
            'price' => 35,
        ],
        [
            'name' => 'Blue bird',
            'description' => 'The blue bird splits into three smaller versions in mid-air when the screen is tapped.',
            'image' => 'blue.png',
            'price' => 31,
        ],
        [
            'name' => 'Yellow bird',
            'description' => 'Tapping the screen after launching the yellow bird gives the critter a speed boost that makes it more deadly.',
            'image' => 'yellow.png',
            'price' => 33,
        ],
        [
            'name' => 'Green bird',
            'description' => 'The green bird turns into a boomerang that doubles back to strike targets in otherwise protected locations.',
            'image' => 'green.png',
            'price' => 26,
        ],
        [
            'name' => 'Big red bird',
            'description' => 'The big red bird is a flying wrecking bail that causes more damage than his smaller red cousin.',
            'image' => 'red-big.png',
            'price' => 28,
        ],
    ];


    /**
     * Get the value of birds
     * 
     * @return array Birds list
     */ 
    public function getBirds()
    {
        return $this->birds;
    }

    /**
     * Get the value of one birds
     * 
     * @param int $id Bird index
     * @return array|null Bird or null if not found
     */ 
    public function getBird(int $id): ?array
    {
        if (!array_key_exists($id, $this->birds)) {
            return null;
        }
        return $this->birds[$id];
    }

}