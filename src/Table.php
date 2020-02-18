<?php

namespace MyXplor;

class Table
{
    /** @var string */
    const NORTH_FACING = "NORTH";

    /** @var string */
    const SOUTH_FACING = "SOUTH";

    /** @var string */
    const WEST_FACING = "WEST";

    /** @var string */
    const EAST_FACING = "EAST";

    /**
     * @var int
     */
    private $row;

    /**
     * @var int
     */
    private $column;

    /**
     * Table constructor.
     *
     * @param int $row
     * @param int $column
     */
    public function __construct($row, $column)
    {
        $this->row = $row;
        $this->column = $column;
    }

    /**
     * Get the rows of a table
     *
     * @return int
     */
    public function getRows(): ?int
    {
        return $this->row;
    }

    /**
     * Get the columns of a table
     *
     * @return int
     */
    public function getColumns(): ?int
    {
        return $this->column;
    }
}
