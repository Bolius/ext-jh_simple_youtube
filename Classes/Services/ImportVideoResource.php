<?php
namespace JonathanHeilmann\JhSimpleYoutube\Services;

use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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

class ImportVideoResource {

    /**
     * Imports video resource from path
     *
     * @param string $path
     * @return array
     */
    public function import($path = '')
    {
        $report = array();
        $getUrlResult = GeneralUtility::getUrl($path, 0, false, $report);
        return array(
            'success' => boolval($getUrlResult),
            'import' => boolval($getUrlResult) ? $getUrlResult : 'Could not import path "' . $path . '" <br/> Message: ' . $report['message']
        );
    }

    /**
     * Gets a cache identifier for data
     *
     * @param array $data
     * @param array $additionalData
     * @return string
     */
    public function getCacheIdentifier($data = array(), $additionalData = array())
    {
        ArrayUtility::mergeRecursiveWithOverrule($data, $additionalData);
        return md5(serialize($data));
    }
}