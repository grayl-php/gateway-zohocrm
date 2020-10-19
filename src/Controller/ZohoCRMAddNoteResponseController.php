<?php

   namespace Grayl\Gateway\ZohoCRM\Controller;

   use Grayl\Gateway\Common\Controller\ResponseControllerAbstract;
   use Grayl\Gateway\Common\Entity\ResponseDataAbstract;
   use Grayl\Gateway\Common\Service\ResponseServiceInterface;
   use Grayl\Gateway\ZohoCRM\Entity\ZohoCRMAddNoteResponseData;
   use Grayl\Gateway\ZohoCRM\Service\ZohoCRMAddNoteResponseService;

   /**
    * Class ZohoCRMAddNoteResponseController
    * The controller for working with ZohoCRMAddNoteResponseData entities
    *
    * @package Grayl\Gateway\ZohoCRM
    */
   class ZohoCRMAddNoteResponseController extends ResponseControllerAbstract
   {

      /**
       * The ZohoCRMAddNoteResponseData object that holds the gateway API response
       *
       * @var ZohoCRMAddNoteResponseData
       */
      protected ResponseDataAbstract $response_data;

      /**
       * The ZohoCRMAddNoteResponseService entity to use
       *
       * @var ZohoCRMAddNoteResponseService
       */
      protected ResponseServiceInterface $response_service;

   }