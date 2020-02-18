<?php

namespace MyXplor;

class ToyRobot
{
    /** @var string */
    const LEFT_ROTATION = "LEFT";

    /** @var string */
    const RIGHT_ROTATION = "RIGHT";

    /**
     * @var Table $table
     */
    private $table;

    /**
     * @var int
     */
    private $positionX;

    /**
     * @var int
     */
    private $positionY;

    /**
     * @var string
     * Values
     *      NORTH
     *      EAST
     *      SOUTH
     *      WEST
     */
    private $facing;

    /**
     * ToyRobot constructor.
     *
     * @param Table $table
     */
    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    /**
     * Place the robot on the table
     *
     * @param int $positionX
     * @param int $positionY
     * @param string $facing
     * @return string
     */
    public function place($positionX, $positionY, $facing)
    {
        if($this->isOutOfBounds($positionX, $positionY)) {
            return "Out of Bounds";
        }

        $this->setPositionX($positionX);
        $this->setPositionY($positionY);
        $this->setFacing($facing);
    }

    /**
     * Move the toy robot based on which direction it is facing
     * @return string
     */
    public function move()
    {
        if(! $this->isPlaced()) {
           return "Robot hasn't been placed yet";
        }

        switch ($this->getFacing()) {
            case Table::NORTH_FACING:
                $positionY = $this->getPositionY() + 1;
                $positionX = $this->getPositionX();
                break;

            case Table::SOUTH_FACING:
                $positionY = $this->getPositionY() - 1;
                $positionX = $this->getPositionX();
                break;

            case Table::WEST_FACING:
                $positionX = $this->getPositionX() - 1;
                $positionY = $this->getPositionY();
                break;

            case Table::EAST_FACING:
                $positionX = $this->getPositionX() + 1;
                $positionY = $this->getPositionY();
                break;

            default:
                $positionX = 0;
                $positionY = 0;
                break;
        }

        if($this->isOutOfBounds($positionX, $positionY)) {
            return "Out of Bounds";
        }

        $this->setPositionX($positionX);
        $this->setPositionY($positionY);
    }

    /**
     * Rotate the toy robot based on the rotation value
     *
     * @param string $rotation
     * @return string
     */
    public function rotate($rotation)
    {
        if(! $this->isPlaced()) {
            return "Robot hasn't been placed yet";
        }

        // Get the current facing
        $facing = $this->getFacing();

        /**
         * Flip or keep the existing directions based on the rotation.
         * 
         * Clockwise direction will be to right &
         * Anti-clock wise direction will be left
         * 
         */
        $compassDirections = ($rotation == self::RIGHT_ROTATION)
            ? $this->compassDirections()
            : array_flip($this->compassDirections());
        
        $this->setFacing($compassDirections[$facing]);
    }

    /**
     * Returns the report of toy robot:
     *      1. PositionX
     *      2. PositionY &
     *      3. Facing
     * 
     * @return string
     */
    public function report(): string
    {
        if(! $this->isPlaced()) {
            return "Robot hasn't been placed";
        }

        return implode(",", [
            $this->getPositionX(),
            $this->getPositionY(),
            $this->getFacing()
        ]);
    }

    //Setters and Getters
    /**
     * @param int $positionX
     */
    public function setPositionX($positionX)
    {
        $this->positionX = $positionX;
    }

    /**
     * @return int
     */
    public function getPositionX(): ?int
    {
        return $this->positionX;
    }

    /**
     * @param int $positionY
     */
    public function setPositionY($positionY)
    {
        $this->positionY = $positionY;
    }

    /**
     * @return int
     */
    public function getPositionY(): ?int
    {
        return $this->positionY;
    }

    /**
     * @param string $facing
     */
    public function setFacing($facing)
    {
        $this->facing = $facing;
    }

    /**
     * @return string
     */
    public function getFacing(): ?string
    {
        return $this->facing;
    }

    /**
     * Returns the list of names of each direction and it's clockwise one
     * 
     * @return array
     */
    public function compassDirections(): array
    {
        return [
            Table::NORTH_FACING => Table::EAST_FACING,
            Table::EAST_FACING  => Table::SOUTH_FACING,
            Table::SOUTH_FACING => Table::WEST_FACING,
            Table::WEST_FACING  => Table::NORTH_FACING
        ];
    }

    /**
     * Check whether toy robot is placed on table
     * 
     * @return bool
     */
    public function isPlaced(): bool
    {
        return ($this->getPositionX() !== null && $this->getPositionY() !== null);
    }

    /**
     * Check whether the current position is on the table or outside of the table
     * 
     * @param int $rows     Number of rows in a table
     * @param int $columns  Number of columns in a table
     * @return bool
     */
    public function isOutOfBounds($rows, $columns): bool
    {
        $tableRows = $this->table->getRows();
        $tableColumns = $this->table->getColumns();

        if(($rows > $tableRows || $rows < 0)
            || ($columns > $tableColumns || $columns < 0)
        ) {
            return true;
        }

        return false;
    }
}