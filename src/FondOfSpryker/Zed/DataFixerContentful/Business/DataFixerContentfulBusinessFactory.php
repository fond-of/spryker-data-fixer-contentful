<?php

namespace FondOfSpryker\Zed\DataFixerContentful\Business;

use FondOfSpryker\Zed\DataFixer\Business\Dependency\DataFixerInterface;
use FondOfSpryker\Zed\DataFixerContentful\Business\Fixer\ContentfulPageSearchDataFixer;
use FondOfSpryker\Zed\DataFixerContentful\DataFixerContentfulDependencyProvider;
use FondOfSpryker\Zed\Product\Business\ProductFacadeInterface;
use Spryker\Client\AvailabilityStorage\AvailabilityStorageClientInterface;
use Spryker\Shared\KeyBuilder\KeyBuilderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\DataFixerContentful\DataFixerContentfulConfig getConfig()
 */
class DataFixerContentfulBusinessFactory extends AbstractBusinessFactory
{
    
}
