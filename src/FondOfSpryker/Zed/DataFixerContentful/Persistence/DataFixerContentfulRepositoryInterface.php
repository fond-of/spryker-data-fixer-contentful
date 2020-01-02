<?php

namespace FondOfSpryker\Zed\DataFixerContentful\Persistence;

use Generated\Shared\Transfer\DataFixerContentfulCriteriaFilterTransfer;

interface DataFixerContentfulRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\DataFixerContentfulCriteriaFilterTransfer $criteriaFilterTransfer
     *
     * @return \Orm\Zed\ContentfulPageSearch\Persistence\FosContentfulPageSearch[]
     */
    public function getWrongStoreContentfulPageSearchEntries(
        DataFixerContentfulCriteriaFilterTransfer $criteriaFilterTransfer
    ): array;

    /**
     * @param \Generated\Shared\Transfer\DataFixerContentfulCriteriaFilterTransfer $criteriaFilterTransfer
     *
     * @return \Orm\Zed\Contentful\Persistence\FosContentful[]
     */
    public function getWrongStoreContentfulEntries(
        DataFixerContentfulCriteriaFilterTransfer $criteriaFilterTransfer
    ): array;
}
