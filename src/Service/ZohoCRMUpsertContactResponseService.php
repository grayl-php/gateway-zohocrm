<?php

   namespace Grayl\Gateway\ZohoCRM\Service;

   use Grayl\Gateway\Common\Service\ResponseServiceInterface;
   use Grayl\Gateway\ZohoCRM\Entity\ZohoCRMUpsertContactResponseData;

   /**
    * Class ZohoCRMUpsertContactResponseService
    * The service for working with ZohoCRM API user responses
    *
    * @package Grayl\Gateway\ZohoCRM
    */
   class ZohoCRMUpsertContactResponseService implements ResponseServiceInterface
   {

      /**
       * Returns a true / false value based on a gateway API response
       *
       * @param ZohoCRMUpsertContactResponseData $response_data The response object to check
       *
       * @return bool
       */
      public function isSuccessful ( $response_data ): bool
      {

         // For a successful response
         if ( $response_data->getAPIResponse()
                            ->getStatus() == 'success' ) {
            // Success
            return true;
         }

         // Failure
         return false;
      }


      /**
       * Returns the reference ID from a gateway API response
       *
       * @param ZohoCRMUpsertContactResponseData $response_data The response object to pull the reference ID from
       *
       * @return string
       */
      public function getReferenceID ( $response_data ): ?string
      {

         // Get the ID field from the body
         if ( ! empty( $response_data->getAPIResponse()
                                     ->getDetails()[ 'id' ] ) ) {
            // Return the ID field
            return $response_data->getAPIResponse()
                                 ->getDetails()[ 'id' ];
         }

         // No ID found
         return null;
      }


      /**
       * Returns the status message from a gateway API response
       *
       * @param ZohoCRMUpsertContactResponseData $response_data The response object to get the message from
       *
       * @return string
       */
      public function getMessage ( $response_data ): ?string
      {

         // Return the message field
         return $response_data->getAPIResponse()
                              ->getMessage();
      }


      /**
       * Returns the raw data from a gateway API response
       *
       * @param ZohoCRMUpsertContactResponseData $response_data The response object to get the data from
       *
       * @return array
       * @noinspection PhpIncompatibleReturnTypeInspection
       */
      public function getData ( $response_data ): array
      {

         // Return the raw response data
         // The Zoho PHP SDK has this incorrectly labeled as returning an object when it returns an array
         return $response_data->getAPIResponse()
                              ->getResponseJSON();
      }

   }