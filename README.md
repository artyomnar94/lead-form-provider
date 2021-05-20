# lead-form-provider
Takes simple lead form from any web page and provide it into telegram.
Lead form must not contain any files.

[![Latest Stable Version](https://poser.pugx.org/artyomnar/lead-form-provider/v/stable.png)](https://packagist.org/packages/artyomnar/lead-form-provider)
[![Total Downloads](https://poser.pugx.org/artyomnar/lead-form-provider/downloads.png)](https://packagist.org/packages/artyomnar/lead-form-provider)


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require artyomnar/lead-form-provider
```

or add

```
"artyomnar/lead-form-provider": "*"
```

to the require section of your composer.json.


Usage
------------

```
$leadForm = $_POST['leadForm'];
$env = App::getEnvirenment();
$botToken = 'xxxxxxxxxxxxxxxx';
$chatId = '@myChannel';

$success = LeadFromProvider\LeadFromHandler::send($leadForm, $env, $botToken, $chatId);

return $success ? 'Form accepted successfully' : 'Error, try later';
```