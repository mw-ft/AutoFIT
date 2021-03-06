<?php
namespace DbSystel\DataObject;

class FileParameterSet extends AbstractDataObject
{

    /**
     *
     * @var int
     */
    protected $id;

    /**
     *
     * @var AbstractEndpoint
     */
    protected $endpoint;

    /**
     *
     * @var FileParameter[]
     */
    protected $fileParameters;

    /**
     *
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @return the $endpoint
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     *
     * @param AbstractEndpoint $endpoint
     */
    public function setEndpoint(AbstractEndpoint $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     *
     * @return the $fileParameters
     */
    public function getFileParameters()
    {
        return $this->fileParameters;
    }

    /**
     *
     * @param multitype:FileParameter $fileParameters
     */
    public function setFileParameters(array $fileParameters)
    {
        $this->fileParameters = $fileParameters;
    }

}
