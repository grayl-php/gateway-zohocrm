<?php

   namespace Grayl\Gateway\ZohoCRM\Entity;

   use Grayl\Gateway\Common\Entity\ResponseDataAbstract;
   use zcrmsdk\crm\api\response\EntityResponse;

   /**
    * Class ZohoCRMUpsertContactResponseData
    * The class for working with a user response from the ZohoCRM gateway
    * @method void setAPIResponse( EntityResponse $api_response )
    * @method EntityResponse getAPIResponse()
    *
    * @package Grayl\Gateway\ZohoCRM
    */
   class ZohoCRMUpsertContactResponseData extends ResponseDataAbstract
   {

      /**
       * The raw API response entity from the gateway
       *
       * @var EntityResponse
       */
      protected $api_response;

   }