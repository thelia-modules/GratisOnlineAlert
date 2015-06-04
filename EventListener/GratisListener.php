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
namespace GratisOnlineAlert\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Thelia\Action\BaseAction;
use Thelia\Core\Event\Product\ProductCreateEvent;
use Thelia\Core\Event\TheliaEvents;
use Thelia\Model\ConfigQuery;
use \GratisOnlineAlert\GratisOnlineAlert;
use Thelia\Mailer\MailerFactory;

/**
 * Class GratisListener
 */
class GratisListener extends BaseAction implements EventSubscriberInterface
{

    /**
     * @var MailerFactory
     */
    protected $mailer;

    public function __construct(MailerFactory $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        return array(
            TheliaEvents::PRODUCT_CREATE => [["checkPriceStopProp", 255], ["checkPriceSendMail", 30]],
            TheliaEvents::PRODUCT_UPDATE => [["checkPriceStopProp", 255], ["checkPriceSendMail", 30]]
        );
    }

    public function checkPriceStopProp(ProductCreateEvent $event)
    {
        if ($event->getBasePrice() == 0) {
            if (ConfigQuery::read(GratisOnlineAlert::EVENT_STOP_PROPAGATION)) {
                $event->stopPropagation();
            }
        }
    }

    public function checkPriceSendMail(ProductCreateEvent $event)
    {
        if ($event->getBasePrice() == 0) {
            if (ConfigQuery::read(GratisOnlineAlert::EVENT_SEND_MAIL)) {
                $product = $event->getProduct();
                if ($product) {
                    $this->mailer->sendEmailToShopManagers(GratisOnlineAlert::MAIL_CODE,
                        [
                            "REF" => $product->getRef(),
                            "URL" => $product->getUrl(),
                            "TITLE" => $product->getTitle()
                        ]);
                }
            }
        }
    }
}
