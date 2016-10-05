# Courier
A simple PHP Wrapper for Textbelt, a free SMS Provider

## Installation

Courier is a composer package. Install using:

```
composer require ctrlaltdylan/courier
```

## Usage

Example:
````
$courier = new Courier\Courier;

$courier->setRecipient('867530999')->setBody('Hello World')->send();
````

You can also chain for multiple messages in one line.

````
$body = "One hot body";

$courier->setRecipient('1112223333')->setBody($body)->send()
	->setRecipient('4445556666')->setBody($body)->send()
;
````

**Note:** Be sure to use `send()` before starting another message.

### Options

Options are passed into courier via the 2nd argument in the constructor.

#### Regions

Courier provides the Canadian and International support given by Textbelt in a few ways.


Like through the constructor:
```
    $canadianCourier = new Courier\Courier(['body' => 'I <3 Vancouver'], ['region' => 'canada']);
```

Or with the `setRegion` method:
```
   $courier->setRegion('intl');
```

Supported regions:

* `us` (default)
* `canada`
* `intl` (short for 'international')
