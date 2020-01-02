# DataFixerContentful Module
[![Build Status](https://travis-ci.org/fond-of/spryker-data-fixer-contentful.svg?branch=master)](https://travis-ci.org/fond-of/spryker-data-fixer-contentful)
[![PHP from Travis config](https://img.shields.io/travis/php-v/symfony/symfony.svg)](https://php.net/)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-spryker/data-fixer-contentful)

## Installation

```
composer require fond-of-spryker/data-fixer-contentful
```

Register ContentfulDataFixerPlugin and ContentfulPageSearchDataFixerPlugin in DataFixerDependencyProvider

```
/**
 * @param \Spryker\Zed\Kernel\Container $container
 *
 * @return array
 */
public function getDataFixer(Container $container): array
{
    return [
        new ContentfulDataFixerPlugin(),
        new ContentfulPageSearchDataFixerPlugin(),
    ];
}
```
