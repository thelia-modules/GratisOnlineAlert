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
use Thelia\Model\Base\MessageQuery;
use Thelia\Model\LangQuery;
use Thelia\Model\Message;
use Thelia\Core\Translation\Translator;
use Thelia\Model\Lang;

class GratisOnlineAlert extends BaseModule
{
    const MESSAGE_DOMAIN = 'gratisonlinealert';
    const BO_MESSAGE_DOMAIN = 'gratisonlinealert.bo.default';

    const EVENT_STOP_PROPAGATION = "gratisonlinealert.stop.propagation";
    const EVENT_SEND_MAIL = "gratisonlinealert.send.mail";

    const SEND_MAIL = "gratisonlinealert.send.mail.event";
    const MAIL_CODE = "gratis_alert_mail";


    /** @var Translator $translator */
    protected $translator;

    protected function trans($id, $locale, $parameters = [])
    {
        if ($this->translator === null) {
            $this->translator = Translator::getInstance();
        }

        return $this->translator->trans($id, $parameters, self::MESSAGE_DOMAIN, $locale);
    }

    public function postActivation(ConnectionInterface $con = null)
    {
        ConfigQuery::write(GratisOnlineAlert::EVENT_SEND_MAIL, false, false, true);
        ConfigQuery::write(GratisOnlineAlert::EVENT_STOP_PROPAGATION, false, false, true);

        $languages = LangQuery::create()->find();


        if (null === MessageQuery::create()->findOneByName(self::MAIL_CODE)) {
            $message = new Message();
            $message
                ->setName(self::MAIL_CODE)
                ->setHtmlLayoutFileName('')
                ->setHtmlTemplateFileName('gratis_alert_mail.html')
                ->setTextLayoutFileName('')
                ->setTextTemplateFileName('gratis_alert_mail.txt')
                ->setSecured(0);

            foreach ($languages as $language) {
                /** @var Lang $language */
                $locale = $language->getLocale();

                $message->setLocale($locale);

                $message->setTitle(
                    $this->trans('Free product, alert message for admin', $locale)
                );

                $message->setSubject(
                    $this->trans('A product is Free', $locale)
                );
            }

            $message->save();
        }
    }
}
