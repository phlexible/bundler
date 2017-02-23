<?php

/*
 * This file is part of the phlexible bundler package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phlexible\Component\Bundler\Tests\ResourceResolver;

use Phlexible\Component\Bundler\ResourceResolver\ResolvedResources;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Phlexible\Component\Bundler\ResourceResolver\ResolvedResources
 */
class ResolvedResourcesTest extends TestCase
{
    public function testResolvedResources()
    {
        $resolvedResources = new ResolvedResources(array('foo'), array('bar'));

        $this->assertSame(array('foo'), $resolvedResources->getResources());
        $this->assertSame(array('bar'), $resolvedResources->getUnusedResources());
    }
}
