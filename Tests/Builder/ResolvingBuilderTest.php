<?php

/*
 * This file is part of the phlexible bundler package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phlexible\Component\Bundler\Tests\Asset\Builder;

use org\bovigo\vfs\vfsStream;
use Phlexible\Component\Bundler\Asset\MappedAsset;
use Phlexible\Component\Bundler\Builder\ResolvingBuilder;
use Phlexible\Component\Bundler\Compressor\CompressorInterface;
use Phlexible\Component\Bundler\Content\MappedContent;
use Phlexible\Component\Bundler\ContentBuilder\MappedContentBuilder;
use Phlexible\Component\Bundler\Finder\ResourceFinderInterface;
use Phlexible\Component\Bundler\ResourceResolver\ResolvedResources;
use Phlexible\Component\Bundler\ResourceResolver\ResourceResolverInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

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
/**
 * @covers \Phlexible\Component\Bundler\Builder\ResolvingBuilder
 */
class ResolvingBuilderTest extends TestCase
{
    public function testBuild()
    {
        $root = vfsStream::setup('phlexible');

        $finder = $this->prophesize(ResourceFinderInterface::class);
        $finder->findByType('test/test')->willReturn(array());

        $resolver = $this->prophesize(ResourceResolverInterface::class);
        $resolver->resolve(array())->willReturn(new ResolvedResources(array(), array()));

        $builder = $this->prophesize(MappedContentBuilder::class);
        $builder->build(Argument::cetera())->willReturn(new MappedContent('a', 'b'));

        $compressor = $this->prophesize(CompressorInterface::class);

        $builder = new TestBuilder(
            $finder->reveal(),
            $resolver->reveal(),
            $builder->reveal(),
            $compressor->reveal(),
            $root->url(),
            false
        );

        $result = $builder->build();

        $this->assertFileExists($root->getChild('test.txt')->url());
        $this->assertFileExists($root->getChild('test.txt.map')->url());

        $expected = new MappedAsset($root->getChild('test.txt')->url(), $root->getChild('test.txt.map')->url());
        $this->assertEquals($expected, $result);
    }
}
