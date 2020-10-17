<?php

namespace Grayl\Gateway\ZohoCRM\Service;

use Grayl\Gateway\Common\Service\RequestServiceInterface;
use Grayl\Gateway\ZohoCRM\Entity\ZohoCRMGatewayData;
use Grayl\Gateway\ZohoCRM\Entity\ZohoCRMUpsertContactRequestData;
use Grayl\Gateway\ZohoCRM\Entity\ZohoCRMUpsertContactResponseData;
use zcrmsdk\crm\api\response\EntityResponse;
use zcrmsdk\crm\crud\ZCRMRecord;

/**
 * Class ZohoCRMUpsertContactRequestService
 * The service for working with ZohoCRM API user requests
 *
 * @package Grayl\Gateway\ZohoCRM
 */
class ZohoCRMUpsertContactRequestService implements
    RequestServiceInterface
{

    /**
     * Sends a ZohoCRMUpsertContactRequestData object to the ZohoCRM gateway and returns a response
     *
     * @param ZohoCRMGatewayData              $gateway_data A configured ZohoCRMGatewayData entity to send the request through
     * @param ZohoCRMUpsertContactRequestData $request_data The ZohoCRMUpsertContactRequestData entity to send
     *
     * @return ZohoCRMUpsertContactResponseData
     * @throws \Exception
     */
    public function sendRequestDataEntity(
        $gateway_data,
        $request_data
    ): object {

        // Build the request
        $api_request = $gateway_data->getAPI()
            ->getModuleInstance("Contacts");

        // Create a contact object
        $parameters = ZCRMRecord::getInstance(
            "Contacts",
            null
        );

        // Populate request data into the contact instance
        $this->translateZohoCRMUpsertContactRequest(
            $parameters,
            $request_data
        );

        // Send the request
        $bulk_response = $api_request->upsertRecords(
            [$parameters],
            null,
            null,
            ['Email']
        );

        // Zoho returns an array of response entities, we only want the first one
        /** @var EntityResponse $response */
        $response = $bulk_response->getEntityResponses()[0];

        // Return a new response entity with the action specified
        return $this->newResponseDataEntity(
            $response,
            $gateway_data->getGatewayName(),
            'create_or_update',
            []
        );
    }


    /**
     * Creates a new ZohoCRMUpsertContactResponseData object to handle data returned from the gateway
     *
     * @param EntityResponse $api_response The response object received directly from a gateway
     * @param string         $gateway_name The name of the gateway
     * @param string         $action       The action performed in this response (send, sendTemplate, etc.)
     * @param string[]       $metadata     Extra data associated with this response
     *
     * @return ZohoCRMUpsertContactResponseData
     */
    public function newResponseDataEntity(
        $api_response,
        string $gateway_name,
        string $action,
        array $metadata
    ): object {

        // Return a new ZohoCRMUpsertContactResponseData entity
        return new ZohoCRMUpsertContactResponseData(
            $api_response,
            $gateway_name,
            $action
        );
    }


    /**
     * Translates a ZohoCRMUpsertContactRequestData into a ZCRMRecord required by the API
     *
     * @param ZCRMRecord                      $zcrm_contact A ZCRMRecord entity to translate data into
     * @param ZohoCRMUpsertContactRequestData $request_data A ZohoCRMUpsertContactRequestData entity to translate from
     */
    private function translateZohoCRMUpsertContactRequest(
        ZCRMRecord $zcrm_contact,
        ZohoCRMUpsertContactRequestData $request_data
    ): void {

        // Translate data into Zoho fields
        $zcrm_contact->setFieldValue(
            "Email",
            $request_data->getEmailAddress()
        );
        $zcrm_contact->setFieldValue(
            "Last_Name",
            $request_data->getName()
        );

        // Loop through each contact field and set it into the Zoho contact record
        foreach (
            $request_data->getContactFields() as $key => $value
        ) {
            // Set the field
            $zcrm_contact->setFieldValue(
                str_replace(
                    ' ',
                    '_',
                    $key
                ),
                $value
            );
        }
    }

}