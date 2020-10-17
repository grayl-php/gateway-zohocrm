<?php

namespace Grayl\Gateway\ZohoCRM;

use Grayl\Gateway\Common\GatewayPorterAbstract;
use Grayl\Gateway\ZohoCRM\Controller\ZohoCRMAddNoteRequestController;
use Grayl\Gateway\ZohoCRM\Controller\ZohoCRMUpsertContactRequestController;
use Grayl\Gateway\ZohoCRM\Entity\ZohoCRMAddNoteRequestData;
use Grayl\Gateway\ZohoCRM\Entity\ZohoCRMGatewayData;
use Grayl\Gateway\ZohoCRM\Entity\ZohoCRMUpsertContactRequestData;
use Grayl\Gateway\ZohoCRM\Service\ZohoCRMAddNoteRequestService;
use Grayl\Gateway\ZohoCRM\Service\ZohoCRMAddNoteResponseService;
use Grayl\Gateway\ZohoCRM\Service\ZohoCRMGatewayService;
use Grayl\Gateway\ZohoCRM\Service\ZohoCRMUpsertContactRequestService;
use Grayl\Gateway\ZohoCRM\Service\ZohoCRMUpsertContactResponseService;
use Grayl\Mixin\Common\Traits\StaticTrait;
use zcrmsdk\crm\setup\restclient\ZCRMRestClient;
use zcrmsdk\oauth\ZohoOAuth;

/**
 * Front-end for the ZohoCRM package
 * @method ZohoCRMGatewayData getSavedGatewayDataEntity (string $endpoint_id)
 *
 * @package Grayl\Gateway\ZohoCRM
 */
class ZohoCRMPorter extends
    GatewayPorterAbstract
{

    // Use the static instance trait
    use StaticTrait;

    /**
     * The name of the config file for the ZohoCRM package
     *
     * @var string
     */
    protected string $config_file = 'gateway.zohocrm.php';


    /**
     * Creates a new ZohoCRM object for use in a ZohoCRMGatewayData entity
     *
     * @param array $credentials An array containing all of the credentials needed to create the gateway API
     *
     * @return ZCRMRestClient
     * @throws \Exception
     */
    public function newGatewayAPI(array $credentials): object
    {

        // Create the configuration array
        $configuration = [
            'client_id'              => $credentials['client_id'],
            'client_secret'          => $credentials['client_secret'],
            'redirect_uri'           => $credentials['redirect_uri'],
            'currentUserEmail'       => $credentials['currentUserEmail'],
            'token_persistence_path' => $credentials['token_persistence_path'],
        ];

        // Initialize the ZCRMRestClient with the configuration
        ZCRMRestClient::initialize($configuration);

        // Update OAuth tokens
        ZohoOAuth::getClientInstance()
            ->generateAccessTokenFromRefreshToken(
                $credentials['refresh_token'],
                $credentials['identifier']
            );

        // Return the new API entity
        return ZCRMRestClient::getInstance();
    }


    /**
     * Creates a new ZohoCRMGatewayData entity
     *
     * @param string $endpoint_id The API endpoint ID to use (typically "default" is there is only one API gateway)
     *
     * @return ZohoCRMGatewayData
     * @throws \Exception
     */
    public function newGatewayDataEntity(string $endpoint_id): object
    {

        // Grab the gateway service
        $service = new ZohoCRMGatewayService();

        // Get an API
        $api = $this->newGatewayAPI(
            $service->getAPICredentials(
                $this->config,
                $this->environment,
                $endpoint_id
            )
        );

        // Configure the API as needed using the service
        $service->configureAPI(
            $api,
            $this->environment
        );

        // Return the gateway
        return new ZohoCRMGatewayData(
            $api,
            $this->config->getConfig('name'),
            $this->environment
        );
    }


    /**
     * Creates a new ZohoCRMUpsertContactRequestController entity
     *
     * @param string $email_address  The email address of the contact
     * @param string $name           The name of the contact
     * @param array  $contact_fields The associative array of custom field values to set for this contact
     *
     * @return ZohoCRMUpsertContactRequestController
     * @throws \Exception
     */
    public function newZohoCRMUpsertContactRequestController(
        string $email_address,
        string $name,
        array $contact_fields
    ): ZohoCRMUpsertContactRequestController {

        // Create a new ZohoCRMUpsertContactRequestData entity
        $request_data = new ZohoCRMUpsertContactRequestData(
            'upsert_contact',
            $email_address,
            $name,
            $contact_fields
        );

        // Return a new ZohoCRMUpsertContactRequestController entity
        return new ZohoCRMUpsertContactRequestController(
            $this->getSavedGatewayDataEntity('default'),
            $request_data,
            new ZohoCRMUpsertContactRequestService(),
            new ZohoCRMUpsertContactResponseService()
        );
    }


    /**
     * Creates a new ZohoCRMAddNoteRequestController entity
     *
     * @param string $module_name The module of the note (i.e. "Contacts" or "Leads")
     * @param string $parent_id   The ID of the parent record the note will be attached to
     * @param string $title       The title of the note
     * @param string $content     The content of the note
     *
     * @return ZohoCRMAddNoteRequestController
     * @throws \Exception
     */
    public function newZohoCRMAddNoteRequestController(
        string $module_name,
        string $parent_id,
        string $title,
        string $content
    ): ZohoCRMAddNoteRequestController {

        // Create a new ZohoCRMAddNoteRequestData entity
        $request_data = new ZohoCRMAddNoteRequestData(
            'add_note',
            $module_name,
            $parent_id,
            $title,
            $content
        );

        // Return a new ZohoCRMAddNoteRequestController entity
        return new ZohoCRMAddNoteRequestController(
            $this->getSavedGatewayDataEntity('default'),
            $request_data,
            new ZohoCRMAddNoteRequestService(),
            new ZohoCRMAddNoteResponseService()
        );
    }

}