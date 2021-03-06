<?php

/*
 * This file is part of the phlexible bundler package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phlexible\Component\Bundler\Content;

use Symfony\Component\Config\Resource\ResourceInterface;

/**
 * Resource content.
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class ResourceContent
{
    /**
     * @var string
     */
    private $content;

    /**
     * @var ResourceInterface[]
     */
    private $resources;

    /**
     * @param string              $content
     * @param ResourceInterface[] $resources
     */
    public function __construct($content, array $resources)
    {
        $this->content = $content;

        foreach ($resources as $resource) {
            $this->addResource($resource);
        }
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param ResourceInterface $resource
     */
    private function addResource(ResourceInterface $resource)
    {
        $this->resources[] = $resource;
    }

    /**
     * @return ResourceInterface[]
     */
    public function getResources()
    {
        return $this->resources;
    }
}
