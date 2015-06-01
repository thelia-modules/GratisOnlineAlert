<?php
/**
 * Created by PhpStorm.
 * User: ducher
 * Date: 01/06/15
 * Time: 10:06
 */

namespace GratisOnlineAlert\Hook;

use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;

class GratisOnlineHook extends BaseHook {
    public function onHomeTop(HookRenderEvent $event) {
        $event->add($this->render('home-top.html'));
    }
}
