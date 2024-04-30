# CSFloat API PHP Client

This PHP class provides a simple interface for interacting with the CSFloat API, allowing for operations such as listing, retrieving, and creating item listings.

## Requirements

- PHP 7.4 or higher
- cURL enabled in PHP

## Installation

You can download this class directly or clone it from GitHub:

    git clone tvirelli/csfloat-php-api

## Configuration

Before using this class, ensure you have your API key from CSFloat. You will need to set this API key when initializing the `CSFloatAPI` class. You can register a new CSFloat API key on your [profile](https://csfloat.com/profile) under the "developer" tab.

## Usage

Here is how you can use this class to interact with the CSFloat API:

### Initialize the class

    require_once 'CSFloatAPI.php';
    $apiKey = 'YOUR_API_KEY';
    $csFloatAPI = new CSFloatAPI($apiKey);

### Get all listings

    $allListings = $csFloatAPI->getAllListings(['page' => 1, 'limit' => 10]);
    print_r($allListings);

### Get a specific listing

    $listingId = '324288155723370196';
    $specificListing = $csFloatAPI->getSpecificListing($listingId);
    print_r($specificListing);

### Create a new listing

    $newListingDetails = [
        'asset_id' => '21078095468',
        'type' => 'buy_now',
        'price' => 8900,
        'description' => 'Just for show',
        'private' => false
    ];
    $newListing = $csFloatAPI->createListing($newListingDetails);
    print_r($newListing);

## Contributing

Contributions are welcome. Please fork the repository and submit pull requests with your changes.

## License

This project is licensed under the Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License - see the LICENSE.md file for details.
