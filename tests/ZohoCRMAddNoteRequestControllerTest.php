<?php

namespace Grayl\Test\Gateway\ZohoCRM;

use Grayl\Gateway\ZohoCRM\Controller\ZohoCRMAddNoteRequestController;
use Grayl\Gateway\ZohoCRM\Controller\ZohoCRMAddNoteResponseController;
use Grayl\Gateway\ZohoCRM\Entity\ZohoCRMGatewayData;
use Grayl\Gateway\ZohoCRM\ZohoCRMPorter;
use PHPUnit\Framework\TestCase;

/**
 * Test class for the ZohoCRM add note routines
 *
 * @package Grayl\Gateway\ZohoCRM
 */
class ZohoCRMAddNoteRequestControllerTest extends
    TestCase
{

    /**
     * Test setup for sandbox environment
     */
    public static function setUpBeforeClass(): void
    {

        // Change the ZohoCRM API to sandbox mode
        ZohoCRMPorter::getInstance()
            ->setEnvironment('sandbox');
    }


    /**
     * Tests the creation of a ZohoCRMGatewayData object
     *
     * @return ZohoCRMGatewayData
     * @throws \Exception
     */
    public function testCreateZohoCRMGatewayData(): ZohoCRMGatewayData
    {

        // Create the object
        $gateway = ZohoCRMPorter::getInstance()
            ->getSavedGatewayDataEntity(
                'default'
            );

        // Check the type of object returned
        $this->assertInstanceOf(
            ZohoCRMGatewayData::class,
            $gateway
        );

        // Return the object
        return $gateway;
    }


    /**
     * Tests the creation of a ZohoCRMAddNoteRequestController object
     *
     * @return ZohoCRMAddNoteRequestController
     * @throws \Exception
     */
    public function testCreateZohoCRMAddNoteRequestController(
    ): ZohoCRMAddNoteRequestController
    {

        // TODO: This test data needs to be located externally
        // Create the object
        $request = ZohoCRMPorter::getInstance()
            ->newZohoCRMAddNoteRequestController(
                'Contacts',
                '612537000006154157',
                'Testing',
                date('l jS \of F Y h:i:s A')
            );

        // Check the type of object returned
        $this->assertInstanceOf(
            ZohoCRMAddNoteRequestController::class,
            $request
        );

        // Return the object
        return $request;
    }


    /**
     * Tests the sending of a ZohoCRMAddNoteRequestData through a ZohoCRMAddNoteRequestController
     *
     * @param ZohoCRMAddNoteRequestController $request A configured ZohoCRMAddNoteRequestController entity to use as a gateway
     *
     * @depends testCreateZohoCRMAddNoteRequestController
     * @return ZohoCRMAddNoteResponseController
     * @throws \Exception
     */
    public function testSendZohoCRMAddNoteRequestController(
        ZohoCRMAddNoteRequestController $request
    ) {

        // Send the request using the gateway
        $response = $request->sendRequest();

        // Check the type of object returned
        $this->assertInstanceOf(
            ZohoCRMAddNoteResponseController::class,
            $response
        );

        // Return the response
        return $response;
    }


    /**
     * Checks a ZohoCRMAddNoteResponseController for data and errors
     *
     * @param ZohoCRMAddNoteResponseController $response A ZohoCRMAddNoteResponseController returned from the gateway
     *
     * @depends  testSendZohoCRMAddNoteRequestController
     */
    public function testZohoCRMResponseController(
        ZohoCRMAddNoteResponseController $response
    ): void {

        // Test the data
        $this->assertTrue($response->isSuccessful());
        $this->assertNotNull($response->getReferenceID());

        // Test the raw data
        $this->assertIsArray($response->getData());
    }

}