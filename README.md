Star Fleet Commander:

run the script with "php index.php" in order to print out fleet formations

Requirements: - PHP >= 8.0.3 - composer

Improvements that could be done:
1. Dependency injection container could/should be used instead of manually instancing classes in index.php
2. Command pattern could be used to print out the output of the formation, instead of index.php and calling print manually
3. Fleet validator could be implemented to enforce presence of each ship in fleet
4. Fleet inteface could be separated to multiple smaller ones, instead of single big one (Interface Segregation)
5. Data could be generated better, perhaps through using json file and DataConnection class, instead of calling RandomShipDataGenerator in Repository
6. Open close princible possibly violated in method Fleet::reapplyFormation (every new type of formation would require additions to this method)
    and ShipFactory::createShip (every new type of ship would require additions to the switch case)
7. Value objects/collections could be used instead of random arrays of ships
