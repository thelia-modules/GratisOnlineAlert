<?php
/*************************************************************************************/
/*      This file is part of the "GratisOnlineAlert" Thelia 2 module.                */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

namespace GratisOnlineAlert;

use Propel\Runtime\Connection\ConnectionInterface;
use Thelia\Module\BaseModule;
use Thelia\Model\ConfigQuery;

class GratisOnlineAlert extends BaseModule
{
    const MESSAGE_DOMAIN = 'gratisonlinealert';
    const BO_MESSAGE_DOMAIN = 'gratisonlinealert.bo.default';

    const EVENT_STOP_PROPAGATION = "gratisonlinealert.stop.propagation";
    const EVENT_SEND_MAIL = "gratisonlinealert.send.mail";


    public function postActivation(ConnectionInterface $con = null)
    {
        ConfigQuery::write(GratisOnlineAlert::EVENT_SEND_MAIL, false, false, true);
        ConfigQuery::write(GratisOnlineAlert::EVENT_STOP_PROPAGATION, false, false, true);
    }
}
