<?php

/*
 * This file is part of the phlexible bundler package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phlexible\Component\Bundler\Tests\Filter;

use Phlexible\Component\Bundler\Filter\ChainContentFilter;
use Phlexible\Component\Bundler\Filter\ContentFilterInterface;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Phlexible\Component\Bundler\Filter\ChainContentFilter
 */
class ChainContentFilterTest extends TestCase
{
    public function testFilterBasePath()
    {
        $filter1 = $this->prophesize(ContentFilterInterface::class);
        $filter1->filter('foo')->shouldBeCalled()->willReturn('bar');
        $filter2 = $this->prophesize(ContentFilterInterface::class);
        $filter2->filter('bar')->shouldBeCalled()->willReturn('baz');

        $filter = new ChainContentFilter(array($filter1->reveal(), $filter2->reveal()));

        $result = $filter->filter('foo');

        $this->assertSame('baz', $result);
    }
}
