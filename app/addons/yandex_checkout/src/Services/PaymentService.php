<?php
/***************************************************************************
 *                                                                          *
 *   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
 *                                                                          *
 * This  is  commercial  software,  only  users  who have purchased a valid *
 * license  and  accept  to the terms of the  License Agreement can install *
 * and use this program.                                                    *
 *                                                                          *
 ****************************************************************************
 * PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
 * "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
 ****************************************************************************/

namespace Tygh\Addons\YandexCheckout\Services;

use YooKassa\Model\PaymentInterface;

/**
 * Class PaymentService collects functions that requires to operations with payment information
 *
 * @package Tygh\Addons\YandexCheckout\Services
 */
class PaymentService
{
    /**
     * Returns payment id from order information
     *
     * @param array $order_info Order information
     *
     * @return string Payment ID
     */
    function getPaymentId(array $order_info)
    {
        $payment_id = '';
        if (isset($order_info['payment_info']['payment_id'])) {
            $payment_id = $order_info['payment_info']['payment_id'];
        } elseif (isset($order_info['payment_info']['id'])) {
            $payment_id = $order_info['payment_info']['id'];
        }

        return $payment_id;
    }

    function hasTransferForCompany(PaymentInterface $payment_info, $company_id)
    {
        return !empty($payment_info->metadata["transfer_{$company_id}"]);
    }

    function getTransferForCompany(PaymentInterface $payment_info, $company_id)
    {
        if (!$this->hasTransferForCompany($payment_info, $company_id)) {
            return 0.0;
        }

        return (float) $payment_info->metadata["transfer_{$company_id}"];
    }
}