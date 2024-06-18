# Learning Management System Aplication Starter

## What is Learning Management System?

Work to be done...

## Setup

On the first time the repo is cloned, do these in order:

1. Run `composer install`.
2. Copy `env` to `.env` and tailor for your app, specifically the baseURL and any database settings.
3. Run `php spark migrate`.
4. Run `php spark db:seed DataSeeder`.
5. Run `php spark schemas -draft database,model,directory`.

## Server Requirements

PHP version 8.1 or higher is required.
