<?php

   namespace Grayl\Gateway\ZohoCRM\Service;

   use Grayl\Gateway\Common\Service\RequestServiceInterface;
   use Grayl\Gateway\ZohoCRM\Entity\ZohoCRMAddNoteRequestData;
   use Grayl\Gateway\ZohoCRM\Entity\ZohoCRMAddNoteResponseData;
   use Grayl\Gateway\ZohoCRM\Entity\ZohoCRMGatewayData;
   use zcrmsdk\crm\api\response\APIResponse;
   use zcrmsdk\crm\crud\ZCRMNote;

   /**
    * Class ZohoCRMAddNoteRequestService
    * The service for working with ZohoCRM API user requests
    *
    * @package Grayl\Gateway\ZohoCRM
    */
   class ZohoCRMAddNoteRequestService implements RequestServiceInterface
   {

      /**
       * Sends a ZohoCRMAddNoteRequestData object to the ZohoCRM gateway and returns a response
       *
       * @param ZohoCRMGatewayData        $gateway_data A configured ZohoCRMGatewayData entity to send the request through
       * @param ZohoCRMAddNoteRequestData $request_data The ZohoCRMAddNoteRequestData entity to send
       *
       * @return ZohoCRMAddNoteResponseData
       * @throws \Exception
       */
      public function sendRequestDataEntity ( $gateway_data,
                                              $request_data ): object
      {

         // Build the request
         $api_request = $gateway_data->getAPI()
                                     ->getRecordInstance( $request_data->getModuleName(),
                                                          $request_data->getParentId() );

         // Create a note object
         $parameters = ZCRMNote::getInstance( $api_request,
                                              null );

         // Populate request data into the note instance
         $this->translateZohoCRMAddNoteRequest( $parameters,
                                                $request_data );

         // Send the request
         $response = $api_request->addNote( $parameters );

         // Return a new response entity with the action specified
         return $this->newResponseDataEntity( $response,
                                              $gateway_data->getGatewayName(),
                                              'add_note',
                                              [] );
      }


      /**
       * Creates a new ZohoCRMAddNoteResponseData object to handle data returned from the gateway
       *
       * @param APIResponse $api_response The response object received directly from a gateway
       * @param string      $gateway_name The name of the gateway
       * @param string      $action       The action performed in this response (send, sendTemplate, etc.)
       * @param string[]    $metadata     Extra data associated with this response
       *
       * @return ZohoCRMAddNoteResponseData
       */
      public function newResponseDataEntity ( $api_response,
                                              string $gateway_name,
                                              string $action,
                                              array $metadata ): object
      {

         // Return a new ZohoCRMAddNoteResponseData entity
         return new ZohoCRMAddNoteResponseData( $api_response,
                                                $gateway_name,
                                                $action );
      }


      /**
       * Translates a ZohoCRMAddNoteRequestData into a ZCRMNote required by the API
       *
       * @param ZCRMNote                  $zcrm_note    A ZCRMNote entity to translate data into
       * @param ZohoCRMAddNoteRequestData $request_data A ZohoCRMAddNoteRequestData entity to translate from
       */
      private function translateZohoCRMAddNoteRequest ( ZCRMNote $zcrm_note,
                                                        ZohoCRMAddNoteRequestData $request_data ): void
      {

         // Translate data into Zoho fields
         $zcrm_note->setTitle( $request_data->getTitle() ); // to set the note title
         $zcrm_note->setContent( $request_data->getContent() );
      }

   }