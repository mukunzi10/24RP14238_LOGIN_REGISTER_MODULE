<?php
require_once __DIR__ . '/vendor/autoload.php';

function getMongoConnection() {
    try {
        // MongoDB connection string
        $mongoHost = getenv('MONGO_HOST') ?: '24RP14238_mongodb';
        $mongoPort = getenv('MONGO_PORT') ?: '27019';
        $mongoDb = getenv('MONGO_DB') ?: '24RP14238_shareride_db';
        
        $connectionString = "mongodb://{$mongoHost}:{$mongoPort}";
        
        // Create MongoDB client
        $client = new MongoDB\Client($connectionString);
        
        // Return database object
        return $client->selectDatabase($mongoDb);
        
    } catch (Exception $e) {
        die("MongoDB Connection Error: " . $e->getMessage());
    }
}
?>