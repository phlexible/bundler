<?php

/*
 * This file is part of the phlexible bundler package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phlexible\Component\Bundler\ContentBuilder;

use Phlexible\Component\Bundler\Content\MappedContent;
use Phlexible\Component\Bundler\Filter\ContentFilterInterface;
use Phlexible\Component\Bundler\ResourceResolver\ResolvedResources;
use Phlexible\Component\Bundler\SourceMap\SourceMapBuilder;

/**
 * Mapped content builder.
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class MappedContentBuilder
{
    /**
     * @var ContentFilterInterface
     */
    private $filter;

    /**
     * MappedContentBuilder constructor.
     *
     * @param ContentFilterInterface $filter
     */
    public function __construct(ContentFilterInterface $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @param string            $name
     * @param ResolvedResources $resources
     * @param callable          $sanitizePath
     * @param callable|null     $prefixContent
     * @param callable|null     $filterContent
     *
     * @return MappedContent
     */
    public function build($name, ResolvedResources $resources, $sanitizePath = null, $prefixContent = null, $filterContent = null)
    {
        $line = 0;
        $content = '';
        if (is_callable($prefixContent)) {
            $content .= $this->filter->filter($prefixContent($resources));
            $line = substr_count($content, PHP_EOL) + 1;
        }
        $sourceMapBuilder = new SourceMapBuilder($name, $line);

        foreach ($resources->getResources() as $resource) {
            $fileContent = $this->filter->filter($resource->getBody());
            $content .= $fileContent;

            $path = $resource->getPath();
            if (is_callable($sanitizePath)) {
                $path = $sanitizePath($path);
            }

            $sourceMapBuilder->add($path, $fileContent);
        }

        $map = $sourceMapBuilder->getSourceMap();

        if (is_callable($filterContent)) {
            $content = $filterContent($content);
        }

        return new MappedContent($content, $map->toJson());
    }
}
