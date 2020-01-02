<?php

namespace FondOfSpryker\Zed\DataFixerContentful\Communication;

use FondOfSpryker\Zed\ContentfulPageSearch\Business\ContentfulPageSearchFacadeInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\ContentfulStorageFacadeInterface;
use FondOfSpryker\Zed\DataFixer\Business\Dependency\DataFixerInterface;
use FondOfSpryker\Zed\DataFixerContentful\Business\Fixer\ContentfulDataFixer;
use FondOfSpryker\Zed\DataFixerContentful\Business\Fixer\ContentfulPageSearchDataFixer;
use FondOfSpryker\Zed\DataFixerContentful\DataFixerContentfulDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\Store\Business\StoreFacadeInterface;

/**
 * @method \FondOfSpryker\Zed\DataFixerContentful\DataFixerContentfulConfig getConfig()
 * @method \FondOfSpryker\Zed\DataFixerContentful\Persistence\DataFixerContentfulQueryContainer getQueryContainer()
 * @method \FondOfSpryker\Zed\DataFixerContentful\Business\DataFixerContentfulFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\DataFixerContentful\Persistence\DataFixerContentfulRepositoryInterface getRepository()
 */
class DataFixerContentfulCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfSpryker\Zed\DataFixer\Business\Dependency\DataFixerInterface
     */
    public function createContentfulDataFixer(): DataFixerInterface
    {
        return new ContentfulDataFixer(
            $this->getRepository(),
            $this->getConfig(),
            $this->getStoreFacade(),
            $this->getContentfulStorageFacade(),
            $this->getContentfulPagesearchFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\DataFixer\Business\Dependency\DataFixerInterface
     */
    public function createContentfulPageSearchDataFixer(): DataFixerInterface
    {
        return new ContentfulPageSearchDataFixer(
            $this->getRepository(),
            $this->getConfig(),
            $this->getStoreFacade(),
            $this->getContentfulPagesearchFacade()
        );
    }

    /**
     * @return \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    public function getStoreFacade(): StoreFacadeInterface
    {
        return $this->getProvidedDependency(DataFixerContentfulDependencyProvider::FACADE_STORE);
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulPageSearch\Business\ContentfulPageSearchFacadeInterface
     */
    public function getContentfulPagesearchFacade(): ContentfulPageSearchFacadeInterface
    {
        return $this->getProvidedDependency(DataFixerContentfulDependencyProvider::FACADE_CONTENTFUL_PAGESEARCH);
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\ContentfulStorageFacadeInterface
     */
    public function getContentfulStorageFacade(): ContentfulStorageFacadeInterface
    {
        return $this->getProvidedDependency(DataFixerContentfulDependencyProvider::FACADE_CONTENTFUL_STORAGE);
    }
}
