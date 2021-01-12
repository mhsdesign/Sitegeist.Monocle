<?php declare(strict_types=1);
namespace Sitegeist\Monocle\Domain\PrototypeDetails;

/**
 * This file is part of the Sitegeist.Monocle package
 *
 * (c) 2020
 * Martin Ficzel <ficzel@sitegeist.de>
 * Wilhelm Behncke <behncke@sitegeist.de>
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Neos\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
final class AnatomyFactory
{
    /**
     * @param PrototypeName $prototypeName
     * @param FusionPrototypeAst $fusionPrototypeAst
     * @return Anatomy
     */
    public function fromPrototypeNameAndFusionPrototypeAstForPrototypeDetails(
        PrototypeName $prototypeName,
        FusionPrototypeAst $fusionPrototypeAst
    ): Anatomy {
        $children = [];
        $referencedFusionObjects = $fusionPrototypeAst
            ->getAllReferencedFusionObjects();

        foreach ($referencedFusionObjects as $fusionObjectAst) {
            $children[] = $this->fromFusionObjectAstForPrototypeDetails(
                $fusionObjectAst
            );
        }

        return new Anatomy($prototypeName, $children);
    }

    /**
     * @param FusionObjectAst $fusionObjectAst
     * @return Anatomy
     */
    public function fromFusionObjectAstForPrototypeDetails(
        FusionObjectAst $fusionObjectAst
    ): Anatomy {
        $children = [];
        $referencedFusionObjects = $fusionObjectAst
            ->getAllReferencedFusionObjects();

        foreach ($referencedFusionObjects as $childFusionObjectAst) {
            $children[] = $this->fromFusionObjectAstForPrototypeDetails(
                $childFusionObjectAst
            );
        }

        return new Anatomy(
            $fusionObjectAst->getPrototypeName(),
            $children
        );
    }
}
