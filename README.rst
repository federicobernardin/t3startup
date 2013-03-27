T3Startup
=========

Overview
--------
A great problem when configuring TYPO3 is the customization of content element with rows of typoscript or the customization of TYPO3 backend.
With TYPO3 4.5 we have the grid layout, but thanks to Claude Due we have flux and its grid helpers. With those helpers we can customize TYPO3 Backend in a very easy way using Fluid and fluidpages exetnsion. The other limit is the standard content elements, always thanks to Claude we have Custom content element with Fluid and fluidcontent.

This extension is an aggregate of feature, it requires flux, fluidcontent and fluidpages, moves your configuration automatically in your preferred folder, configuring destination into extension configuration. You can add your templates to your preferred version control system.

Installation
---------------------------------------

You install the extension in the standard way using extension manager. After that you enter into the configuration page of T3Startup extension and choose what context you want activate. You can choose Development, Production or Test, each context is associated to a specific folder into your site. *WARNING:* the path you write is referred to root of your TYPO3 installation path.
TYPO3 will include automatically the setup.txt and constants.txt that it will find into the indicated folder.

* setup.txt contains typoscript needs to configure your site, I can suggest you to write only the inclusion of files typoscript in other folders, so you can use different files for different contexts.
* constants.txt contain the constants used in your typoscript.

Both these files are integrated into the template rootline before the root template, so its configurations override all other extensions configurations.


