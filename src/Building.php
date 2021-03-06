<?php

namespace Building;

require_once "Elevator.php";

use Elevator\Elevator as Elevator;

/**
 * Class Building
 * @package Building
 */
class Building
{
    /**
     * @param $currentFloor
     * @param $floor
     * @param $direction
     * @param $active
     * @param $door
     * @return string
     */
    public function callElevator($currentFloor, $floor, $direction, $active, $door, $queue)
    {
        $Elevator = new Elevator();

        $floors = $Elevator->addToQueue($floor, $queue);

        if ($active === false && count($floors) == 1) {
            foreach ($floors as $floor) {
                switch ($floor) {
                    case $currentFloor > $floor:
                        $direction = "down";
                        break;
                    case $currentFloor < $floor:
                        $direction = "up";
                        break;
                    case $currentFloor == $floor:
                        $door = $this->openDoor();
                        break;
                    default:
                        $active = true;
                        break;
                }
            }

            $this->closeDoor();
            $msg = $Elevator->moveElevator($currentFloor, $floors, $door, $direction);
        }

        $msg = $Elevator->moveElevator($currentFloor, $floors, $door, $direction);

        return $msg;
    }

    /**
     * @return bool
     */
    protected function openDoor()
    {
        return true;
    }

    /**
     * @return bool
     */
    protected function closeDoor()
    {
        sleep(5);
        return false;
    }
}