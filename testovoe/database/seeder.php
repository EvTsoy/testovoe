<?php
use Ramsey\Uuid\Uuid;

// use the factory to create a Faker\Generator instance
$faker = Faker\Factory::create();

// generate data by calling methods
$seed = function() use ($faker, $conn)
{
    try {
        $branch_ids = [];

        $dropQuery = "DROP TABLE IF EXISTS workers";
        $statement = $conn->prepare($dropQuery);
        $statement->execute();

        $dropQuery = "DROP TABLE IF EXISTS branches";
        $statement = $conn->prepare($dropQuery);
        $statement->execute();
    
        
        $table = "CREATE TABLE IF NOT EXISTS `branches` (
                    `id` varchar(191) NOT NULL PRIMARY KEY,
                    `branch_name` varchar(191) NOT NULL
                )";
                
        $conn->query($table);
    
        for ($i = 0; $i < 3; $i++ ) {
            $uuid = Uuid::uuid4();
            array_push($branch_ids, $uuid);
            $branch_name =  $faker->company();
            $createQuery = "INSERT INTO branches(id, branch_name)
            VALUES(:uuid, :branch_name)";
    
            $statement = $conn->prepare($createQuery);
            $statement->execute(array(":uuid" => $uuid, ":branch_name" => $branch_name));
        }

        $table = "CREATE TABLE IF NOT EXISTS `workers` (
                    `id` varchar(191) NOT NULL PRIMARY KEY,
                    `first_name` varchar(191) NOT NULL,
                    `last_name` varchar(191) NOT NULL,
                    `phone` varchar(191) NOT NULL,
                    `category` varchar(191) NOT NULL,
                    `branch_id` varchar(191),
                    FOREIGN KEY (`branch_id`) REFERENCES branches(`id`)
                    ON UPDATE CASCADE
                    ON DELETE RESTRICT
                )";

        $conn->query($table);
        for ($i = 0; $i < 100; $i++ ) {
            $uuid = Uuid::uuid4();
            $first_name =  $faker->firstName();
            $lastName =  $faker->lastName();
            $phone =  $faker->e164PhoneNumber();
            $category =  array("Сотрудник", "ИРТ")[rand(0,1)];
            $branch_id = $branch_ids[rand(0, count($branch_ids) - 1)];

            $createQuery = "INSERT INTO workers(id, first_name, last_name, phone, category, branch_id)
            VALUES(:uuid, :first_name, :lastName, :phone, :category, :branch_id)";
    
            $statement = $conn->prepare($createQuery);
            $statement->execute(array(
                ":uuid" => $uuid,
                ":first_name" => $first_name,
                ":lastName" => $lastName,
                ":phone" => $phone,
                ":category" => $category,
                ":branch_id" => $branch_id
            ));
        }
        
    } catch (PDOException $ex){
        echo "An error occurred" .$ex->getMessage();
    }
};
