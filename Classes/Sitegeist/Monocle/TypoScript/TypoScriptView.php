<?php
namespace Sitegeist\Monocle\TypoScript;

/**
 * This file is part of the Sitegeist.Monocle package
 *
 * (c) 2016
 * Martin Ficzel <ficzel@sitegeist.de>
 * Wilhelm Behncke <behncke@sitegeist.de>
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\TypoScript\View\TypoScriptView as BaseTypoScriptView;

/**
 * Class TypoScriptView
 * @package Sitegeist\Monocle\TypoScript
 */
class TypoScriptView extends BaseTypoScriptView
{
    /**
     * @Flow\Inject
     * @var \Sitegeist\Monocle\TypoScript\TypoScriptService
     */
    protected $typoScriptService;

    /**
     * Load TypoScript from the directories specified by $this->getOption('typoScriptPathPatterns')
     *
     * @return void
     */
    protected function loadTypoScript()
    {
        $fusionAst = $this->typoScriptService->getMergedTypoScriptObjectTreeForSitePackage($this->getOption('packageKey'));
        $this->parsedTypoScript = $fusionAst;
    }
}