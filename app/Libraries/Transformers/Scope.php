<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Transformers;

use App\Transformers\TransformerAbstract;
use InvalidArgumentException;
use League\Fractal;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\NullResource;
use League\Fractal\Serializer\SerializerAbstract;

class Scope extends Fractal\Scope
{
    /**
     * {@inheritdoc}
     */
    protected function executeResourceTransformers()
    {
        $transformer = $this->resource->getTransformer();
        $data = $this->resource->getData();

        $transformedData = $includedData = [];

        if ($this->resource instanceof Item) {
            [$transformedData, $includedData[]] = $this->fireTransformer($transformer, $data);
        } elseif ($this->resource instanceof Collection) {
            foreach ($data as $value) {
                [$itemTransformedData, $itemIncludedData] = $this->fireTransformer($transformer, $value);
                if ($itemTransformedData !== null) {
                    $transformedData[] = $itemTransformedData;
                    $includedData[] = $itemIncludedData;
                }
            }
        } elseif ($this->resource instanceof NullResource) {
            $transformedData = null;
            $includedData = [];
        } else {
            throw new InvalidArgumentException(
                'Argument $resource should be an instance of League\Fractal\Resource\Item'
                .' or League\Fractal\Resource\Collection'
            );
        }

        return [$transformedData, $includedData];
    }

    /**
     * {@inheritdoc}
     */
    protected function fireTransformer($transformer, $data)
    {
        if ($transformer instanceof TransformerAbstract) {
            $permission = $transformer->getRequiredPermission();
            if ($permission !== null && !priv_check($permission, $data)->can()) {
                return [null, []];
            }
        }

        [$transformedData, $includedData] = parent::fireTransformer($transformer, $data);

        if (empty($transformedData) && empty($includedData)) {
            return [null, []];
        }

        return [$transformedData, $includedData];
    }

    protected function serializeResource(SerializerAbstract $serializer, $data)
    {
        if ($data === null) {
            return;
        }

        return parent::serializeResource($serializer, $data);
    }
}
