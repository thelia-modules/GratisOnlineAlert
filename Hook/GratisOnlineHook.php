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

namespace GratisOnlineAlert\Hook;

use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;

class GratisOnlineHook extends BaseHook
{
    public function onHomeTop(HookRenderEvent $event)
    {
        $event->add($this->render('home-top.html'));
    }
}
