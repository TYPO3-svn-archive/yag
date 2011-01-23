<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Daniel Lienert <daniel@lienert.cc>, Michael Knoll <mimi@kaktusteam.de>
*  All rights reserved
*
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
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
 * Configuration Builder for YAG configuration
 *
 * @package Domain
 * @subpackage Configuration
 * 
 * @author Daniel Lienert <daniel@lienert.cc>
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Yag_Domain_Configuration_ConfigurationBuilder extends Tx_PtExtlist_Domain_Configuration_AbstractConfigurationBuilder {
	

	/**
	 * Holds settings to build configuration objects
	 *
	 * @var array
	 */
	protected $configurationObjectSettings = array(
		'album' => 
				array('factory' => 'Tx_Yag_Domain_Configuration_Album_AlbumConfigurationFactory'),
		'itemList' => 
				array('factory' => 'Tx_Yag_Domain_Configuration_ItemList_ItemListConfigFactory'),
		'crawler' =>
		    	array('factory' => 'Tx_Yag_Domain_Configuration_Import_CrawlerConfigurationFactory'),
		'gallery' => 
				array('factory' => 'Tx_Yag_Domain_Configuration_Gallery_GalleryConfigurationFactory'),
		'imageProcessor' => 
		    	array('factory' => 'Tx_Yag_Domain_Configuration_ImageProcessing_ImageProcessorConfigurationFactory'),
		'extension' =>
		    	array('factory' => 'Tx_Yag_Domain_Configuration_Extension_ExtensionConfigurationFactory'),
		'theme' =>
		    	array('factory' => 'Tx_Yag_Domain_Configuration_Theme_ThemeConfigurationFactory',
		    		  'tsKey' => NULL,),
		'extlist' =>
		    	array('factory' => 'Tx_Yag_Domain_Configuration_Extlist_ExtlistConfigurationFactory')
	);
	
	
	
	/**
	 * Holds Extension Manager settings (configuration set in Extension Manager)
	 *
	 * @var array
	 */
	protected $extConfSettings;
	
	
	/**
	 * Protected constructor for configuration builder.
	 * Use factory method instead
	 *
	 * @param array $settings
	 */
	public function __construct(array $settings=array()) {
		$this->settings = $settings;
		$this->extConfSettings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['yag']);
	}
	
	
	
	/**
	 * Returns extConf settings
	 *
	 * @return array
	 */
	public function getExtConfSettings() {
		return $this->extConfSettings;
	}
	
	
	
	/**
	 * Returns an instance of crawler configuration
	 *
	 * @return Tx_Yag_Domain_Configuration_Import_CrawlerConfiguration
	 */
	public function buildCrawlerConfiguration() {
		return $this->buildConfigurationGeneric('crawler');
	}
	
	
	
	/**
	 * Returns an instance of image processor configuration
	 *
	 * @return Tx_Yag_Domain_Configuration_ImageProcessing_ProcessorConfiguration
	 */
	public function buildImageProcessorConfiguration() {
		return $this->buildConfigurationGeneric('imageProcessor');
	}
	
	
	
	/**
	 * Returns an instance of general configuration
	 *
	 * @return Tx_Yag_Domain_Configuration_Extension_GeneralConfiguration
	 */
	public function buildExtensionConfiguration() {
		return $this->buildConfigurationGeneric('extension');
	}
	
	
	
	/**
	 * Returns an instance of itemList configuration
	 *
	 * @return Tx_Yag_Domain_Configuration_ItemList_ItemListConfig
	 */
	public function buildItemListConfiguration() {
		return $this->buildConfigurationGeneric('itemList');
	}
	
	
	
	/**
	 * Returns an instance of album configuration
	 *
	 * @return Tx_Yag_Domain_Configuration_Album_AlbumConfiguration
	 */
	public function buildAlbumConfiguration() {
		return $this->buildConfigurationGeneric('album');
	}
	
	
	
	/**
	 * Returns an instance of gallery configuration
	 *
	 * @return Tx_Yag_Domain_Configuration_Gallery_GalleryConfiguration
	 */
	public function buildGalleryConfiguration() {
		return $this->buildConfigurationGeneric('gallery');
	}
	
	
	
	/**
	 * Returns an instance of theme configuration
	 *
	 * @return Tx_Yag_Domain_Configuration_Theme_ThemeConfiguration
	 */
	public function buildThemeConfiguration() {
		return $this->buildConfigurationGeneric('theme');
	}
	
	
	
	/**
	 * Returns an instance of extlist configuration 
	 *
	 * @return Tx_Yag_Domain_Configuration_Extlist_ExtlistConfiguration
	 */
	public function buildExtlistConfiguration() {
		return $this->buildConfigurationGeneric('extlist');
	}
	
}

?>