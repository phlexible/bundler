<?php

/*
 * This file is part of the phlexible bundler package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phlexible\Component\Bundler\Tests\ContentBuilder;

use org\bovigo\vfs\vfsStream;
use Phlexible\Component\Bundler\Content\MappedContent;
use Phlexible\Component\Bundler\ContentBuilder\MappedContentBuilder;
use Phlexible\Component\Bundler\Filter\ContentFilterInterface;
use Phlexible\Component\Bundler\ResourceResolver\ResolvedResources;
use Phlexible\Component\Bundler\SourceMap\SourceMap;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Puli\Repository\Resource\FileResource;

/**
 * @covers \Phlexible\Component\Bundler\ContentBuilder\MappedContentBuilder
 */
class MappedContentBuilderTest extends TestCase
{
    /**
     * @var MappedContentBuilder
     */
    private $builder;

    public function setUp()
    {
        $filter = $this->prophesize(ContentFilterInterface::class);
        $filter->filter(Argument::any())->will(function($arg) {
            return $arg[0].PHP_EOL;
        });

        $this->builder = new MappedContentBuilder($filter->reveal());
    }

    public function testBuildCreatedMappedContent()
    {
        $root = vfsStream::setup();
        $jsFile = vfsStream::newFile('js/file.js')->at($root)->setContent('console.log(123);');

        $result = $this->builder->build(
            'test',
            new ResolvedResources(array(
                new FileResource($jsFile->url(), $jsFile->path()),
            ))
        );

        $expected = new MappedContent(
            'console.log(123);'.PHP_EOL,
            (new SourceMap(
                'test', '', array($jsFile->path()), array($jsFile->getContent().PHP_EOL), array(), 'AAAA;'
            ))->toJson()
        );

        $this->assertEquals($expected, $result);
    }

    public function testBuildCallsSanitizePathCallback()
    {
        $root = vfsStream::setup();
        $jsFile = vfsStream::newFile('js/file.js')->at($root)->setContent('console.log(123);');

        $result = $this->builder->build(
            'test',
            new ResolvedResources(array(
                new FileResource($jsFile->url(), $jsFile->path()),
            )),
            function() {
                return 'sanitizedPath';
            }
        );

        $expected = new MappedContent(
            'console.log(123);'.PHP_EOL,
            (new SourceMap(
                'test', '', array('sanitizedPath'), array($jsFile->getContent().PHP_EOL), array(), 'AAAA;'
            ))->toJson()
        );

        $this->assertEquals($expected, $result);
    }

    public function testBuildCallsPrefixContentCallback()
    {
        $root = vfsStream::setup();
        $jsFile = vfsStream::newFile('js/file.js')->at($root)->setContent('console.log(123);');

        $result = $this->builder->build(
            'test',
            new ResolvedResources(array(
                new FileResource($jsFile->url(), $jsFile->path()),
            )),
            null,
            function() {
                return 'PREFIX'.PHP_EOL;
            }
        );

        $expected = new MappedContent(
            'PREFIX'.PHP_EOL.PHP_EOL.'console.log(123);'.PHP_EOL,
            (new SourceMap(
                'test', '', array($jsFile->path()), array($jsFile->getContent().PHP_EOL), array(), ';;AAAA;'
            ))->toJson()
        );

        $this->assertEquals($expected, $result);
    }

    public function testBuildCallsFilterContentCallback()
    {
        $root = vfsStream::setup();
        $jsFile = vfsStream::newFile('js/file.js')->at($root)->setContent('console.log(123);');

        $result = $this->builder->build(
            'test',
            new ResolvedResources(array(
                new FileResource($jsFile->url(), $jsFile->path()),
            )),
            null,
            null,
            function() {
                return 'FILTERED'.PHP_EOL;
            }
        );

        $expected = new MappedContent(
            'FILTERED'.PHP_EOL,
            (new SourceMap(
                'test', '', array($jsFile->path()), array($jsFile->getContent().PHP_EOL), array(), 'AAAA;'
            ))->toJson()
        );

        $this->assertEquals($expected, $result);
    }
}
