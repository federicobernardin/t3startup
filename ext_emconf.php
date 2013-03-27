<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "t3setup".
 *
 * Auto generated 10-01-2013 17:54
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Basic Default configuration for using flux in your site',
	'description' => 'An extension providing a set configuration for this website with flux, fluidpages and fluidcontent',
	'author' => 'Federico Bernardin',
	'author_email' => 'federico@bernardin.it',
	'category' => 'misc',
	'author_company' => 'BFCosnulting',
	'shy' => '',
	'dependencies' => 'cms,fluidpages,fluidcontent,vhs',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 1,
	'lockType' => '',
	'version' => '1.0.0',
	'constraints' => array(
		'depends' => array(
			'typo3' => '6.0-0.0.0',
			'cms' => '',
			'fluidpages' => '',
			'fluidcontent' => '',
			'vhs' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'suggests' => array(
	),
	'_md5_values_when_last_written' => 'a:9:{s:12:"ext_icon.gif";s:4:"68b4";s:14:"ext_tables.php";s:4:"5f04";s:9:"README.md";s:4:"965c";s:34:"Configuration/TypoScript/setup.txt";s:4:"7a29";s:35:"Resources/Private/Layouts/Page.html";s:4:"a0f3";s:43:"Resources/Private/Partials/PageObjects.html";s:4:"b2e4";s:44:"Resources/Private/Templates/Page/Render.html";s:4:"cf3e";s:49:"Resources/Private/Templates/Page/WithSidebar.html";s:4:"f986";s:66:"Resources/Private/Templates/ViewHelpers/Widget/Paginate/Index.html";s:4:"1309";}',
);

?>