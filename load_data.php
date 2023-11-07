<?php 
include_once("../../db.php"); 
require 'vendor/autoload.php';


$faker = faker\Factory::create('en_PH'); // Set Philippine Locale

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "root";
$database = "newschema";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert fake data into theby  Employee table (200 rows)
for ($i = 0; $i < 200; $i++) {
    $lastname = $faker->lastName;
    $firstname = $faker->firstName;
    $office_id = $faker->numberBetween(1, 50); // Random selection from Office table PK
    $address = $faker->address;

    $sql = "INSERT INTO Employee (lastname, firstname, office_id, address) VALUES ('$lastname', '$firstname', $office_id, '$address')";
    $conn->query($sql);
}

// Insert fake data into the Office table (50 rows)
for ($i = 0; $i < 50; $i++) {
    $name = $faker->company;
    $contactnum = $faker->phoneNumber;
    $email = $faker->email;
    $address = $faker->address;
    $city = $faker->city;
    $country = $faker->country;
    $postal = $faker->postcode;

    $sql = "INSERT INTO Office (name, contactnum, email, address, city, country, postal) VALUES ('$name', '$contactnum', '$email', '$address', '$city', '$country', '$postal')";
    $conn->query($sql);
}

// Insert fake data into the Transaction table (500 rows)
for ($i = 0; $i < 500; $i++) {
    $employee_id = $faker->numberBetween(1, 200); // Random selection from Employee table PK
    $office_id = $faker->numberBetween(1, 50); // Random selection from Office table PK
    $datelog = $faker->dateTimeThisDecade->format('Y-m-d H:i:s'); // Generates date within this decade
    $action = $faker->word;
    $remarks = $faker->sentence;
    $documentcode = $faker->word;

    $sql = "INSERT INTO Transaction (employee_id, office_id, datelog, action, remarks, documentcode) VALUES ($employee_id, $office_id, '$datelog', '$action', '$remarks', '$documentcode')";
    $conn->query($sql);
}

echo "Fake data loaded successfully.";

// Close the database connection
$conn->close();
?>
