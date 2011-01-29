<?php
/***************************************************************
*  Copyright notice
*
<<<<<<< HEAD
*  (c) 2009 Michael Knoll <mimi@kaktusteam.de>, MKLV GbR
=======
*  (c) 2009 Daniel Lienert <daniel@lienert.cc>,
*           Michael Knoll <mimi@kaktusteam.de>
>>>>>>> 763010c0c4545c3bda2dd9b68f3df4aa15a801c0
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
 * Class implements an abstract controller for all yag controllers
 * 
 * @package Controller
 * @author Michael Knoll <mimi@kaktusteam.de>
 * @author Daniel Lienert <daniel@lienert.cc>
 * 
 * TODO: Move the general stuff to pt_extbase ...
 * 
 */
abstract class Tx_Yag_Controller_AbstractController extends Tx_Extbase_MVC_Controller_ActionController {
	
	/**
	 * Holds an instance of fe_user object
	 *
	 * @var Tx_Extbase_Domain_Model_FrontendUser
	 */
	protected $feUser;
	
	
	
	/**
<<<<<<< HEAD
	 * Holds an instance of rbac user object
	 *
	 * @var Tx_Rbac_Domain_Model_User
	 */
	protected $rbacUser;
	
	
	
	/**
=======
>>>>>>> 763010c0c4545c3bda2dd9b68f3df4aa15a801c0
	 * Holds extension manager settings of yag extension
	 *
	 * @var array
	 */
	protected $emSettings = array();
	
	
	
	/**
	 * Holds an instance of yag configuration builder
	 *
	 * @var Tx_Yag_Domain_Configuration_ConfigurationBuilder
	 */
<<<<<<< HEAD
	protected $configurationBuilder;
=======
	protected $configurationBuilder = NULL;
>>>>>>> 763010c0c4545c3bda2dd9b68f3df4aa15a801c0
	
	
	
	/**
	 * Holds an instance of gallery context
	 *
	 * @var Tx_Yag_Domain_YagContext
	 */
	protected $yagContext;
	
	
<<<<<<< HEAD
=======
		
	/**
	 * Holds instance of extlist context
	 * 
	 * @var Tx_PtExtlist_ExtlistContext_ExtlistContext
	 */
	protected $extListContext;
	
	
>>>>>>> 763010c0c4545c3bda2dd9b68f3df4aa15a801c0
	
	/**
     * @var Tx_PtExtlist_Domain_Lifecycle_LifecycleManager
     */
    protected $lifecycleManager;

    
    
    /**
     * Holds an instance of rbac access controll service
     *
     * @var Tx_Rbac_Domain_AccessControllService
     */
    protected $rbacAccessControllService;
<<<<<<< HEAD
    
    
    
