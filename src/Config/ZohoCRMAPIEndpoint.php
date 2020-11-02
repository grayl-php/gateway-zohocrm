<?php

   namespace Grayl\Gateway\ZohoCRM\Config;

   use Grayl\Gateway\Common\Config\GatewayAPIEndpointAbstract;

   /**
    * Class ZohoCRMAPIEndpoint
    * The class of a single ZohoCRM API endpoint
    *
    * @package Grayl\Gateway\ZohoCRM
    */
   class ZohoCRMAPIEndpoint extends GatewayAPIEndpointAbstract
   {

      /**
       * The client ID
       *
       * @var string
       */
      protected string $client_id;

      /**
       * The client secret
       *
       * @var string
       */
      protected string $client_secret;

      /**
       * The redirect URI
       *
       * @var string
       */
      protected string $redirect_uri;

      /**
       * The user email
       *
       * @var string
       */
      protected string $user_email;

      /**
       * The token persistence path
       *
       * @var string
       */
      protected string $token_persistence_path;

      /**
       * The refresh token
       *
       * @var string
       */
      protected string $refresh_token;

      /**
       * The identifier
       *
       * @var string
       */
      protected string $identifier;


      /**
       * ZohoCRMAPIEndpoint constructor.
       *
       * @param string $api_endpoint_id        The ID of this API endpoint (default, provision, etc.)
       * @param string $client_id              The client ID to set
       * @param string $client_secret          The client secret to set
       * @param string $redirect_uri           The redirect URI to set
       * @param string $user_email             The user email to set
       * @param string $token_persistence_path The token persistence path to set
       * @param string $refresh_token          The refresh token to set
       * @param string $identifier             The identifier to set
       */
      public function __construct ( string $api_endpoint_id,
                                    string $client_id,
                                    string $client_secret,
                                    string $redirect_uri,
                                    string $user_email,
                                    string $token_persistence_path,
                                    string $refresh_token,
                                    string $identifier )
      {

         // Call the parent constructor
         parent::__construct( $api_endpoint_id );

         // Set the class data
         $this->setClientId( $client_id );
         $this->setClientSecret( $client_secret );
         $this->setRedirectURI( $redirect_uri );
         $this->setUserEmail( $user_email );
         $this->setTokenPersistencePath( $token_persistence_path );
         $this->setRefreshToken( $refresh_token );
         $this->setIdentifier( $identifier );
      }


      /**
       * Gets the client ID
       *
       * @return string
       */
      public function getClientId (): string
      {

         // Return it
         return $this->client_id;
      }


      /**
       * Sets the client ID
       *
       * @param string $client_id The client ID to set
       */
      public function setClientId ( string $client_id ): void
      {

         // Set the client ID
         $this->client_id = $client_id;
      }


      /**
       * Gets the client secret
       *
       * @return string
       */
      public function getClientSecret (): string
      {

         // Return it
         return $this->client_secret;
      }


      /**
       * Sets the client secret
       *
       * @param string $client_secret The client secret to set
       */
      public function setClientSecret ( string $client_secret ): void
      {

         // Set the client secret
         $this->client_secret = $client_secret;
      }


      /**
       * Gets the redirect URI
       *
       * @return string
       */
      public function getRedirectURI (): string
      {

         // Return it
         return $this->redirect_uri;
      }


      /**
       * Sets the redirect URI
       *
       * @param string $redirect_uri The redirect URI to set
       */
      public function setRedirectURI ( string $redirect_uri ): void
      {

         // Set the redirect URI
         $this->redirect_uri = $redirect_uri;
      }


      /**
       * Gets the user email
       *
       * @return string
       */
      public function getUserEmail (): string
      {

         // Return it
         return $this->user_email;
      }


      /**
       * Sets the user email
       *
       * @param string $user_email The user email to set
       */
      public function setUserEmail ( string $user_email ): void
      {

         // Set the user email
         $this->user_email = $user_email;
      }


      /**
       * Gets the token persistence path
       *
       * @return string
       */
      public function getTokenPersistencePath (): string
      {

         // Return it
         return $this->token_persistence_path;
      }


      /**
       * Sets the token persistence path
       *
       * @param string $token_persistence_path The token persistence path to set
       */
      public function setTokenPersistencePath ( string $token_persistence_path ): void
      {

         // Set the token persistence path
         $this->token_persistence_path = $token_persistence_path;
      }


      /**
       * gets the refresh token
       *
       * @return string
       */
      public function getRefreshToken (): string
      {

         // Return it
         return $this->refresh_token;
      }


      /**
       * Sets the refresh token
       *
       * @param string $refresh_token The refresh token to set
       */
      public function setRefreshToken ( string $refresh_token ): void
      {

         // Set the refresh token
         $this->refresh_token = $refresh_token;
      }


      /**
       * Gets the identifier
       *
       * @return string
       */
      public function getIdentifier (): string
      {

         // Return it
         return $this->identifier;
      }


      /**
       * Sets the identifier
       *
       * @param string $identifier The identifier to set
       */
      public function setIdentifier ( string $identifier ): void
      {

         // Set the identifier
         $this->identifier = $identifier;
      }

   }