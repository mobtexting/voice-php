# mobtexting-php

PHP sdk for mobtexting

## Installation

You can install **mobtexting-php** via composer or by downloading the source.

#### Via Composer:

**mobtexting-php** is available on Packagist as the
[`mobtexting/voice-sdk`](http://packagist.org/packages/mobtexting/voice-sdk) package.

## Quickstart

### Generating JSON

To control phone calls, your application needs to output [JSON] response. Use `Mobtexting\Voice` to easily create such responses.

```php
<?php
$response = new Mobtexting\Voice();
$response->answer();
$response->say('Hello');
$response->play('https://domain.com/cowbell.mp3');
print $response;
```

That will output JSON that looks like this:

```json
[
  {
    "Answer": {
      "delay": 0
    }
  },
  {
    "SayText": {
      "language": "EN",
      "engine": "polly",
      "message": "Hello"
    }
  },
  {
    "Play": {
      "type": "mp3",
      "path": "https://domain.com/cowbell.mp3"
    }
  }
]
```

# Commands

```shell
 - answer
 - delay
 - conference
 - email
 - filter
 - hangup
 - play
 - record
 - repeat
 - say
 - sayDateTime
 - sayNumber
 - sayPin
 - url
```

### Answer

The `Answer` tag answers the call. One call answers billing will get started.
You can't nest any other tags inside this `Answer` Tag

_Attributes_

`Answer` tag allows following attributes.

* `delay` no of seconds delay the call before answer.

### Delay

The `Delay` tag will allow you to wait the call before going to next tag.

_Attributes_

`Delay` tag allows the following attributes.

* `seconds` no of seconds to delay

### `Say` tag

# Nested tags

Some times we have to nest the tags within other tag.

Following tags allow nested tags

```
- menu
- url
- filter
```

### Example of filter tag with nested tags

```php
  $response = new Mobtexting\Voice();
  $response->answer();
  $response->say('Hello');

  $filter = $response->filter([10]);
  $filter->onFail('hangup');
  $url = $filter->onPass('Url')->setUrl('google.com');
  $url->onResponse('*', 'hangup');
  $url->onResponse('x', 'hangup');

  echo $response;
```

### Response

```json
[
  {
    "Answer": {
      "delay": 0
    }
  },
  {
    "SayText": {
      "language": "EN",
      "engine": "polly",
      "message": "Hello"
    }
  },
  {
    "Filter": {
      "onpass": {
        "Url": {
          "method": "get",
          "url": "google.com",
          "response": {
            "*": {
              "Hangup": {
                "reason": 16
              }
            },
            "x": {
              "Hangup": {
                "reason": 16
              }
            }
          }
        }
      },
      "onfail": {
        "Hangup": {
          "reason": 16
        }
      },
      "type": "frequency",
      "unit": [10]
    }
  }
]
```

### Example of filter tag with nested tags

```php
  $response = new Mobtexting\Voice();
  $response->answer();
  $response->say('Hello');

$dial = $response->dial('700xxx', '80300xxxxx');
$dial->setAttribute('retries', 1);

$play = $dial->onAnswer('play', ['custom/14d81c2e3c3f8110a7e8f36331e1b9b3']);
$play->setAttribute('duration', 30);

$play = $dial->onNoAnswer('play', ['custom/14d81c2e3c3f8110a7e8f36331e1b9b3']);

echo $response;
```

### Response

```json
[
  {
    "Answer": {
      "delay": 0
    }
  },
  {
    "SayText": {
      "language": "EN",
      "engine": "polly",
      "message": "Hello"
    }
  },
  {
    "Dial": {
        "to": "7008409026",
        "callerid": "+918030072306",
        "retries": 0,
        "onanswer": [
            {
                "Play": {
                "path": "custom/14d81c2e3c3f8110a7e8f36331e1b9b3",
                "type": "gsm",
                "duration": 30
                }
            }
        ],
        "onnoanswer": [
            {
                "Play": {
                "path": "custom/d2a3030926b57807e0067244f040f70e",
                "type": "gsm",
                "duration": 30
                }
            }
        ]
    }
  }
]
```
