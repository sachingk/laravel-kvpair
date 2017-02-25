# Laravel KVPair
KV Pair System For Laravel 5.4

## Introduction

Key-Value pair is being used in most of the cases where only developer will maintain and change the list. Developer usually tends to keep these key-value pair config file.

While this works just fine in small applications, it becomes very difficult to manage and maintain when the list grows.Unfortunately all application starts small, but grows big very quickly.

To address this problem, I have developed a KV Pair system for laravel framework which stores the KV Pair in the database.

#### Benefits, Benefits and Benefits
- All your KV Pair are inside on table. Hence you can use them in your SQL joins
- You can give description for every KV Pair
- You can put KV pairs in a group (aka Group them)
- Get the KV pairs ready to bind with select html control
- Multiple Language Support for "select" string


## Installation

Require this package with composer:

```shell
composer require sachingk/laravel-kvpair
```

After updating composer, add the ServiceProvider to the providers array in config/app.php

### Laravel 5.x:

#### Add Service Provider

```php
 sachingk\kvpair\KVPairServiceProvider::class,
```

#### Add Facade

If you want to use the facade , add this to your facades in app.php:

```php
 "KVPair"=> sachingk\kvpair\Facade\kvpair::class,
```

#### Make Migration

Now you need to run artisan migrate command via command line. If you wish to add more columns to the table before migration then run the following command in command line.

```php
 php artisan vendor:publish --tag=migrations
```

Now the migration file get copied to /database/migrations folder. Add any extra columns you need and then run the migrate artisan command.

## Usage

This KV pair system provides 4 set of functions to work with KV store.

- Add
- Get
- Delete
- Count

#### Adding KV Pair to store

You can add KV Pair to the store in 2 ways

- One at a time
- Bulk Addition

##### One at a time
This take 4 parameters

```php
KVPair::addKVPair("key","value","description","group")
```

- 1st Parameter : key - Key of the KV Pair
- 2nd Parameter : value - Value of KV Pair
- 3rd Parameter : description - Description of KV Pair (can be empty)
- 4th Parameter : group - Group of the KV Pair which it belongs to

This function will return true or false. While True stands for successful addition, False stands for failure.
False will be returned if

- All the required parameters are not set
- A KV pair already exists with the same key

##### Bulk Addition

This take 1 parameter which is an array.

```php
KVPair::addKVPairs("key","value","description","group")
```

- 1st Parameter : $KeyValuePairs - Array of KV Pairs. The array follow the below structure
```php
 [
   ["key"=>"key1","value"=>"value1","description"=>"","group"=>"group1"],
   ["key"=>"key2","value"=>"value2","description"=>"","group"=>"group1"],
 ];
```

This function will return true or false. While True stands for successful addition, False stands for failure.
False will be returned if

- All the required parameters are not set
- Any of the KV pair are not set in terms of key, value or group
- A KV pair already exists with the same key

#### Retrieving KV Pair from store

You can add KV Pair to the store in 5 ways

- Get By Single Key
- Get By Multiple Keys
- Get By Single Group
- Get By Multiple Groups
- Get All KV Pairs for KV Store

#####  Get By Single Key

This take 1 parameter i.e key

```php
KVPair::getKVPairByKey($key)
```

- 1st Parameter : key - the key name

This function will return object of KV Pair that matches the given key or return false if no KV pair found.
The object returned will follow below pattern.

```php
{
  "key": "A1"
  "value": "A1"
  "description": ""
  "group": "A"
}
```

#####  Get By Multiple Keys

This take 2 parameter

```php
KVPair::getKVPairByKeys($keys)
```

- 1st Parameter : keys - Array of keys
- 2nd Parameter : forDropDown - boolean (optional, false by default)

This function will return array of KV Pairs that matches the given keys or return false if no KV pairs found.
The output returned will follow below pattern.

```php
array:2 [▼
  0 => array:4 [▼
    "key" => "A1"
    "value" => "A1"
    "description" => ""
    "group" => "A"
  ]
  1 => array:4 [▼
    "key" => "A2"
    "value" => "A2"
    "description" => ""
    "group" => "A"
  ]
]
```

However, if the forDropDown is set to true then output returned will follow below pattern.
```php
array:3 [▼
  "" => "Select"
  "A1" => "A1"
  "A2" => "A2"
]
```

