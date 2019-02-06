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
```php
$start = (new \DateTime())->modify('+1 hour');
$booking = $this->httpClient->createBooking($remoteId, $start, (clone $start)->modify('+30 minutes'), 'My first booking');
```

## Delete a booking
```php
$this->httpClient->deleteBooking($bookingId);
```

## Update a booking state
```php
use MoovOne\TimekitPhpSdk\Model\Booking;

$booking = $this->httpClient->updateBookingState($bookingId, Booking::STATE_CANCEL);
```

## Get availabilities
```php
use MoovOne\TimekitPhpSdk\Model\Availability;

$payload = [
	'mode' => Availability::TYPE_ROUNDROBIN_RANDOM,
	'length' => '60 minutes',
	'round_to_nearest_hour' => false,
	'from' => 'tomorrow',
	'to' => '3 days',
	'buffer' => '5 minutes',
	'timeslot_increments' => '15 minutes',
	'resources' => [$resourceId],
];

$availabilities = $this->httpClient->getAvailabilities($payload);
```