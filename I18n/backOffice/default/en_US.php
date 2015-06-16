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

return array(
    'gratisonlinealert' => array(
        'intro' => 'The following products are currently free online:',
        'product %product_url %product_ref %pse_ref %currency' => '<a href="%product_url">%product_ref</a>, reference "%pse_ref", for the %currency currency.',
        'in_promo' => 'Currently in promo.',
        'admin' => array(
            'title' => 'Title',
            'description' => 'Description',
            'action' => 'Action',
            'event_propagation' => array(
                'title' => 'Event Propagation',
                'legend' => 'Use it to stop create or update product if free',
            ),
            'mail_alert' => array(
                'title' => 'Mail Alert',
                'legend' => 'Use it to receive a mail alert',
            ),
            'toggle_noscript' => array(
                'deactivation' => 'Deactivation',
                'activation' => 'Activation',
            ),
        ),
    )
);
