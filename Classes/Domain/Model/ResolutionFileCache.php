<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2010 Michael Knoll <mimi@kaktusteam.de>
*  			Daniel Lienert <daniel@lienert.cc>
*  			
*  All rights reserved
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
 * Class implements a ResolutionItemFileRelation domain object. For each item a file is stored
 * for each resolution an item is associated with by its album. This class implements an
 * attributed association that combines an item, its resolution and the according item file for this
 * resolution.
 * 
 * @author Michael Knoll <mimi@kaktusteam.de>
 * @author Daniel Lienert <daniel@lienert.cc>
 * @package Domain
 * @subpackage Model
 */
class Tx_Yag_Domain_Model_ResolutionFileCache extends Tx_Extbase_DomainObject_AbstractEntity {
	
    /**
     * Width of cached file
     *
     * @var integer $width
     */
    protected $width;
    
    

    /**
     * Height of cached file
     *
     * @var integer $height
     */
    protected $height;
    
    

    /**
     * Quality of cached file
     *
     * @var integer $quality
     */
    protected $quality;
    
    

    /**
     * Path to cached file
     *
     * @var string $path
     */
    protected $path;
    
    

    /**
     * Item to which resolution file cache belongs to
     *
     * @var Tx_Yag_Domain_Model_Item $item
     */
    protected $item;
    
    
	/**
     * Name of resolution config
     *
     * @var string $name
     */
    protected $name;
	
	
	/**
	 * Constructor for resolution item file relation
	 *
	 * @param Tx_Yag_Domain_Model_Item $item Item for which file is cached
	 * @param string $path Path to cached file
	 * @param int $width Width of cached file
	 * @param int $height Height of cached file
	 * @param quality $quality Quality of cached file
	 * @param string $name Name of this resolution file
	 */
	public function __construct(Tx_Yag_Domain_Model_Item $item = NULL, $path = '', $width = 0, $height = 0, $quality = 0, $name = '') {
	    $this->item = $item;
	    $this->path = $path;
	    $this->height = $height;
	    $this->width = $width;
	    $this->quality = $quality;	
	    $this->name = $name;
    }
    
    

    /**
     * Setter for width
     *
     * @param integer $width Width of cached file
     * @return void
     */
    public function setWidth($width) {
        $this->width = $width;
    }
    
    

    /**
     * Getter for width
     *
     * @return integer Width of cached file
     */
    public function getWidth() {
        return $this->width;
    }

    
    
    /**
     * Setter for height
     *
     * @param integer $height Height of cached file
     * @return void
     */
    public function setHeight($height) {
        $this->height = $height;
    }
    
    

    /**
     * Getter for height
     *
     * @return integer Height of cached file
     */
    public function getHeight() {
        return $this->height;
    }
    
    

    /**
     * Setter for quality
     *
     * @param integer $quality Quality of cached file
     * @return void
     */
    public function setQuality($quality) {
        $this->quality = $quality;
    }
    
    

    /**
     * Getter for quality
     *
     * @return integer Quality of cached file
     */
    public function getQuality() {
        return $this->quality;
    }

    
    
    /**
     * Setter for path
     *
     * @param string $path Path to cached file
     * @return void
     */
    public function setPath($path) {
        $this->path = $path;
    }
    
    

    /**
     * Getter for path
     *
     * @return string Path to cached file
     */
    public function getPath() {
        return $this->path;
    }

    
    /**
     * Setter for name
     *
     * @param string $name Name of this config
     * @return void
     */
    public function setName($name) {
        $this->name = $name;
    }
    
    

    /**
     * Getter for name
     *
     * @return string $name
     */
    public function getName() {
        return $this->name;
    }
    
    
    
    /**
     * Setter for item
     *
     * @param Tx_Yag_Domain_Model_Item $item Item to which resolution file cache belongs to
     * @return void
     */
    public function setItem(Tx_Yag_Domain_Model_Item $item) {
        $this->item = $item;
    }
    
    

    /**
     * Getter for item
     *
     * @return Tx_Yag_Domain_Model_Item Item to which resolution file cache belongs to
     */
    public function getItem() {
        return $this->item;
    }
    	
}
?>