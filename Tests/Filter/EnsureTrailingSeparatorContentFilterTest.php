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

use Phlexible\Component\Bundler\Filter\EnsureTrailingSeparatorContentFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Phlexible\Component\Bundler\Filter\EnsureTrailingSeparatorContentFilter
 */
class EnsureTrailingSeparatorContentFilterTest extends TestCase
{
    public function testFilter()
    {
        $filter = new EnsureTrailingSeparatorContentFilter("\n");

        $this->assertSame("hello world!\n", $filter->filter('hello world!'));
        $this->assertSame("hello world!\n", $filter->filter("hello world!\n"));
    }
}
