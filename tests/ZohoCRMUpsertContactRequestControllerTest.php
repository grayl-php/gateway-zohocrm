<?php

   namespace Grayl\Test\Gateway\ZohoCRM;

   use Grayl\Gateway\ZohoCRM\Controller\ZohoCRMUpsertContactRequestController;
   use Grayl\Gateway\ZohoCRM\Controller\ZohoCRMUpsertContactResponseController;
   use Grayl\Gateway\ZohoCRM\Entity\ZohoCRMGatewayData;
   use Grayl\Gateway\ZohoCRM\ZohoCRMPorter;
   use PHPUnit\Framework\TestCase;

   /**
    * Test class for the ZohoCRM upsert contact routines
    *
    * @package Grayl\Gateway\ZohoCRM
    */
   class ZohoCRMUpsertContactRequestControllerTest extends TestCase
   {

      /**
       * A unique ID for this test
       *
       * @var string
       */
      protected static $id;


      /**
       * Test setup for sandbox environment
       */
      public static function setUpBeforeClass (): void
      {

         // Change the ZohoCRM API to sandbox mode
         ZohoCRMPorter::getInstance()
                      ->setEnvironment( 'sandbox' );

         // Create a unique ID for this test run to use
         self::$id = self::generateHash( 6 );
      }


      /**
       * Tests the creation of a ZohoCRMGatewayData object
       *
       * @return ZohoCRMGatewayData
       * @throws \Exception
       */
      public function testCreateZohoCRMGatewayData (): ZohoCRMGatewayData
      {

         // Create the object
         $gateway = ZohoCRMPorter::getInstance()
                                 ->getSavedGatewayDataEntity( 'default' );

         // Check the type of object returned
         $this->assertInstanceOf( ZohoCRMGatewayData::class,
                                  $gateway );

         // Return the object
         return $gateway;
      }


      /**
       * Tests the creation of a ZohoCRMUpsertContactRequestController object
       *
       * @return ZohoCRMUpsertContactRequestController
       * @throws \Exception
       */
      public function testCreateZohoCRMUpsertContactRequestController (): ZohoCRMUpsertContactRequestController
      {

         // Create the object
         $request = ZohoCRMPorter::getInstance()
                                 ->newZohoCRMUpsertContactRequestController( "testing_" . self::$id . '@test.com',
                                                                             'Test ' . self::$id,
                                                                             [ 'Secondary Email' => 'test@test.com' ] );

         // Check the type of object returned
         $this->assertInstanceOf( ZohoCRMUpsertContactRequestController::class,
                                  $request );

         // Return the object
         return $request;
      }


      /**
       * Tests the sending of a ZohoCRMUpsertContactRequestData through a ZohoCRMUpsertContactRequestController
       *
       * @param ZohoCRMUpsertContactRequestController $request A configured ZohoCRMUpsertContactRequestController entity to use as a gateway
       *
       * @depends testCreateZohoCRMUpsertContactRequestController
       * @return ZohoCRMUpsertContactResponseController
       * @throws \Exception
       */
      public function testSendZohoCRMUpsertContactRequestController ( ZohoCRMUpsertContactRequestController $request )
      {

         // Send the request using the gateway
         $response = $request->sendRequest();

         // Check the type of object returned
         $this->assertInstanceOf( ZohoCRMUpsertContactResponseController::class,
                                  $response );

         // Return the response
         return $response;
      }


      /**
       * Checks a ZohoCRMUpsertContactResponseController for data and errors
       *
       * @param ZohoCRMUpsertContactResponseController $response A ZohoCRMUpsertContactResponseController returned from the gateway
       *
       * @depends  testSendZohoCRMUpsertContactRequestController
       */
      public function testZohoCRMResponseController ( ZohoCRMUpsertContactResponseController $response ): void
      {

         // Test the data
         $this->assertTrue( $response->isSuccessful() );
         $this->assertNotNull( $response->getReferenceID() );

         // Test the raw data
         $this->assertIsArray( $response->getData() );
      }


      /**
       * Tests the resending of a ZohoCRMUpsertContactRequestData through a ZohoCRMUpsertContactRequestController to make sure the same ID was updated
       *
       * @param ZohoCRMUpsertContactRequestController  $request           A configured ZohoCRMUpsertContactRequestController entity to use as a gateway
       * @param ZohoCRMUpsertContactResponseController $original_response The original response fir the first request
       *
       * @depends  testCreateZohoCRMUpsertContactRequestController
       * @depends  testSendZohoCRMUpsertContactRequestController
       * @throws \Exception
       */
      public function testResendZohoCRMUpsertContactRequestController ( ZohoCRMUpsertContactRequestController $request,
                                                                        ZohoCRMUpsertContactResponseController $original_response )
      {

         // Change one field in the original request
         $request->getRequestData()
                 ->setContactField( 'Secondary Email',
                                    'update_test@test.com' );

         // Send the request using the gateway
         $response = $request->sendRequest();

         // Check the type of object returned
         $this->assertInstanceOf( ZohoCRMUpsertContactResponseController::class,
                                  $response );

         // Test the data
         $this->assertTrue( $response->isSuccessful() );
         $this->assertNotNull( $response->getReferenceID() );

         // Test the raw data
         $this->assertIsArray( $response->getData() );

         // Make sure the ID is the same as the original request
         $this->assertEquals( $original_response->getReferenceID(),
                              $response->getReferenceID() );
      }


      /**
       * Generates a unique testing hash
       *
       * @param int $length The length of the hash
       *
       * @return string
       */
      private static function generateHash ( int $length ): string
      {

         // Generate a random string
         $hash = openssl_random_pseudo_bytes( $length );

         // Convert the binary data into hexadecimal representation and return it
         $hash = strtoupper( bin2hex( $hash ) );

         // Trim to length and return
         return substr( $hash,
                        0,
                        $length );
      }

   }