    /**
     * Constructor for all plugin controllers
     */
    public function __construct() {
        parent::__construct();
        $this->initAccessControllService();     
=======
	 
    
    
    /**
     * This action is final, as it should not be overwritten by any extended controllers
     */
    final protected function initializeAction() {   
    	if(!$this->configurationBuilder) {
    		if($this->request->getControllerActionName() == 'settingsNotAvailable') return;
    		
    		$this->redirect('settingsNotAvailable', 'Backend');	
    	}
    	$this->preInitializeAction();
    	$this->initializeFeUser();
        $this->initAccessControllService();     
    	$this->doRbacCheck();
    	$this->yagContext->injectRequest($this->request);
    	$this->postInitializeAction();
>>>>>>> 763010c0c4545c3bda2dd9b68f3df4aa15a801c0
    }
    
    
    
    /**
     * Initializes Access Controll Service 
     *
     */
    protected function initAccessControllService() {
<<<<<<< HEAD
    	$this->rbacAccessControllService = Tx_Rbac_Domain_AccessControllServiceFactory::getInstance();
    }
	
	
	
	/**
     * Prepares a view for the current action and stores it in $this->view.
     * By default, this method tries to locate a view with a name matching
     * the current action.
     *
     * Configuration for view in TS:
     * 
     * controller.<ControllerName>.<controllerActionName>.view = <viewClassName>
     * 
     * @return void
     */
    protected function resolveView() {
    	$view = $this->resolveViewObject();
        
        $controllerContext = $this->buildControllerContext();
        $view->setControllerContext($controllerContext);

		// Setting the controllerContext for the FLUID template renderer         
        Tx_PtExtlist_Utility_RenderValue::setControllerContext($controllerContext);
        
        // Template Path Override
        $extbaseFrameworkConfiguration = Tx_Extbase_Dispatcher::getExtbaseFrameworkConfiguration();
        if (isset($extbaseFrameworkConfiguration['view']['templateRootPath']) && strlen($extbaseFrameworkConfiguration['view']['templateRootPath']) > 0) {
            $view->setTemplateRootPath(t3lib_div::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']));
        }
        if (isset($extbaseFrameworkConfiguration['view']['layoutRootPath']) && strlen($extbaseFrameworkConfiguration['view']['layoutRootPath']) > 0) {
            $view->setLayoutRootPath(t3lib_div::getFileAbsFileName($extbaseFrameworkConfiguration['view']['layoutRootPath']));
        }
        if (isset($extbaseFrameworkConfiguration['view']['partialRootPath']) && strlen($extbaseFrameworkConfiguration['view']['partialRootPath']) > 0) {
            $view->setPartialRootPath(t3lib_div::getFileAbsFileName($extbaseFrameworkConfiguration['view']['partialRootPath']));
        }

        if ($view->hasTemplate() === FALSE) {
            $viewObjectName = $this->resolveViewObjectName();
            if (class_exists($viewObjectName) === FALSE) $viewObjectName = 'Tx_Extbase_MVC_View_EmptyView';
            $view = $this->objectManager->getObject($viewObjectName);
            $view->setControllerContext($controllerContext);
        }
        if (method_exists($view, 'injectConfigurationBuilder')) {
            $view->injectConfigurationBuilder($this->configurationBuilder);
        }
        $view->initializeView(); // In FLOW3, solved through Object Lifecycle methods, we need to call it explicitely
        $view->assign('settings', $this->settings); // same with settings injection.
        
        return $view;
    }
    
    
    
    /**
     * These lines have been added by Michael Knoll to make view configurable via TS
     * Added TS-Key redirect by Daniel Lienert. If the tsPath points to a TS Configuration with child key viewClassName, it uses this as view class
     * 
     * @throws Exception
     */
    protected function resolveViewObject() {
   
        $viewClassName = $this->settings['controller'][$this->request->getControllerName()][$this->request->getControllerActionName()]['view'];

        if ($viewClassName != '') {

        	if (class_exists($viewClassName)) {
        		return $this->objectManager->getObject($viewClassName);
        	} 

        	$viewClassName .= '.viewClassName';
        	$tsRedirectPath = explode('.', $viewClassName);
        	$viewClassName = Tx_Extbase_Utility_Arrays::getValueByPath($this->settings, $tsRedirectPath);
        	
        	if (class_exists($viewClassName)) {
        		return $this->objectManager->getObject($viewClassName);
        	}
        	
        	throw new Exception('View class does not exist! ' . $viewClassName . ' 1281369758');
        } else {
        	
        	// We replace Tx_Fluid_View_TemplateView by Tx_PtExtlist_View_BaseView here to use our own view base class
        	return $this->objectManager->getObject('Tx_PtExtlist_View_BaseView');	
        }
    }
    
    
    
    /**
     * This action is final, as it should not be overwritten by any extended controllers
     */
    final protected function initializeAction() {
    	$this->preInitializeAction();
    	$this->initializeFeUser();
    	$this->doRbacCheck();
    	$this->yagContext->injectRequest($this->request);
    	$this->postInitializeAction();
=======
    	// TODO change this, so that acs is only instantiated, if we need it for access controll
    	$this->rbacAccessControllService = Tx_Rbac_Domain_AccessControllServiceFactory::getInstance($this->feUser);
    	$this->rbacAccessControllService->injectReflectionService($this->reflectionService);
>>>>>>> 763010c0c4545c3bda2dd9b68f3df4aa15a801c0
    }
    
    
    
    /**
     * Runs rbac check
     * 
     * Access restrictions to controller actions can be created by
     * using @rbacNeedsAccess, @rbacObject <rbacObjectName> and @rbacAction <rbacActionName> annotations in your
     * action comments.
     */
    protected function doRbacCheck() {
<<<<<<< HEAD
    	$this->initializeRbacUser();
        $controller = $this->request->getControllerObjectName();
        $action = $this->actionMethodName;
        $methodTags = $this->reflectionService->getMethodTagsValues($controller, $action);
        
        if (array_key_exists('rbacNeedsAccess', $methodTags)) {
            if ($this->rbacUser) {
                $rbacObject = $methodTags['rbacObject'][0];
                $rbacAction = $methodTags['rbacAction'][0];
                #print_r("<br>RBAC response for user: {$rbacUser[0]->getUid()} object: $rbacObject action: $rbacAction" );
                #var_dump($this->rbacAccessControllService->hasAccess($rbacUser[0]->getUid(), $rbacObject, $rbacAction));
                if (!($this->rbacAccessControllService->hasAccess($this->rbacUser->getUid(), $rbacObject, $rbacAction))) {
                    $this->flashMessages->add('Access denied! You do not have the privileges for this function.');
                    $this->accessDeniedAction();
                }
            } else {
            	if ($this->feUser) {
            		$this->flashMessages->add('Access denied - No RBAC user has been set up for your fe_user!');
            	} else {
                    $this->flashMessages->add('Access denied - You are not logged in!');
            	}
                $this->accessDeniedAction();
            }
        }
    }
    
    
    
    /**
     * Initializes rbac user object
     */
    protected function initializeRbacUser() {
    	if ($this->feUser) {
            $query = t3lib_div::makeInstance(Tx_Rbac_Domain_Repository_UserRepository)->createQuery();
            $query->getQuerySettings()->setRespectStoragePage(FALSE);
            $query->matching($query->equals('feUser', $this->feUser->getUid()));
            $rbacUserArray = $query->execute();
            if (count($rbacUserArray) > 0) {
            	// TODO refactor me!
                $this->rbacUser = $rbacUserArray[0];
                $this->yagContext->setRbacUser($this->rbacUser);
            }
            else $this->rbacUser = null;  // no rbac user found
    	} else {
    		$this->rbacUser = null; // no fe user is logged in
    	}
=======
    	// TODO change this, so that acs is only instantiated, if we need it for access controll
        $controllerName = $this->request->getControllerObjectName();
        $actionName = $this->actionMethodName;
    	if (!$this->rbacAccessControllService->loggedInUserHasAccessToControllerAndAction($controllerName, $actionName)) {
    		$this->flashMessages->add('Access denied');
    		$this->accessDeniedAction();
    	}
    	
>>>>>>> 763010c0c4545c3bda2dd9b68f3df4aa15a801c0
    }
    
    
    
    /**
<<<<<<< HEAD
     * Template methods to be implemented in extending controllers
     * (this is required since initializeAction() is final due to
     * access controll checks.
     */
    protected function postInitializeAction() {}
    protected function preInitializeAction() {}
    
    
    
    /**
=======
>>>>>>> 763010c0c4545c3bda2dd9b68f3df4aa15a801c0
     * Redirects to gallery start page after access for another action has been denied
     *
     * Feel free to override this method in your respective controller
     * 
     * @param Tx_Yag_Domain_Model_Album $album      
     * @param Tx_Yag_Domain_Model_Gallery $gallery
     */
    protected function accessDeniedAction() {
<<<<<<< HEAD
        $this->redirect('list', 'Gallery');
=======
    	// TODO set defaults in TS prototype not here!
    	$accessDeniedController = $this->settings['accessDenied']['controller'] != '' ? $this->settings['accessDenied']['controller'] : 'Gallery';
    	$accessDeniedAction = $this->settings['accessDenied']['action'] != '' ? $this->settings['accessDenied']['action'] : 'list';
        $this->redirect($accessDeniedAction, $accessDeniedController);
>>>>>>> 763010c0c4545c3bda2dd9b68f3df4aa15a801c0
    }
    
    
    
    /**
<<<<<<< HEAD
     * Check for correct configuration
     *
     */
    protected function checkConfiguration() {
    	if (!$this->settings['storagePid'] >= 0) {
    		throw new Exception('No storage PID has been set!');
    	}
    }
    
    
    
    /**
     * Injects the settings of the extension.
     *
     * @param array $settings Settings container of the current extension
     * @return void
     */
    public function injectSettings(array $settings) {
        parent::injectSettings($settings);

        $this->emSettings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['yag']);
        $this->configurationBuilder = Tx_Yag_Domain_Configuration_ConfigurationBuilderFactory::getInstance($this->settings);
        // TODO we would rather have a factory here!
        $this->yagContext = Tx_Yag_Domain_YagContext::getInstance($this->configurationBuilder);
=======
     * Template methods to be implemented in extending controllers
     * (this is required since initializeAction() is final due to
     * access controll checks.
     */
    protected function postInitializeAction() {}
    protected function preInitializeAction() {}
    
    
    
	/**
	 * Hook in Configuration set Process 
	 *
	 * @param Tx_Extbase_Configuration_ConfigurationManager $configurationManager
	 */
    public function injectConfigurationManager(Tx_Extbase_Configuration_ConfigurationManager $configurationManager) {
        parent::injectConfigurationManager($configurationManager);
		
        if($this->settings != NULL) {
	        $this->emSettings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['yag']);
	        $this->configurationBuilder = Tx_Yag_Domain_Configuration_ConfigurationBuilderFactory::getInstance($this->settings);
	        // TODO we would rather have a factory here!
	        $this->yagContext = Tx_Yag_Domain_YagContext::getInstance($this->configurationBuilder);
        }
>>>>>>> 763010c0c4545c3bda2dd9b68f3df4aa15a801c0
    }
    
    
    
    /**
<<<<<<< HEAD
     * Returns a request parameter, if it's available.
     * Returns NULL if it's not available
     *
     * @param string $parameterName
     * @return string
     */
    protected function getParameterSafely($parameterName) {
        if ($this->request->hasArgument($parameterName)) {
            return $this->request->getArgument($parameterName);
        }
        return NULL;
=======
     * Initializes fe user for current session
     * 
     */
    protected function initializeFeUser() {
        $feUserUid = $GLOBALS['TSFE']->fe_user->user['uid'];
        if ($feUserUid > 0) {
        	// TODO put this into pt_extbase
            $feUserRepository = t3lib_div::makeInstance('Tx_Extbase_Domain_Repository_FrontendUserRepository'); /* @var $feUserRepository Tx_Extbase_Domain_Repository_FrontendUserRepository */
            $query = $feUserRepository->createQuery();
            $query->getQuerySettings()->setRespectStoragePage(FALSE);
            $queryResult = $query->matching($query->equals('uid', $feUserUid))->execute();
            if (count($queryResult) > 0) {
                $this->feUser = $queryResult[0];
            }
        } else {
            $this->feUser = null;
        }
>>>>>>> 763010c0c4545c3bda2dd9b68f3df4aa15a801c0
    }
    
    
    
    /**
<<<<<<< HEAD
     * Initializes the view before invoking an action method.
     *
     * Override this method to solve assign variables common for all actions
     * or prepare the view in another way before the action is called.
     *
     * @param Tx_Extbase_MVC_View_ViewInterface $view The view to be initialized
     * @return void
     * @api
     */
    protected function initializeView(Tx_Extbase_MVC_View_ViewInterface $view) {
    	$this->view->assign('config', $this->configurationBuilder);
    	$this->view->assign('yagContext', $this->yagContext);
=======
     * Resolve the viewObjectname in the following order
     * 
     * 1. TS-defined
     * 2. Determined by Controller/Action/Format
     * 3. Extlist BaseView 
     * 
     * @throws Exception
     * @return string
     */
    protected function resolveViewObjectName() {

    	// we get view from TS settings?
    	$viewClassName = $this->resolveTsDefinedViewClassName();
    	if($viewClassName) {
			return $viewClassName;
		} 
		
		// we get view from controller and action
		$viewClassName = parent::resolveViewObjectName();
  		if($viewClassName) {
			return $viewClassName;
		}
		
		// we take default view
		else {
			return 'Tx_PtExtlist_View_BaseView';
		}
>>>>>>> 763010c0c4545c3bda2dd9b68f3df4aa15a801c0
    }
    
    
    
    /**
<<<<<<< HEAD
     * Initializes fe user for current session
     * 
     */
    protected function initializeFeUser() {
        $feUserUid = $GLOBALS['TSFE']->fe_user->user['uid'];
        if ($feUserUid > 0) {
            $feUserRepository = t3lib_div::makeInstance('Tx_Extbase_Domain_Repository_FrontendUserRepository'); /* @var $feUserRepository Tx_Extbase_Domain_Repository_FrontendUserRepository */
            $feUser = $feUserRepository->findByUid($feUserUid);
            $this->feUser = $feUser;
        } else {
            $this->feUser = null;
        }
    }
    
    	
}

=======
     * Resolve the viewClassname defined via typoscript
     * 
     * @return string
     */
    protected function resolveTsDefinedViewClassName() {
    	
    	$viewClassName = $this->settings['controller'][$this->request->getControllerName()][$this->request->getControllerActionName()]['view'];

    	if($viewClassName != '') {
    		if (!class_exists($viewClassName)) {
		    	
	    		// Use the viewClassName as redirect path to a typoscript value holding the viewClassName
		    	$viewClassName .= '.viewClassName';
		    	$tsRedirectPath = explode('.', $viewClassName);
		    	$viewClassName = Tx_Extbase_Utility_Arrays::getValueByPath($this->settings, $tsRedirectPath);
		    	
    		}	
    	}
    	
    	if($viewClassName && !class_exists($viewClassName)) {
    		throw new Exception('View class does not exist! ' . $viewClassName . ' 1281369758');
    	}
    	
		return $viewClassName;
    }
    
    
    
	/**
	 * Initializes the view before invoking an action method.
	 *
	 * Override this method to solve assign variables common for all actions
	 * or prepare the view in another way before the action is called.
	 *
	 * @param Tx_Extbase_View_ViewInterface $view The view to be initialized
	 * @return void
	 * @api
	 */
	protected function initializeView(Tx_Extbase_MVC_View_ViewInterface $view) {
        	    
        if (method_exists($view, 'injectConfigurationBuilder')) {
            $view->setConfigurationBuilder($this->configurationBuilder);
        }
  		
        $this->setCustomPathsInView($view);  
        
        $this->view->assign('config', $this->configurationBuilder);
    	$this->view->assign('yagContext', $this->yagContext);
	}

	
	
	/**
	 * Set the TS defined custom paths in view
	 * 
	 * @param Tx_Extbase_MVC_View_ViewInterface $view
	 * @throws Exception
	 */
	protected function setCustomPathsInView(Tx_Extbase_MVC_View_ViewInterface $view) {
		
		// We can overwrite a template via TS using plugin.yag.settings.controller.<ControllerName>.<actionName>.template
		$templatePathAndFilename = $this->settings['controller'][$this->request->getControllerName()][$this->request->getControllerActionName()]['template'];
		if (isset($templatePathAndFilename) && strlen($templatePathAndFilename) > 0) {
			if (file_exists(t3lib_div::getFileAbsFileName($templatePathAndFilename))) {
                $view->setTemplatePathAndFilename(t3lib_div::getFileAbsFileName($templatePathAndFilename));
			} else {
				throw new Exception('Given template path and filename could not be found or resolved: ' . $templatePathAndFilename . ' 1284655109');
			}
        }		
	}
	    	
}
>>>>>>> 763010c0c4545c3bda2dd9b68f3df4aa15a801c0
?>