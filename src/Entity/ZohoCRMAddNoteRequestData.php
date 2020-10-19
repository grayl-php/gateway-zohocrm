<?php

   namespace Grayl\Gateway\ZohoCRM\Entity;

   use Grayl\Gateway\Common\Entity\RequestDataAbstract;

   /**
    * Class ZohoCRMAddNoteRequestData
    * The entity for a contact create/modify request to ZohoCRM
    *
    * @package Grayl\Gateway\ZohoCRM
    */
   class ZohoCRMAddNoteRequestData extends RequestDataAbstract
   {

      /**
       * The module of the note (i.e. "Contacts" or "Leads")
       *
       * @var string
       */
      private string $module_name;

      /**
       * The ID of the parent record the note will be attached to
       *
       * @var string
       */
      private string $parent_id;

      /**
       * The title of the note
       *
       * @var string
       */
      private string $title;

      /**
       * The content of the note
       *
       * @var string
       */
      private string $content;


      /**
       * Class constructor
       *
       * @param string $action      The action performed in this response (send, etc.)
       * @param string $module_name The module of the note (i.e. "Contacts" or "Leads")
       * @param string $parent_id   The ID of the parent record the note will be attached to
       * @param string $title       The title of the note
       * @param string $content     The content of the note
       */
      public function __construct ( string $action,
                                    string $module_name,
                                    string $parent_id,
                                    string $title,
                                    string $content )
      {

         // Call the parent constructor
         parent::__construct( $action );

         // Set the entity data
         $this->setModuleName( $module_name );
         $this->setParentID( $parent_id );
         $this->setTitle( $title );
         $this->setContent( $content );
      }


      /**
       * Gets the module name
       *
       * @return string
       */
      public function getModuleName (): string
      {

         // Return the module name
         return $this->module_name;
      }


      /**
       * Sets the module name
       *
       * @param string $module_name The module of the note (i.e. "Contacts" or "Leads")
       */
      public function setModuleName ( string $module_name ): void
      {

         // Set the module name
         $this->module_name = $module_name;
      }


      /**
       * Gets the parent record ID
       *
       * @return string
       */
      public function getParentId (): string
      {

         // Return the parent record ID
         return $this->parent_id;
      }


      /**
       * Sets the parent record ID
       *
       * @param string $parent_id The ID of the parent record the note will be attached to
       */
      public function setParentId ( string $parent_id ): void
      {

         // Set the parent record ID
         $this->parent_id = $parent_id;
      }


      /**
       * Get the note title
       *
       * @return string
       */
      public function getTitle (): string
      {

         // Return the note title
         return $this->title;
      }


      /**
       * Sets the note title
       *
       * @param string $title The title of the note
       */
      public function setTitle ( string $title ): void
      {

         // Set the note title
         $this->title = $title;
      }


      /**
       * Gets the note content
       *
       * @return string
       */
      public function getContent (): string
      {

         // Return the note content
         return $this->content;
      }


      /**
       * Sets the note content
       *
       * @param string $content The content of the note
       */
      public function setContent ( string $content ): void
      {

         // Set the note content
         $this->content = $content;
      }

   }