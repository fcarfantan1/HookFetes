<?php
/*************************************************************************************/
/*      This file is part of the Thelia package.                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

namespace HookFetes\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Log\Tlog;
use Thelia\Model\ConfigQuery;

/**
 * Class Configuration
 * @package HookFetes\Controller
 * @author Francois Carfantan <f.carfantan@orange.fr>
 */
class Configuration extends BaseAdminController
{
    public function create(ActionEvent $event) 
    {
        // Retrieve your request, in an action the request is in the ActionEvent instance
        $request = $event->getRequest();
        
        // Create an instance of your form
        $request = $this->getRequest();
        $fetesForm = $this->createForm('hookfetes.configuration.form');
        
        
        
        $form->bind($request);
        
        if($form->isValid()) {
            // Ok, your form is valid, you can persist your customer and display the result template
        } 
        else {
            // There is at least one error
        }
    }

    
}