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
        'intro' => 'Les produits suivants sont gratuits et visibles en ligne :',
        'product %product_url %product_ref %pse_ref %currency' => '<a href="%product_url">%product_ref</a>, référence "%pse_ref", pour la devise %currency.',
        'in_promo' => 'Actuellement en promotion.',
        'admin' => array(
            'title' => 'Titre',
            'description' => 'Description',
            'action' => 'Action',
            'event_propagation' => array(
                'title' => 'Propagation des évènements',
                'legend' => 'Activez pour arrêter la création ou la mise à jour de produits s\'ils sont gratuits.',
            ),
            'mail_alert' => array(
                'title' => 'Alerte email',
                'legend' => 'Activez pour recevoir une alerte par courriel lorsqu\'un produit devient gratuit.',
            ),
            'toggle_noscript' => array(
                'deactivation' => 'Désactivation',
                'activation' => 'Activation',
            ),
        ),
    )
);
