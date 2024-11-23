# Zerotoprod\Psr4Classname

![](./logo.png)

[![Repo](https://img.shields.io/badge/github-gray?logo=github)](https://github.com/zero-to-prod/psr4-classname)
[![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/zero-to-prod/psr4-classname/test.yml?label=tests)](https://github.com/zero-to-prod/psr4-classname/actions)
[![Packagist Downloads](https://img.shields.io/packagist/dt/zero-to-prod/psr4-classname?color=blue)](https://packagist.org/packages/zero-to-prod/psr4-classname/stats)
[![php](https://img.shields.io/packagist/php-v/zero-to-prod/psr4-classname.svg?color=purple)](https://packagist.org/packages/zero-to-prod/psr4-classname/stats)
[![Packagist Version](https://img.shields.io/packagist/v/zero-to-prod/psr4-classname?color=f28d1a)](https://packagist.org/packages/zero-to-prod/psr4-classname)
[![License](https://img.shields.io/packagist/l/zero-to-prod/psr4-classname?color=pink)](https://github.com/zero-to-prod/psr4-classname/blob/main/LICENSE.md)

A regular expression to check an Email string.

## Installation

Install the package via Composer:

```bash
composer require zero-to-prod/psr4-classname
```

## Usage

```php
use Zerotoprod\Psr4Classname\Classname;

Classname::generate('weird%characters*in^name', '.php'); // 'WeirdCharactersInName.php';
```
