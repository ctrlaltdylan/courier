# Courier
## A simple PHP Wrapper for Textbelt, a free SMS Provider
---

Example:
````
$courier = new Courier\Courier;

$courier->setRecipent('867530999')->setBody('Hello World')->send();
````

You can also chain for multiple messages in one line.

````
$body = "One hot body";

$courier->setRecipent('1112223333')->setBody($body)->send()
		->setRecipent('4445556666')->setBody($body)->send()
````

**Note:** Be sure to use `send()` before starting another message.