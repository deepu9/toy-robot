Toy Robot Simulator
====================
Approach
---------
1. Read through the PROBLEM.md and prepare actors and their actions
2. Prepare actor properties and their behaviours
3. Added separate classes for actors and implemented the logic/solution
4. Write unit tests and update the code as I cover for different scenarios
5. Write console part without touching/modifying the actors, because they should obey Single Responsibility.
6. Try to use as much self-explanatory names as I could.
7. Also added PHPDocs wherever needed.

Installation & Usage
--------------------
1. Unzip the folder and run `composer install` to install all the packages.
2. Change `console` file permissions by running the following command:

   `chmod 777 console`

3. Make sure you have PHP 7.0+ installed to run this application.
4. All files related running robot simulation are placed under `src`
5. Run `./console` to start the application.
6. Give any of the following commands to continue the process:
    1. PLACE
    2. MOVE
    3. LEFT
    4. RIGHT
7. Run the following command when you want to see the robot location:

    `REPORT`

Unit Tests
----------
1. All tests are placed in `tests` folder.
2. Added all the use cases, including the three from PROBLEM.md
2. Run `./vendor/bin/phpunit`(if PHPUnit isn't set in your path) to see the results.