> The string "select" can support multiple languages.See the <b>Multilingual Section</b> for more details.

> The associated value of "select" can be configurable. See <b>Configuration Section</b> for more details.

##### Get By Single Group

This take 2 parameter

```php
KVPair::getKVPairByGroup($group)
```

- 1st Parameter : group - the group name as string
- 2nd Parameter : forDropDown - boolean (optional, false by default)

The output follows the same pattern as defined in <b>Get By Multiple Keys </b> (above)

##### Get By Multiple Groups

This take 2 parameter

```php
KVPair::getKVPairByGroups($groups)
```

- 1st Parameter : group - array of group names
- 2nd Parameter : forDropDown - boolean (optional, false by default)

The output follows the same pattern as defined in <b>Get By Multiple Keys </b> (above)

##### Get All KV Pairs for KV Store

This take 1 parameter

```php
KVPair::getKVPairByGroups()
```

- 1st Parameter : forDropDown - boolean (optional, false by default)

The output follows the same pattern as defined in <b>Get By Multiple Keys </b> (above)

#### Deleting  KV Pair from store

You can delete KV Pair from store in 5 ways

- Delete By Single Key
- Delete By Multiple Keys
- Delete By Single Group
- Delete By Multiple Groups
- Delete All KV pair from store

##### Delete By Single Key

This take 1 parameter i.e key

```php
KVPair::deleteKVPairByKey($key)
```

- 1st Parameter : key - the key name

This function will return true or false. While True stands for successful addition, False stands for failure.
False will be returned if

- KV pair don't exists in the store
- The parameter is not passed

##### Delete By Multiple Key

This take 1 parameter

```php
KVPair::deleteKVPairByKeys($keys)
```

- 1st Parameter : key - array of key names

This function will return true or false.While True stands for successful addition, False stands for failure.
False will be returned if

- KV pair don't exists in the store
- The parameter is not passed

##### Delete By Single Group

This take 1 parameter

```php
KVPair::deleteKVPairByGroup($group)
```

- 1st Parameter : group - name of the group

This function will return true or false.While True stands for successful addition, False stands for failure.
False will be returned if

- KV pair don't exists in the store
- The parameter is not passed

##### Delete By Single Group

This take 1 parameter

```php
KVPair::deleteKVPairByGroups($groups)
```

- 1st Parameter : group - name of the group

This function will return true or false.While True stands for successful addition, False stands for failure.
False will be returned if

- KV pair don't exists in the store
- The parameter is not passed

##### Delete All KV pair from store

This take no parameter

```php
KVPair::deleteAllKVPair()
```


This function will return true or false.While True stands for successful addition, False stands for failure.
False will be returned if

- KV store is already empty

#### Counting KV Pair in the store

You can delete KV Pair from store in 3 ways

- Count By Single Group
- Count By Multiple Groups
- Count All KV pair in the store

##### Count By Single Group

This take 1 parameter

```php
KVPair::countKVPairByGroup($group)
```

- 1st Parameter : group - name of the group

This function will return the integer value.

##### Count By Multiple Groups

This take 1 parameter

```php
KVPair::countKVPairByGroups($groups)
```

- 1st Parameter : group - array of group names

This function will return the integer value.

##### Count All KV pair in the store

This take no parameter

```php
KVPair::countAllKVPair()
```

This function will return the integer value.

## Configuration
This package has 2 configurations which developer can set based on their choice.

- alwaysGetForDropdown
- selectKey

##### alwaysGetForDropdown
If this is set to TRUE all the get functions (except getKVPairByKey) will give the output ready to
bind with select html control by default. The $forDropDown parameter passed will be ignored

##### selectKey
 Value assigned to this will used as a key for select when rendering the get function for dropdown.

### How to configure
To set your configurations , you have to publish the config file using artisan command.

```php
php artisan vendor:publish --tag=config
```


Now the configuration file get copied to /config folder.You can set your preference here.

## Multilingual

This package support multiple language for "select" during the output for dropdown.The translations are take from the language files based on the setting of locale in /Config/app.php.

To start with you can run following publish command to get the default language files of this package.

```php
php artisan vendor:publish --tag=lang
```

Now the language files get copied to /resources/lang folder. You can add more languages from here by creating individual folder for each language and adding kvpair_lang.php under them.

For now this package creates language file for english and kannada (indian language)