<?php

/*
 * This file is part of the phlexible bundler package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phlexible\Component\Bundler\ResourceResolver;

use Puli\Repository\Resource\FileResource;

/**
 * Resource resolver interface
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
interface ResourceResolverInterface
{
    /**
     * @param FileResource[] $resources
     *
     * @return ResolvedResources
     */
    public function resolve(array $resources);
}
