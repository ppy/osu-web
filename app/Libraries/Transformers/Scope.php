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
use League\Fractal\Serializer\Serializer;

class Scope extends Fractal\Scope
{
    /**
     * {@inheritdoc}
     *
     * Exactly the same as overridden function but with a $data !== null check before injectAvailableIncludeData.
     */
    public function toArray(): ?array
    {
        [$rawData, $rawIncludedData] = $this->executeResourceTransformers();

        $serializer = $this->manager->getSerializer();

        $data = $this->serializeResource($serializer, $rawData);

        // If the serializer wants the includes to be side-loaded then we'll
        // serialize the included data and merge it with the data.
        if ($serializer->sideloadIncludes()) {
            //Filter out any relation that wasn't requested
            $rawIncludedData = array_map([$this, 'filterFieldsets'], $rawIncludedData);

            $includedData = $serializer->includedData($this->resource, $rawIncludedData);

            // If the serializer wants to inject additional information
            // about the included resources, it can do so now.
            $data = $serializer->injectData($data, $rawIncludedData);

            if ($this->isRootScope()) {
                // If the serializer wants to have a final word about all
                // the objects that are sideloaded, it can do so now.
                $includedData = $serializer->filterIncludes(
                    $includedData,
                    $data
                );
            }

            $data = $data + $includedData;
        }

        if ($data !== null && !empty($this->availableIncludes)) {
            $data = $serializer->injectAvailableIncludeData($data, $this->availableIncludes);
        }

        if ($this->resource instanceof Collection) {
            if ($this->resource->hasCursor()) {
                $pagination = $serializer->cursor($this->resource->getCursor());
            } elseif ($this->resource->hasPaginator()) {
                $pagination = $serializer->paginator($this->resource->getPaginator());
            }

            if (!empty($pagination)) {
                $this->resource->setMetaValue(key($pagination), current($pagination));
            }
        }

        // Pull out all of OUR metadata and any custom meta data to merge with the main level data
        $meta = $serializer->meta($this->resource->getMeta());

        // in case of returning NullResource we should return null and not to go with array_merge
        if (is_null($data)) {
            if (!empty($meta)) {
                return $meta;
            }
            return null;
        }

        return $data + $meta;
    }

    protected function executeResourceTransformers(): array
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

    protected function fireTransformer($transformer, $data): array
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

    protected function serializeResource(Serializer $serializer, $data): ?array
    {
        if ($data === null) {
            return null;
        }

        return parent::serializeResource($serializer, $data);
    }
}
