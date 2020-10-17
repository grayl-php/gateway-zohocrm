<?php

namespace Grayl\Gateway\ZohoCRM\Entity;

use Grayl\Gateway\Common\Entity\GatewayDataAbstract;
use zcrmsdk\crm\setup\restclient\ZCRMRestClient;

/**
 * Class ZohoCRMGatewayData
 * The entity for the ZohoCRM API
 * @method void __construct(ZCRMRestClient $api, string $gateway_name, string $environment)
 * @method void setAPI(ZCRMRestClient $api)
 * @method ZCRMRestClient getAPI()
 *
 * @package Grayl\Gateway\ZohoCRM
 */
class ZohoCRMGatewayData extends
    GatewayDataAbstract
{

    /**
     * Fully configured ZCRMRestClient entity
     *
     * @var ZCRMRestClient
     */
    protected $api;

}