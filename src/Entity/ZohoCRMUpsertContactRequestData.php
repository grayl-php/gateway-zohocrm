<?php

namespace Grayl\Gateway\ZohoCRM\Entity;

use Grayl\Gateway\Common\Entity\RequestDataAbstract;
use Grayl\Mixin\Common\Entity\KeyedDataBag;

/**
 * Class ZohoCRMUpsertContactRequestData
 * The entity for a contact create/modify request to ZohoCRM
 *
 * @package Grayl\Gateway\ZohoCRM
 */
class ZohoCRMUpsertContactRequestData extends
    RequestDataAbstract
{

    /**
     * The email address of the contact
     *
     * @var string
     */
    private string $email_address;

    /**
     * The name of the contact
     *
     * @var string
     */
    private string $name;

    /**
     * A set of field values to set for this contact
     *
     * @var KeyedDataBag
     */
    private KeyedDataBag $contact_fields;


    /**
     * Class constructor
     *
     * @param string $action         The action performed in this response (send, etc.)
     * @param string $email_address  The email address of the contact
     * @param string $name           The name of the contact
     * @param array  $contact_fields The associative array of custom field values to set for this contact
     */
    public function __construct(
        string $action,
        string $email_address,
        string $name,
        array $contact_fields
    ) {

        // Call the parent constructor
        parent::__construct($action);

        // Create the bags
        $this->contact_fields = new KeyedDataBag();

        // Set the entity data
        $this->setEmailAddress($email_address);
        $this->setName($name);
        $this->setContactFields($contact_fields);
    }


    /**
     * Gets the email address of the contact
     *
     * @return string
     */
    public function getEmailAddress(): string
    {

        // Return the email
        return $this->email_address;
    }


    /**
     * Sets the email address of the contact
     *
     * @param string $email_address Full email address of the contact
     */
    public function setEmailAddress(string $email_address): void
    {

        // Set the email
        $this->email_address = $email_address;
    }


    /**
     * Gets the contact's name
     *
     * @return string
     */
    public function getName(): string
    {

        // Return the name
        return $this->name;
    }


    /**
     * Sets the contact's name
     *
     * @param string $name The name of the contact
     */
    public function setName(string $name): void
    {

        // Set the name
        $this->name = $name;
    }


    /**
     * Sets a single contact field
     *
     * @param string $key   The key name for the contact field
     * @param mixed  $value The value of the contact field
     */
    public function setContactField(
        string $key,
        ?string $value
    ): void {

        // Set the contact field
        $this->contact_fields->setVariable(
            $key,
            $value
        );
    }


    /**
     * Retrieves the value of a stored contact field
     *
     * @param string $key The key name for the contact field
     *
     * @return mixed
     */
    public function getContactField(string $key)
    {

        // Return the value
        return $this->contact_fields->getVariable($key);
    }


    /**
     * Sets multiple contact fields using a passed array
     *
     * @param array $contact_fields The associative array of contact fields to set ( key => value )
     */
    public function setContactFields(array $contact_fields): void
    {

        // Set the contact fields
        $this->contact_fields->setVariables($contact_fields);
    }


    /**
     * Retrieves the entire array of contact fields
     *
     * @return array
     */
    public function getContactFields(): array
    {

        // Return all contact fields
        return $this->contact_fields->getVariables();
    }

}