<?php

   namespace Grayl\Gateway\ZohoCRM\Entity;

   use Grayl\Gateway\Common\Entity\ResponseDataAbstract;
   use zcrmsdk\crm\api\response\APIResponse;

   /**
    * Class ZohoCRMAddNoteResponseData
    * The class for working with an add note response from the ZohoCRM gateway
    * @method void setAPIResponse( APIResponse $api_response )
    * @method APIResponse getAPIResponse()
    *
    * @package Grayl\Gateway\ZohoCRM
    */
   class ZohoCRMAddNoteResponseData extends ResponseDataAbstract
   {

      /**
       * The raw API response entity from the gateway
       *
       * @var APIResponse
       */
      protected $api_response;

   }