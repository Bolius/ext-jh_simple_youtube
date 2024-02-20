<?php
if (!defined('TYPO3')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'jh_simple_youtube',
	'Pi1',
	'Simple Youtube'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('jh_simple_youtube', 'Configuration/TypoScript', 'Simple Youtube');

$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase('jh_simple_youtube');
$pluginSignature = strtolower($extensionName) . '_pi1';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.'jh_simple_youtube'.'/Configuration/FlexForms/contentPlugin.xml');
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,pages,recursive';