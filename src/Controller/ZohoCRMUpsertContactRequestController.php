<?php

   namespace Grayl\Gateway\ZohoCRM\Controller;

   use Grayl\Gateway\Common\Controller\RequestControllerAbstract;
   use Grayl\Gateway\ZohoCRM\Entity\ZohoCRMUpsertContactRequestData;
   use Grayl\Gateway\ZohoCRM\Entity\ZohoCRMUpsertContactResponseData;

   /**
    * Class ZohoCRMUpsertContactRequestController
    * The controller for working with ZohoCRMUpsertContactRequestData entities
    * @method ZohoCRMUpsertContactRequestData getRequestData()
    * @method ZohoCRMUpsertContactResponseController sendRequest()
    *
    * @package Grayl\Gateway\ZohoCRM
    */
   class ZohoCRMUpsertContactRequestController extends RequestControllerAbstract
   {

      /**
       * Creates a new ZohoCRMUpsertContactResponseController to handle data returned from the gateway
       *
       * @param ZohoCRMUpsertContactResponseData $response_data The ZohoCRMUpsertContactResponseData entity received from the gateway
       *
       * @return ZohoCRMUpsertContactResponseController
       */
      public function newResponseController ( $response_data ): object
      {

         // Return a new ZohoCRMUpsertContactResponseController entity
         return new ZohoCRMUpsertContactResponseController( $response_data,
                                                            $this->response_service );
      }

   }