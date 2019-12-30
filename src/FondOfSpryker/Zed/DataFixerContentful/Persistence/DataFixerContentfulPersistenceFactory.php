<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace FondOfSpryker\Zed\DataFixerContentful\Persistence;

use Orm\Zed\Contentful\Persistence\FosContentfulQuery;
use Orm\Zed\ContentfulPageSearch\Persistence\FosContentfulPageSearchQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\DataFixerContentful\DataFixerContentfulConfig getConfig()
 * @method \FondOfSpryker\Zed\DataFixerContentful\Persistence\DataFixerContentfulQueryContainer getQueryContainer()
 * @method \FondOfSpryker\Zed\DataFixerContentful\Persistence\DataFixerContentfulRepositoryInterface getRepository()
 * @method \FondOfSpryker\Zed\DataFixerContentful\Persistence\DataFixerContentfulEntityManagerInterface getEntityManager()
 */
class DataFixerContentfulPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ContentfulPageSearch\Persistence\FosContentfulPageSearchQuery
     */
    public function createContentfulPageSearchQuery(): FosContentfulPageSearchQuery
    {
        return new FosContentfulPageSearchQuery();
    }

    /**
     * @return \Orm\Zed\Contentful\Persistence\FosContentfulQuery
     */
    public function createContentfulQuery(): FosContentfulQuery
    {
        return new FosContentfulQuery();
    }
}
