<?php
if (!defined('TYPO3')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'JhSimpleYoutube',
	'Pi1',
	array(
		\JonathanHeilmann\JhSimpleYoutube\Controller\VideoController::class => 'show',
	),
	// non-cacheable actions
	array(

	)
);

// Caching
if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['jh_simple_youtube']))
{
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['jh_simple_youtube'] = array();
}
if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['jh_simple_youtube']['groups']))
{
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['jh_simple_youtube']['groups'] = array('pages', 'all');
}