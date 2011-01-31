<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Michael Knoll <mimi@kaktusteam.de>, MKLV GbR
*  			 
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
 * Class definitoin file for a controller for the Image object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */



/**
 * Class implements a controller for actions concerning image object 
 * 
 * @author Michael Knoll <mimi@kaktusteam.de>
 * @since 2009-12-22
 * @package Typo3
 * @subpackage yag
 */
class Tx_Yag_Controller_ImageController extends Tx_Yag_Controller_AbstractController {
	
	/**
	 * Holds a reference to an image repository
	 * @var Tx_Yag_Domain_Repository_ImageRepository
	 */
	protected $imageRepository;
	
	
	
	/**
	 * Initializes this controller
	 * 
	 * @return void
	 */
	public function initializeAction() {
		$this->imageRepository = t3lib_div::makeInstance('Tx_Yag_Domain_Repository_ImageRepository');
	}
	
	

	/**
	 * Index action for image controller
	 * @return string The rendered index action
	 */
	public function indexAction(Tx_Yag_Domain_Model_Image $image=NULL) {
		$this->singleAction($image);
	}
	
	
	
	/**
	 * Shows a single image
	 *
	 * @param Tx_Yag_Domain_Model_Image    $image     Image to be shown as single
	 * @return  string     The rendered single action
	 */
	public function singleAction(
	       Tx_Yag_Domain_Model_Image $image=NULL, 
	       Tx_Yag_Domain_Model_Album $album=NULL, 
	       Tx_Yag_Domain_Model_Gallery $gallery=NULL) {

	    if ($album != null) {
		    $this->view->assign('prevImage', $album->getPrevImage($image));
		    $this->view->assign('nextImage', $album->getNextImage($image));
	    }
	    $this->view->assign('image', $image);
	    $this->view->assign('album', $album);
	    $this->view->assign('gallery', $gallery);
	    
	}
	
	
	
	/**
	 * Deletes an image!
	 *
	 * @param Tx_Yag_Domain_Model_Image $image
	 * @param Tx_Yag_Domain_Model_Album $album
	 * @param Tx_Yag_Domain_Model_Gallery $gallery
	 */
	public function deleteAction(
	       Tx_Yag_Domain_Model_Image $image, 
           Tx_Yag_Domain_Model_Album $album=NULL, 
           Tx_Yag_Domain_Model_Gallery $gallery=NULL) {
           	
        $this->checkForAdminRights();
           	
        if ($this->request->hasArgument('reallyDelete')) {
            $this->imageRepository->remove($image);
            $this->view->assign('deleted', 1);
        } else {
            $this->view->assign('image', $image);	
        }
        $this->view->assign('album', $album);
        $this->view->assign('gallery', $gallery);
        
	}
	
	
	
	/**
	 * Edit action for editing an image object
	 *
	 * @param Tx_Yag_Domain_Model_Image $image         Image to be edited
	 * @param Tx_Yag_Domain_Model_Album $album         Album that holds image to be edited
	 * @param Tx_Yag_Domain_Model_Gallery $gallery     Gallery that holds albom that holds image to be edited
	 * @return string The rendered edit action
	 * @dontvalidate $image
	 */
	public function editAction(
           Tx_Yag_Domain_Model_Image $image, 
           Tx_Yag_Domain_Model_Album $album=NULL, 
           Tx_Yag_Domain_Model_Gallery $gallery=NULL) {
           	
        $this->checkForAdminRights();

        $this->view->assign('image', $image);
        $this->view->assign('album', $album);
        $this->view->assign('gallery', $gallery);
           	
    }
    
    
    
    /**
     * Update action for updating an image object
     *
     * @param Tx_Yag_Domain_Model_Image $image         Image to be edited
     * @param Tx_Yag_Domain_Model_Album $album         Album that holds image to be edited
     * @param Tx_Yag_Domain_Model_Gallery $gallery     Gallery that holds albom that holds image to be edited
     * @return string The rendered update action
     */
    public function updateAction(
           Tx_Yag_Domain_Model_Image $image, 
           Tx_Yag_Domain_Model_Album $album=NULL, 
           Tx_Yag_Domain_Model_Gallery $gallery=NULL) {
           	
         $this->checkForAdminRights();
           	
         $this->imageRepository->update($image);
         $this->flashMessages->add('Your image has been updated!');
         $this->redirect('single', NULL, NULL, array('image' => $image, 'album' => $album, 'gallery' => $gallery));       	
           	
    }
	
}
?>
