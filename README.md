# irm_test
 
IRM Coding Test - POS API

###Dependencies:

composer (https://getcomposer.org/)

Run: ```> composer install``` in the root of the project to install dependencies

###Running the tests:

Run ```phpunit -v --testsuite "Test Suite"``` in the root of the project

###Calling the API:

The API comprises a single endpoint:

```terminal/scan-items```

Assuming your host is `localhost` a POST request can be made to:

http://localhost/terminal/scan-items

The scan-items endpoint expects an array product codes:

```json
{
	"items": [
		"ZA", "YB", "FC", "GD", "ZA", "YB", "ZA", "ZA"
		]
}
```
 and will return a JSON reponose containing the total values for the products, e.g.:
 ```json
{"total":32.4}
``` 
