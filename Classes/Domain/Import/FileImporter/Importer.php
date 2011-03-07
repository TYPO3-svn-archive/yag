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
 * File importer for importing single files into YAG gallery
 *
 * @package Domain
 * @subpackage Import
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Yag_Domain_Import_FileImporter_Importer extends Tx_Yag_Domain_Import_AbstractImporter {

	// @TODO consider to move variables like filepath / originalfilename / itemType / desc to an fileImportObject that a every importer can handle
	
	/**
	 * Holds path of file that should be imported
	 *
	 * @var string
	 */
	protected $filePath;
	
	
	
	/**
	 * Original Filename
	 * 
	 * @var string
	 */
	protected $originalFileName;
	
	
	
	/**
	 * Item MIME Type
	 * 
	 * @var string
	 */
	protected $itemType;
	
	
	/**
	 * Runs import of file previously set by setFilePath
	 *
	 */
	public function runImport() {
		$item = null;
		$filepath = $this->filePath;
		if ($this->moveFilesToOrigsDirectory) {
             $item = $this->getNewPersistedItem();
             $filepath = $this->moveFileToOrigsDirectory($filepath, $item);
		}
		
		$this->importFileByFilename($filepath, $item);
		if($this->originalFileName) $item->setTitle($this->originalFileName);
		$item->setItemType($this->itemType);
		$this->runPostImportAction();
	}
	
	
	
	/**
	 * Sets file path of file that should be imported
	 *
	 * @param string $filePath Path to file that should be imported
	 * @param bool $checkForFileToBeExisting If set to true, it is checked whether file is existing
	 */
	public function setFilePath($filePath, $checkForFileToBeExisting = true) {
		if ($checkForFileToBeExisting && !file_exists($filePath)) {
			throw new Exception('File ' . $filePath . ' does not exist on server! 1296187347');
		}
		$this->filePath = $filePath;
	}
	
	
	
	/**
	 * Set the originalFilename
	 * 
	 * @param atring $originalFilename
	 */
	public function setOriginalFileName($originalFilename) {
		$this->originalFileName = $originalFilename;
	}
	
	
	
	/**
	 * @param string $itemType
	 */
	public function setItemType($itemType) {
		$this->itemType = $itemType;
	}
	
	
}

?>