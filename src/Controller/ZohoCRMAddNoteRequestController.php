<?php

   namespace Grayl\Gateway\ZohoCRM\Controller;

   use Grayl\Gateway\Common\Controller\RequestControllerAbstract;
   use Grayl\Gateway\ZohoCRM\Entity\ZohoCRMAddNoteRequestData;
   use Grayl\Gateway\ZohoCRM\Entity\ZohoCRMAddNoteResponseData;

   /**
    * Class ZohoCRMAddNoteRequestController
    * The controller for working with ZohoCRMAddNoteRequestData entities
    * @method ZohoCRMAddNoteRequestData getRequestData()
    * @method ZohoCRMAddNoteResponseController sendRequest()
    *
    * @package Grayl\Gateway\ZohoCRM
    */
   class ZohoCRMAddNoteRequestController extends RequestControllerAbstract
   {

      /**
       * Creates a new ZohoCRMAddNoteResponseController to handle data returned from the gateway
       *
       * @param ZohoCRMAddNoteResponseData $response_data The ZohoCRMAddNoteResponseData entity received from the gateway
       *
       * @return ZohoCRMAddNoteResponseController
       */
      public function newResponseController ( $response_data ): object
      {

         // Return a new ZohoCRMAddNoteResponseController entity
         return new ZohoCRMAddNoteResponseController( $response_data,
                                                      $this->response_service );
      }

   }