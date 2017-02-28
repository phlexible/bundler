<?php

/*
 * This file is part of the phlexible bundler package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phlexible\Component\Bundler\Tests\Fixture;

use Phlexible\Component\Bundler\Builder\ResolvingBuilder;
use Phlexible\Component\Bundler\ResourceResolver\ResolvedResources;

class TestBuilder extends ResolvingBuilder
{
    protected function getFilename()
    {
        return 'test.txt';
    }

    protected function getType()
    {
        return 'test/test';
    }

    protected function sanitizePath($path)
    {
        return $path;
    }

    protected function prefixContent(ResolvedResources $resources)
    {
        return '';
    }
}
