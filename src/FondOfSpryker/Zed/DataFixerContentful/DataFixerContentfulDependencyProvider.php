<?php

namespace FondOfSpryker\Zed\DataFixerContentful;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class DataFixerContentfulDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_STORE = 'FACADE_STORE';
    public const FACADE_CONTENTFUL_PAGESEARCH = 'FACADE_CONTENTFUL_PAGESEARCH';
    public const FACADE_CONTENTFUL_STORAGE = 'FACADE_CONTENTFUL_STORAGE';

    /**
     * @param  \Spryker\Zed\Kernel\Container  $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        return $container;
    }

    /**
     * @param  \Spryker\Zed\Kernel\Container  $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container = $this->addStoreFacade($container);
        $container = $this->addContentfulPagesearchFacade($container);
        $container = $this->addContentfulStorageFacade($container);
        return $container;
    }

    /**
     * @param  \Spryker\Zed\Kernel\Container  $container
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStoreFacade(Container $container): Container
    {
        $container[static::FACADE_STORE] = function (Container $container) {
            return $container->getLocator()->store()->facade();
        };

        return $container;
    }

    /**
     * @param  \Spryker\Zed\Kernel\Container  $container
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addContentfulPagesearchFacade(Container $container): Container
    {
        $container[static::FACADE_CONTENTFUL_PAGESEARCH] = function (Container $container) {
            return $container->getLocator()->contentfulPageSearch()->facade();
        };

        return $container;
    }

    /**
     * @param  \Spryker\Zed\Kernel\Container  $container
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addContentfulStorageFacade(Container $container): Container
    {
        $container[static::FACADE_CONTENTFUL_STORAGE] = function (Container $container) {
            return $container->getLocator()->contentfulStorage()->facade();
        };

        return $container;
    }
}
