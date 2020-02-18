<?php

namespace Test;

use MyXplor\Table;
use MyXplor\ToyRobot;
use PHPUnit\Framework\TestCase;

class ToyRobotTest extends TestCase
{
    /**
     * Sets a table with given rows and columns
     * 
     * @param int $row
     * @param int $column
     * @return Table
     */
    public function setTable($row, $column): Table
    {
        return new Table($row, $column);
    }

    /**
     * Given a table with 5 rows and 5 columns
     * When a toy robot is placed at origin facing north
     *      and give commands to move
     * Then a report command is issued to check whether
     *      the robot position matches with the expected results
     */
    public function testCommands()
    {
        $table = $this->setTable(5, 5);

        $toyRobot = new ToyRobot($table);
        $toyRobot->place(0, 0, 'NORTH');
        $toyRobot->move();
        
        $this->assertEquals('0,1,NORTH', $toyRobot->report());
    }

    /**
     * Given a table with 5 rows and 5 columns
     * When a toy robot is placed outside of the table
     * Then an error message will be thrown
     */
    public function testOutOfBounds()
    {
        $table = $this->setTable(5, 5);

        $toyRobot = new ToyRobot($table);

        $this->assertEquals("Out of Bounds", $toyRobot->place(10, 10, 'NORTH'));
    }

    /**
     * Given a table with 5 rows and 5 columns
     * When a toy robot is given a command to move
     * Then an error message will be thrown
     */
    public function testToMoveWithoutBeingPlaced()
    {
        $table = $this->setTable(5, 5);

        $toyRobot = new ToyRobot($table);
        $this->assertEquals("Robot hasn't been placed yet", $toyRobot->move());
    }

    /**
     * Given a table with 5 rows and 5 columns
     * When a toy robot is placed at origin with facing North
     *      and gave a command to rotate
     * Then a report command is issued to check whether
     *      the robot position matches with the expected results
     */
    public function testByPlacingRobotAtOrigin()
    {
        $table = $this->setTable(5, 5);

        $toyRobot = new ToyRobot($table);
        $toyRobot->place(0, 0, 'NORTH');
        $toyRobot->rotate('LEFT');

        $this->assertEquals('0,0,WEST', $toyRobot->report());
    }

    /**
     * Given a table with 5 rows and 5 columns
     * When a toy robot is placed at origin with facing East
     *      and gave a couple of move commands, then rotate
     *      command and finally another move command
     * Then a report command is issued to check whether
     *      the robot position matches with the expected results
     */
    public function testByPlacingRobotAtALocation()
    {
        $table = $this->setTable(5, 5);

        $toyRobot = new ToyRobot($table);
        $toyRobot->place(1, 2, 'EAST');
        $toyRobot->move();
        $toyRobot->move();
        $toyRobot->rotate('LEFT');
        $toyRobot->move();

        $this->assertEquals('3,3,NORTH', $toyRobot->report());
    }

    /**
     * Given a table with 5 rows and 5 columns
     * When a toy robot is placed at origin with facing North
     *      and gave rotate to Left and move commands
     * Then an error message will be thrown
     */
    public function testByPlacingRobotAtOriginAndMove()
    {
        $table = $this->setTable(5, 5);

        $toyRobot = new ToyRobot($table);
        $toyRobot->place(0, 0, 'NORTH');
        $toyRobot->rotate('LEFT');
        $this->assertEquals("Out of Bounds", $toyRobot->move());
    }

    /**
     * Given a table with 3 rows and 3 columns
     * When a toy robot is placed at origin with facing East
     *      and given a series of move commands which make it
     *      move outside of the table
     * Then an error message will be thrown
     */
    public function testMoveOutsideOfTable()
    {
        $table = $this->setTable(3, 3);

        $toyRobot = new ToyRobot($table);
        $toyRobot->place(0, 0, 'EAST');
        $toyRobot->move();
        $toyRobot->move();
        $toyRobot->move();
        $this->assertEquals("Out of Bounds", $toyRobot->move());
    }
}