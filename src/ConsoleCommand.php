<?php
namespace MyXplor;


class ConsoleCommand
{
    /** @var string */
    const PLACE_COMMAND = "PLACE";

    /** @var string */
    const MOVE_COMMAND = "MOVE";

    /** @var string */
    const LEFT_COMMAND = "LEFT";

    /** @var string */
    const RIGHT_COMMAND = "RIGHT";

    /** @var string */
    const REPORT_COMMAND = "REPORT";

    /**
     * @var ToyRobot $toyRobot
     */
    private $toyRobot;

    /**
     * ConsoleCommand constructor.
     *
     * @param ToyRobot $toyRobot
     */
    public function __construct(ToyRobot $toyRobot)
    {
        $this->toyRobot = $toyRobot;
    }

    /**
     * Execute console commands
     *
     * @param $action
     * @param array $parameters
     *
     * @throws \Exception
     */
    public function execute($action, array $parameters = [])
    {
        switch ($action) {
            case self::PLACE_COMMAND:
                $positionX = (int) $parameters[0];
                $positionY = (int) $parameters[1];
                $facing = $parameters[2];
                $result = $this->toyRobot->place($positionX, $positionY, $facing);
                break;

            case self::MOVE_COMMAND:
                $result = $this->toyRobot->move();
                break;

            case self::LEFT_COMMAND:
            case self::RIGHT_COMMAND:
                $result = $this->toyRobot->rotate($action);
                break;

            case self::REPORT_COMMAND:
                $result = $this->toyRobot->report();
                break;

            default:
                break;
        }

        // Output to command line if needed
        if(! empty($result)) {
            echo $result . PHP_EOL;
        }
    }
}
