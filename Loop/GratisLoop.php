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

namespace GratisOnlineAlert\Loop;

use Thelia\Core\Template\Element\BaseLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Element\PropelSearchLoopInterface;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;
use Thelia\Model\ProductQuery;

class GratisLoop extends BaseLoop implements PropelSearchLoopInterface
{

    public $countable = true;

    public $timestampable = false;

    public $versionable = false;

    /**
     * Loop arguments.
     *
     * The loop does not take any arguments.
     * @return ArgumentCollection Loop arguments, i.e. an empty argument collection.
     */
    protected function getArgDefinitions()
    {
        return new ArgumentCollection();
    }

    /**
     * Request in order to retrieve online products whose online price is 0.
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function buildModelCriteria()
    {
        return ProductQuery::create()
            ->join('Product.ProductSaleElements')
            ->join('ProductSaleElements.ProductPrice')
            ->join('ProductPrice.Currency')
                        ->condition('promo', 'ProductSaleElements.Promo = ?', true)
                        ->condition('free_promo_price', 'ProductPrice.PromoPrice = ?', 0)
                    ->combine(array('promo', 'free_promo_price'), 'and', 'promo_cond')
                            ->condition('no_promo_false', 'ProductSaleElements.Promo = ?', false)
                            ->condition('no_promo_null', 'ProductSaleElements.Promo IS NULL')
                        ->combine(array('no_promo_false', 'no_promo_null'), 'or', 'no_promo')
                        ->condition('free_price', 'ProductPrice.price = ?', 0)
                    ->combine(array('no_promo', 'free_price'), 'and', 'no_promo_cond')
                ->combine(array('promo_cond', 'no_promo_cond'), 'or', 'price_cond')
                ->condition('online', 'Product.Visible = ?', true)
            ->where(array('online', 'price_cond'), 'and')
            ->select(array(
                'Product.Id',
                'Product.Ref',
                'ProductSaleElements.Ref',
                'ProductSaleElements.Promo',
                'Currency.Code',
            ))
        ;
    }

    /**
     * Loop results.
     *
     * The loop returns the following results :
     * - PRODUCT_ID: product ID.
     * - PRODUCT_REF: product reference.
     * - PSE_REF: product sale element reference.
     * - PROMO: boolean whose value is true if the pse is in promo, false otherwise.
     * - CURRENCY: currency code.
     * @param LoopResult $loopResult Query results
     * @return LoopResult Loop results
     */
    public function parseResults(LoopResult $loopResult)
    {
        foreach ($loopResult->getResultDataCollection() as $loopRow) {
            $loopResultRow = new LoopResultRow();
            $loopResultRow->set('PRODUCT_ID', $loopRow['Product.Id']);
            $loopResultRow->set('PRODUCT_REF', $loopRow['Product.Ref']);
            $loopResultRow->set('PSE_REF', $loopRow['ProductSaleElements.Ref']);
            $loopResultRow->set('PROMO', $loopRow['ProductSaleElements.Promo']);
            $loopResultRow->set('CURRENCY', $loopRow['Currency.Code']);
            $loopResult->addRow($loopResultRow);
        }

        return $loopResult;
    }
}
