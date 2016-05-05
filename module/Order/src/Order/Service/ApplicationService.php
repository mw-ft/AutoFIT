<?php
namespace Order\Service;

use Order\Mapper\ApplicationMapperInterface;
use DbSystel\DataObject\Application;

class ApplicationService extends AbstractService implements ApplicationServiceInterface
{

    /**
     *
     * @var ApplicationMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param ApplicationMapperInterface $mapper
     */
    public function __construct(ApplicationMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     */
    public function saveOne(Application $application)
    {
        return $this->mapper->save($application);
    }

    /**
     *
     * {@inheritDoc}
     *
     */
    public function findAllByTechnicalShortName(string $technicalShortName)
    {
        return $this->mapper->findAll(
            [
                [
                    'technical_short_name' => $technicalShortName
                ]
            ]);
    }

}
