# Timekit.io PHP SDK

**Warning: this library is in development. First release should be ready in few days.**

This library is a basic PHP SDK for the timekit.io API.

This SDK doesn't fully cover the timekit.io API endpoints. Only the following endpoints are covered:

|Covered end-point              |Timekit.io documentation                                     |
|:------------------------------|:------------------------------------------------------------|
|`POST /resources`              |https://developers.timekit.io/reference#resources            |
|`PUT /resources/{id}`          |https://developers.timekit.io/reference#resources-id         |
|`DELETE /resources/{id}`       |https://developers.timekit.io/reference#delete-resource      |
|`GET /resources/{id}`          |https://developers.timekit.io/reference#resourcesid  
|||
|`POST /bookings`               |https://developers.timekit.io/reference#bookings             |
|`DELETE /bookings/{id}`        |https://developers.timekit.io/reference#delete-a-booking     |
|`PUT /bookings/{id}/{state}`   |https://developers.timekit.io/reference#bookingsidaction     |
|||
|`POST /availability`           |https://developers.timekit.io/reference#query-availability-v2|



# Installation
`composer require moovone/timekit-php-sdk`

# Usage
```php
use Moovone\TimekitPhpSdk\GuzzleClient;

$httpClient = new GuzzleClient($apiKey);

$payload = [  
  'timezone' => 'Europe/Paris',  
  'name' => 'John Doe',  
];  
  
$resource = $this->httpClient->createResource($payload);
```

# Examples

## Create a resource
```php
$payload = [  
  'timezone' => $timezone,  
  'first_name' => $firstName,  
  'last_name' => $lastName,  
  'name' => sprintf('%s %s', $firstName, $lastName),  
];  
  
$resource = $this->httpClient->createResource($payload);
```

## Update a resource
```php
$payload = [  
  'timezone' => $timezone,  
  'first_name' => $firstName,  
  'last_name' => $lastName,  
  'name' => sprintf('%s %s', $firstName, $lastName),  
];  
  
$this->httpClient->updateResource($resourceId, $payload);
```

## Delete a resource
```php
$this->httpClient->deleteResource($resourceId);
```

## Get a resource
```php
$resource = $this->httpClient->getResource($resourceId);
```

## Create a booking
*documentation in progress*

## Delete a booking
*documentation in progress*

## Update a booking state
*documentation in progress*

## Get availabilities
*documentation in progress*