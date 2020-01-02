<?php

namespace FondOfSpryker\Zed\DataFixerContentful\Communication\Plugin;

use FondOfSpryker\Zed\DataFixer\Business\Dependency\DataFixerInterface;
use FondOfSpryker\Zed\DataFixer\Business\Dependency\DataFixerPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * Class ContentfulPageSearchDataFixerPlugin
 *
 * @package FondOfSpryker\Zed\DataFixerContentful\Communication\Plugin
 *
 * @method \FondOfSpryker\Zed\DataFixerContentful\Communication\DataFixerContentfulCommunicationFactory getFactory()
 * @method \FondOfSpryker\Zed\DataFixerContentful\Business\DataFixerContentfulFacade getFacade()
 * @method \FondOfSpryker\Zed\DataFixerContentful\DataFixerContentfulConfig getConfig()
 * @method \FondOfSpryker\Zed\DataFixerContentful\Persistence\DataFixerContentfulQueryContainerInterface getQueryContainer()
 */
class ContentfulDataFixerPlugin extends AbstractPlugin implements DataFixerPluginInterface
{
    /**
     * @return \FondOfSpryker\Zed\DataFixer\Business\Dependency\DataFixerInterface
     */
    public function getDataFixer(): DataFixerInterface
    {
        return $this->getFactory()->createContentfulDataFixer();
    }
}
