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
 * Class implements Gallery domain object
 *
 * @version $Id$
 * @author Michael Knoll <mimi@kaktusteam.de>
 * @package Domain
 * @subpackage Model
 */
class Tx_Yag_Domain_Model_Gallery extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
     * Name of gallery
     *
     * @var string $name
     */
    protected $name;
    
    

    /**
     * Description of gallery
     *
     * @var string $description
     */
    protected $description;

    
    
    /**
     * Date of gallery
     *
     * @var DateTime $date
     */
    protected $date;

    
    
    /**
     * UID of fe user that owns gallery
     *
     * @var integer $feUserUid
     */
    protected $feUserUid;

    
    
    /**
     * UID of fe group that owns gallery
     *
     * @var integer $feGroupUid
     */
    protected $feGroupUid;

    
    
    /**
     * Holds albums for this gallery
     *
     * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Yag_Domain_Model_Album> $albums
     */
    protected $albums;

    
    
    /**
     * Holds an album which is used as thumbnail for gallery
     *
     * @var Tx_Yag_Domain_Model_Album $thumbAlbum
     */
    protected $thumbAlbum;
    
    
    
    /**
     * The constructor.
     *
     * @return void
     */
    public function __construct() {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }
    
    

    /**
     * Initializes all Tx_Extbase_Persistence_ObjectStorage instances.
     *
     * @return void
     */
    protected function initStorageObjects() {
        /**
        * Do not modify this method!
        * It will be rewritten on each save in the kickstarter
        * You may modify the constructor of this class instead
        */
        $this->albums = new Tx_Extbase_Persistence_ObjectStorage();
    }

    
    
    /**
     * Setter for name
     *
     * @param string $name Name of gallery
     * @return void
     */
    public function setName($name) {
        $this->name = $name;
    }
    
    

    /**
     * Getter for name
     *
     * @return string Name of gallery
     */
    public function getName() {
        return $this->name;
    }

    
    
    /**
     * Setter for description
     *
     * @param string $description Description of gallery
     * @return void
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    
    
    /**
     * Getter for description
     *
     * @return string Description of gallery
     */
    public function getDescription() {
        return $this->description;
    }

    
    
    /**
     * Setter for date
     *
     * @param DateTime $date Date of gallery
     * @return void
     */
    public function setDate(DateTime $date) {
        $this->date = $date;
    }

    
    
    /**
     * Getter for date
     *
     * @return DateTime Date of gallery
     */
    public function getDate() {
        return $this->date;
    }

    
    
    /**
     * Setter for feUserUid
     *
     * @param integer $feUserUid UID of fe user that owns gallery
     * @return void
     */
    public function setFeUserUid($feUserUid) {
        $this->feUserUid = $feUserUid;
    }

    
    
    /**
     * Getter for feUserUid
     *
     * @return integer UID of fe user that owns gallery
     */
    public function getFeUserUid() {
        return $this->feUserUid;
    }

    
    
    /**
     * Setter for feGroupUid
     *
     * @param integer $feGroupUid UID of fe group that owns gallery
     * @return void
     */
    public function setFeGroupUid($feGroupUid) {
        $this->feGroupUid = $feGroupUid;
    }
    
    

    /**
     * Getter for feGroupUid
     *
     * @return integer UID of fe group that owns gallery
     */
    public function getFeGroupUid() {
        return $this->feGroupUid;
    }
    
    

    /**
     * Setter for albums
     *
     * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Yag_Domain_Model_Album> $albums Holds albums for this gallery
     * @return void
     */
    public function setAlbums(Tx_Extbase_Persistence_ObjectStorage $albums) {
        $this->albums = $albums;
    }

    
    
    /**
     * Getter for albums
     *
     * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Yag_Domain_Model_Album> Holds albums for this gallery
     */
    public function getAlbums() {
        return $this->albums;
    }
    
    

    /**
     * Adds a Album
     *
     * @param Tx_Yag_Domain_Model_Album the Album to be added
     * @return void
     */
    public function addAlbum(Tx_Yag_Domain_Model_Album $album) {
        $this->albums->attach($album);
    }
    
    
    
    
    
    

    /**
     * Removes a Album
     *
     * @param Tx_Yag_Domain_Model_Album the Album to be removed
     * @return void
     */
    public function removeAlbum(Tx_Yag_Domain_Model_Album $albumToRemove) {
        $this->albums->detach($albumToRemove);
    }
	
	
	
	/**
	 * Returns an album designated as thumbnail for this gallery
	 *
	 * @return Tx_Yag_Domain_Model_Album Thumbnail album for gallery
	 */
	public function getThumbAlbum() {
	    return $this->thumbAlbum;
	}
	
	
	
	/**
	 * Setter for thumb album of this gallery. Given album is set as gallery thumb.
	 *
	 * @param Tx_Yag_Domain_Model_Album $thumbAlbum
	 */
	public function setThumbAlbum(Tx_Yag_Domain_Model_Album $thumbAlbum) {
		$this->thumbAlbum = $thumbAlbum;
	}
	
	
	
	/**
	 * Returns number of albums attached to this gallery
	 *
	 * @return int Number of albums attached to this gallery
	 */
	public function getAlbumCount() {
		return count($this->albums);
	}
	
	
	
	/**
	 * Deletes an gallery. Deletes all albums, if parameter is set to true
	 * 
	 * @param bool $deleteAlbums If set to true, all albums of gallery will be deleted
	 */
	public function delete($deleteAlbums = true) {
		if ($deleteAlbums) {
			foreach ($this->albums as $album) {
				$this->removeAlbum($album);
				$album->removeGallery($this);
				if (count($album->getGalleries()) == 0) {
					$album->delete();
				}
			}
		}
		$galleryRepository = t3lib_div::makeInstance('Tx_Yag_Domain_Repository_GalleryRepository');
		$galleryRepository->remove($this);
	}
	
	
	
	/**
	 * Sets thumb album to top of album
	 */
	public function setThumbAlbumToTopOfAlbums() {
		if ($this->albums->count() > 0) {
			$this->thumbAlbum = $this->albums->current();
		} else {
			$this->thumbAlbum = null;
		}
	}
	
}
?>