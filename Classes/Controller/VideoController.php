<?php
namespace TYPO3\JhSimpleYoutube\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013-2017 Jonathan Heilmann <mail@jonathan-heilmann.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 *
 *
 * @package jh_simple_youtube
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class VideoController extends ActionController {

    /**
     *
     */
    private $extensionKey = 'jh_simple_youtube';

    /**
     * ImportVideoResource
     *
     * @var \JonathanHeilmann\JhSimpleYoutube\Services\ImportVideoResource
     * @inject
     */
    protected $importVideoResource = null;

    /**
     * action show
     *
     * @return void
     * @throws \Exception
     */
	public function showAction() {
		$viewAssign = array();

		// add css file
		if(!empty($this->settings['cssFile'])) {
			$filename = $this->settings['cssFile'];
			// resolve EXT: to path
			if (substr($filename, 0, 4) == 'EXT:') {
				list($extKey, $local) = explode('/', substr($filename, 4), 2);
				$filename = '';
				if (strcmp($extKey, '') && ExtensionManagementUtility::isLoaded($extKey) && strcmp($local, '')) {
					$filename = ExtensionManagementUtility::siteRelPath($extKey) . $local;
				}
			}
			if(!empty($filename)) $this->response->addAdditionalHeaderData($this->wrapCssFile($filename));
		}

		// get default settings from template-setup
		$viewAssign['width'] = $this->settings['width'];
		$viewAssign['height'] = $this->settings['height'];

		// get settings flexform (flexform overrides template-setup if available)
		$viewAssign['id'] = $this->settings['id'];
		if(!empty($this->settings['flex_width'])) {$viewAssign['width'] = $this->settings['flex_width'];}
		if(!empty($this->settings['flex_height'])) {$viewAssign['height'] = $this->settings['flex_height'];}

		// calculate padding-bottom inline-style for video-container
		$viewAssign['paddingBottom'] = ($viewAssign['height'] / $viewAssign['width']) * 100;

		// get player parameters
		$playerParameters = '';
		$enableHtml5 = false;
		$viewAssign['allowfullscreen'] = '';
		// html5
		if(($this->settings['flex_html5'] == -1 && $this->settings['html5'] == 1) || $this->settings['flex_html5'] == 1) {
			$playerParameters .= '&html5=1';
			$enableHtml5 = true;
		}
		// end (end time in seconds - only supported in flash-player)
		/*if(!$enableHtml5 && !empty($this->settings[end])) {
			if(strstr($this->settings[end], ':')) {
				$endArray = explode(':', $this->settings[end]);
				$endSeconds = ($endArray[0] * 60) + $endArray[1];
				$playerParameters .= '&end='.$endSeconds;
			} else {
				$playerParameters .= '&end='.$this->settings[end];
			}
		}*/
		// fs (fullscreen)
		if (!$enableHtml5 && !$this->settings['allowfullscreen']) {
			$playerParameters .= '&fs=0';
		} else if ($enableHtml5 && $this->settings['allowfullscreen']){
			$viewAssign['allowfullscreen'] = 'allowfullscreen';
		}
		// rel (related videos)
		if($this->settings['rel'] == 0) {$playerParameters .= '&rel=0';}
		//start (start time in seconds)
		/*if(!empty($this->settings[start])) {
			if(strstr($this->settings[start], ':')) {
				$startArray = explode(':', $this->settings[start]);
				$startSeconds = ($startArray[0] * 60) + $startArray[1];
				$playerParameters .= '&start='.$startSeconds;
			} else {
				$playerParameters .= '&start='.$this->settings[start];
			}
		}*/
		// merge default- and custom-parameters
		$defaultPlayerParameters = $this->settings['defaultPlayerParameters'];
		$customPlayerParameters = GeneralUtility::explodeUrl2Array($this->settings['flex_customParameters']);
		$mergedPlayerParameters = array_merge($defaultPlayerParameters, $customPlayerParameters);

		$playerParameters .= '' . GeneralUtility::implodeArrayForUrl('', $mergedPlayerParameters);

		if($playerParameters != '') {
			// remove first '&' and prepend '?'
			$viewAssign['playerParameters'] = '?' . substr($playerParameters, 1);
		}

		// Get video resources
        $viewAssign['videoResources'] = $this->getVideoResources();

		// assign array to fluid-template
		$this->view->assignMultiple($viewAssign);
	}

    /**
     * Gets video resources
     *
     * @return mixed
     */
	private function getVideoResources()
    {
        if (!$this->settings['apiKey'])
            return false;

        $cObj = $this->configurationManager->getContentObject();

        $tags = array('pageId_' . $cObj->data['pid'], 'ceUid_' . $cObj->data['uid']);
        $cacheIdentifier = $this->importVideoResource->getCacheIdentifier($tags, $this->settings);
        if (($videoResources = GeneralUtility::makeInstance(CacheManager::class)->getCache($this->extensionKey)->get($cacheIdentifier)) === false)
        {
            $path = 'https://www.googleapis.com/youtube/v3/videos'.
                '?id=' . $this->settings['id'] .
                '&key=' . $this->settings['apiKey'] .
                '&part=' . $this->settings['videoResourceParts'] .
                ($this->settings['videoResourceFields'] ? '&fields=' . $this->settings['videoResourceFields'] : '');

            $importResult = $this->importVideoResource->import($path);

            if ($importResult['success'] === true) {
                $videoResources = json_decode($importResult['import'], true);
                GeneralUtility::makeInstance(CacheManager::class)
                    ->getCache($this->extensionKey)
                    ->set($cacheIdentifier, $videoResources, $tags, $this->settings['cachelifetimeSeconds']);
            }
        }

        return $videoResources;
    }

	/**
	 * wrapCssFile
	 *
	 * @param string $cssFile
	 * @return string
	 */
	private function wrapCssFile($cssFile) {
		$cssFile = GeneralUtility::resolveBackPath($cssFile);
		$cssFile = GeneralUtility::createVersionNumberedFilename($cssFile);
		return '<link rel="stylesheet" type="text/css" href="'.htmlspecialchars($cssFile).'" media="screen" />';
	}

}