################################
# TYPOSCRIPT FOR TX_FLUIDPAGES #
################################

 #include basic path for dynamic backend template
 plugin.tx_fed {
 	page.t3startup {
 		templateRootPath = fileadmin/Resources/Private/Templates/
 		partialRootPath = fileadmin/Resources/Private/Partials/
 		layoutRootPath = fileadmin/Resources/Private/Layouts/
 	}
 }

 plugin.tx_flux.view.widget.Tx_Fluid_ViewHelpers_Widget_PaginateViewHelper.templateRootPath < plugin.tx_fed.page.fluidpages.templateRootPath
 plugin.tx_news.view.widget.Tx_Fluid_ViewHelpers_Widget_PaginateViewHelper.templateRootPath < plugin.tx_fed.page.fluidpages.templateRootPath