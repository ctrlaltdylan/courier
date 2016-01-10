# Courier
## A simple PHP Wrapper for Textbelt, a free SMS Provider

### Installation

Courier is a composer package. Install using:

```
composer require ctrlaltdylan/courier
```

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