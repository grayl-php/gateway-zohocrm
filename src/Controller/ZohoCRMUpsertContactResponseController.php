<?php

namespace Grayl\Gateway\ZohoCRM\Controller;

use Grayl\Gateway\Common\Controller\ResponseControllerAbstract;
use Grayl\Gateway\Common\Entity\ResponseDataAbstract;
use Grayl\Gateway\Common\Service\ResponseServiceInterface;
use Grayl\Gateway\ZohoCRM\Entity\ZohoCRMUpsertContactResponseData;
use Grayl\Gateway\ZohoCRM\Service\ZohoCRMUpsertContactResponseService;

/**
 * Class ZohoCRMUpsertContactResponseController
 * The controller for working with ZohoCRMUpsertContactResponseData entities
 *
 * @package Grayl\Gateway\ZohoCRM
 */
class ZohoCRMUpsertContactResponseController extends
    ResponseControllerAbstract
{

    /**
     * The ZohoCRMUpsertContactResponseData object that holds the gateway API response
     *
     * @var ZohoCRMUpsertContactResponseData
     */
    protected ResponseDataAbstract $response_data;

    /**
     * The ZohoCRMUpsertContactResponseService entity to use
     *
     * @var ZohoCRMUpsertContactResponseService
     */
    protected ResponseServiceInterface $response_service;

}