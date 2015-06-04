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
/*************************************************************************************/
namespace GratisOnlineAlert\Controller;

use Thelia\Model\ConfigQuery;
use \GratisOnlineAlert\GratisOnlineAlert;
use \Thelia\Controller\Admin\BaseAdminController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ConfigurationController
 */
class ConfigurationController extends BaseAdminController
{


    public function togglePropEventConfAction()
    {
        $stop_prop = ConfigQuery::read(GratisOnlineAlert::EVENT_STOP_PROPAGATION);
        $stop_prop = $stop_prop ? false : true;
        $resp = array(
            "message" => ""
        );
        $code = 200;
        try {
            ConfigQuery::write(GratisOnlineAlert::EVENT_STOP_PROPAGATION, $stop_prop, false, true);
            $resp["message"] = $this->getTranslator()->trans("Toggle Propagation saved", [],
                GratisOnlineAlert::MESSAGE_DOMAIN);
        } catch (\Exception $e) {
            $resp["message"] = $e->getMessage();
            $code = 500;
        }

        return JsonResponse::create($resp, $code);


    }

    public function toggleAlertConfAction()
    {
        $stop_prop = ConfigQuery::read(GratisOnlineAlert::EVENT_SEND_MAIL);
        $stop_prop = $stop_prop ? false : true;
        $resp = array(
            "message" => ""
        );
        $code = 200;
        try {
            ConfigQuery::write(GratisOnlineAlert::EVENT_SEND_MAIL, $stop_prop, false, true);
            $resp["message"] = $this->getTranslator()->trans("Toggle mail saved", [],
                GratisOnlineAlert::MESSAGE_DOMAIN);
        } catch (\Exception $e) {
            $resp["message"] = $e->getMessage();
            $code = 500;
        }

        return JsonResponse::create($resp, $code);

    }

    protected function reverseBool($bool)
    {
        return $bool ? false : true;
    }
}