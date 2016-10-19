<?php

/*
 * This file is part of the phlexible bundler package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phlexible\Component\Bundler\Translation;

use Symfony\Component\Translation\MessageCatalogueInterface;

/**
 * Translation extractor interface
 *
 * @author Stephan Wentz <swentz@brainbits.net>
 */
interface TranslationExtractorInterface
{
    /**
     * @param MessageCatalogueInterface $fallbackCatalogue
     * @param string                    $domain
     *
     * @return array
     */
    public function extract(MessageCatalogueInterface $fallbackCatalogue, $domain);
}
