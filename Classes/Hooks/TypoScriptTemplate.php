<?php
namespace TYPO3\CMS\T3Startup\Hooks;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 kontakt@gebruederheitz.de
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

/**
 * Handling the inclusion of static templates from extensions by using a hook in
 * $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tstemplate.php']['includeStaticTypoScriptSources']
 *
 * @see http://blog.causal.ch/2012/05/automatically-including-static-ts-from.html
 */
class TypoScriptTemplate implements \TYPO3\CMS\Core\SingletonInterface {

	/**
	 * Static template of this extension
	 */
	const SELF_DEVELOPMENT_TEMPLATE = 'fileadmin/Setup/Configuration/Development';

	/**
	 * Path of static templates from extensions
	 *
	 * @var array
	 */
	protected $staticTemplates = array();

	/**
	 * Path of custom templates
	 *
	 * @var array
	 */
	protected $customTemplates = array();

	/**
	 * Get an instance of TypoScript Template
	 *
	 * @return \TYPO3\CMS\T3Startup\Hooks\TypoScriptTemplate
	 */
	public static function getInstance() {
		return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\T3Startup\Hooks\TypoScriptTemplate');
	}

	/**
	 * Includes static template from extensions
	 *
	 * @param array $params
	 * @param t3lib_TStemplate $pObj
	 * @return void
	 */
	public function preprocessIncludeStaticTypoScriptSources(array $params, \TYPO3\CMS\Core\TypoScript\TemplateService $pObj) {
		if (isset($params['row']['root'])) {
			// Add development static templates
			$settings = \TYPO3\CMS\T3Startup\Utility\Configuration::getInstance()->getSettings();
			$staticTemplatesFromBackend = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $params['row']['include_static_file']);
			$staticTemplates = array_merge($this->getStaticTemplates(), $staticTemplatesFromBackend);
			$params['row']['include_static_file'] = implode(',', array_unique($staticTemplates));
		}
	}

	/**
	 * Includes static template from extensions
	 *
	 * @param array $params
	 * @param t3lib_TStemplate $pObj
	 * @return void
	 */
	public function postprocessIncludeStaticTypoScriptSources(array $params, \TYPO3\CMS\Core\TypoScript\TemplateService $pObj) {
		if (isset($params['row']['root'])) {
			// Add development static templates
			$settings = \TYPO3\CMS\T3Startup\Utility\Configuration::getInstance()->getSettings();
			if(isset($settings['context']) && isset($settings[strtolower($settings['context']) . 'Path']) && @is_dir(PATH_site . $settings[strtolower($settings['context']) . 'Path'])){
				$this->addCustomTemplate($settings[strtolower($settings['context']) . 'Path']);
				$this->generateCustomTyposcript($params, $pObj);
			}
		}
	}

	/**
	 * Create Custom typoscript for the template before root
	 *
	 * @param array                                      $params
	 * @param \TYPO3\CMS\Core\TypoScript\TemplateService $pObj
	 */
	public function generateCustomTyposcript(array $params, \TYPO3\CMS\Core\TypoScript\TemplateService $pObj){
		foreach($this->getCustomTemplates() as $template){
			$mExtKey = 't3setupConfiguration';
			$filePath = PATH_site . $template . '/';
			$row = array(
				'constants' => @is_file(($filePath . 'constants.txt')) ? \TYPO3\CMS\Core\Utility\GeneralUtility::getUrl($filePath . 'constants.txt') : '',
				'config' => @is_file(($filePath . 'setup.txt')) ? \TYPO3\CMS\Core\Utility\GeneralUtility::getUrl($filePath . 'setup.txt') : '',
				'title' => 'T3Setup:Configuration',
				'uid' => 't3setupConfiguration'
			);
			$pObj->processTemplate($row, $params['idList'] . ',ext_' . $mExtKey, $params['pid'], 'ext_' . $mExtKey, $params['templateId']);
		}
	}

	/**
	 * Adds a static template path
	 *
	 * @param string $staticTemplate
	 * @return void
	 */
	public function addStaticTemplate($staticTemplate) {
		$this->staticTemplates[] = $staticTemplate;
	}

	/**
	 * Adds a static multiple templates path
	 *
	 * @param array $staticTemplates
	 * @return void
	 */
	public function addStaticTemplates(array $staticTemplates) {
		foreach ($staticTemplates as $staticTemplate) {
			$this->staticTemplates[] = $staticTemplate;
		}
	}

	/**
	 * Returns the static template paths
	 *
	 * @return array
	 */
	public function getStaticTemplates() {
		return $this->staticTemplates;
	}

	/**
	 * Returns the custom template paths
	 *
	 * @return array
	 */
	public function getCustomTemplates() {
		return $this->customTemplates;
	}

	/**
	 * Adds a custom template path
	 *
	 * @param string $customTemplate
	 * @return \TYPO3\CMS\T3Startup\Hooks\TypoScriptTemplate
	 */
	public function addCustomTemplate($customTemplate) {
		$this->customTemplates[] = $customTemplate;
		return $this;
	}
}

?>