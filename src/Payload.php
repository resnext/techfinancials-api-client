<?php

namespace TechFinancials;

/**
 * Stores incoming or outgoing message data for an TechFinancials API call.
 */
class Payload implements \ArrayAccess, \JsonSerializable
{
    /**
     * @var array The response data.
     */
    protected $data;

    /**
     * @var null
     */
    protected $rawData = null;

    /**
     * Creates a new payload object from string.
     *
     * @param array $json The payload data.
     */
    public function __construct($json)
    {
        $this->rawData = $json;
        $data = json_decode((string)$json, true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
            throw new \UnexpectedValueException('Invalid JSON message.');
        }

        $this->data = $data;
    }

    /**
     * Gets the payload data.
     *
     * @return array The payload data.
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Serializes the payload to a JSON message.
     *
     * @return string A JSON message.
     */
    public function toJson()
    {
        return json_encode($this->data, true);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->data[] = $value;
            return;
        }
        $this->data[$offset] = $value;
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    /**
     * @param mixed $offset
     * @return null
     */
    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }

    /**
     * Returns raw data loaded for this payload.
     *
     * @return string
     */
    public function getRawData()
    {
        return $this->rawData;
    }
}
