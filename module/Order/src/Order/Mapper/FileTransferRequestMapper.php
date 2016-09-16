<?php
namespace Order\Mapper;

use DbSystel\DataObject\FileTransferRequest;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Hydrator\HydratorInterface;
use Zend\Db\Sql\Select;
use DbSystel\DataObject\LogicalConnection;
use DbSystel\DataObject\PhysicalConnectionCd;
use DbSystel\DataObject\PhysicalConnectionFtgw;
use DbSystel\DataObject\AbstractEndpoint;
use Zend\Db\Sql\Expression;
use DbSystel\DataObject\ServiceInvoicePosition;
use DbSystel\DataObject\ServiceInvoice;
use DbSystel\DataObject\Application;
use DbSystel\DataObject\Environment;
use Zend\Db\Sql\Join;
use DbSystel\DataObject\Notification;
use DbSystel\Paginator\Paginator;
use Order\Paginator\Adapter\FileTransferRequestPaginatorAdapter;

class FileTransferRequestMapper extends AbstractMapper implements FileTransferRequestMapperInterface
{

    /**
     *
     * @var FileTransferRequest
     */
    protected $prototype;

    /**
     *
     * @var LogicalConnection
     */
    protected $logicalConnectionPrototype;

    /**
     *
     * @var Notification
     */
    protected $notificationPrototype;

    /**
     *
     * @var LogicalConnectionMapperInterface
     */
    protected $logicalConnectionMapper;

    /**
     *
     * @var ServiceInvoicePositionMapperInterface
     */
    protected $serviceInvoicePositionMapper;

    /**
     *
     * @var UserMapperInterface
     */
    protected $userMapper;

    public function __construct(AdapterInterface $dbAdapter, HydratorInterface $hydrator, FileTransferRequest $prototype,
        string $prefix = null, string $identifier = null)
    {
        parent::__construct($dbAdapter, $hydrator, $prototype, $prefix, $identifier);
    }

    /**
     *
     * @return the $userPrototype
     */
    public function getUserPrototype()
    {
        return clone $this->userPrototype;
    }

    /**
     *
     * @param User $userPrototype
     */
    public function setUserPrototype($userPrototype)
    {
        $this->userPrototype = $userPrototype;
    }

    /**
     *
     * @return the $logicalConnectionPrototype
     */
    public function getLogicalConnectionPrototype()
    {
        return clone $this->logicalConnectionPrototype;
    }

    /**
     *
     * @param LogicalConnection $logicalConnectionPrototype
     */
    public function setLogicalConnectionPrototype($logicalConnectionPrototype)
    {
        $this->logicalConnectionPrototype = $logicalConnectionPrototype;
    }

    /**
     *
     * @return the $notificationPrototype
     */
    public function getNotificationPrototype()
    {
        return clone $this->notificationPrototype;
    }

    /**
     *
     * @param Notification $notoficationPrototype
     */
    public function setNotificationPrototype($notoficationPrototype)
    {
        $this->notificationPrototype = $notoficationPrototype;
    }

    /**
     *
     * @param LogicalConnectionMapperInterface $logicalConnectionMapper
     */
    public function setLogicalConnectionMapper(LogicalConnectionMapperInterface $logicalConnectionMapper)
    {
        $this->logicalConnectionMapper = $logicalConnectionMapper;
    }

    /**
     *
     * @param ServiceInvoicePositionMapperInterface $serviceInvoicePositionMapper
     */
    public function setServiceInvoicePositionMapper(ServiceInvoicePositionMapperInterface $serviceInvoicePositionMapper)
    {
        $this->serviceInvoicePositionMapper = $serviceInvoicePositionMapper;
    }

    /**
     *
     * @param UserMapperInterface $userMapper
     */
    public function setUserMapper(UserMapperInterface $userMapper)
    {
        $this->userMapper = $userMapper;
    }

    /**
     *
     * @param int|string $id
     *
     * @return FileTransferRequest
     * @throws \InvalidArgumentException
     */
    public function findOne($id)
    {
        $paginator = $this->findAllWithBuldledData([], $id, null, false);
        $fileTransferRequests = $paginator->getCurrentItems();
        if ($fileTransferRequests) {
            return $fileTransferRequests[0];
        }

        throw new \InvalidArgumentException("FileTransferRequest with given ID:{$id} not found.");
    }

    protected function processResultRow(array &$resultData, array $resultRowArray, string $tablePrefix,
        string $resultDataKey, string $arrayKey, string $indexColumn, string $parentColumn = null)
    {
        if (strpos($arrayKey, $tablePrefix) === 0) {
            $keyForHydration = substr($arrayKey, strlen($tablePrefix), strlen($arrayKey) - 1);
            if (! $parentColumn) {
                $indexValue = $resultRowArray[$indexColumn];
                $resultData[$resultDataKey][$indexValue][$keyForHydration] = $resultRowArray[$arrayKey];
            } else {
                $parentValue = $resultRowArray[$parentColumn];
                $indexValue = $resultRowArray[$indexColumn];
                $resultData[$resultDataKey][$parentValue][$indexValue][$keyForHydration] = $resultRowArray[$arrayKey];
            }
        }
    }

    /**
     *
     * @return array|FileTransferRequest[]
     */
    public function findAll(array $criteria = [])
    {
        $sql = new Sql($this->dbAdapter);
        $select = $sql->select('file_transfer_request');

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new HydratingResultSet($this->hydrator, $this->getPrototype());

            $return = $resultSet->initialize($result);

            return $return;
        }

        return [];
    }

    /**
     *
     * @return array|FileTransferRequest[]
     */
    public function findAllWithBuldledData(array $criteria = [], $id = null, $page = null, $paginationNeeded = true)
    {
        $sql = new Sql($this->dbAdapter);
        $select = $sql->select('file_transfer_request');
        $prefix = 'file_transfer_request__';
        $select->columns(
            [
                $prefix . 'id' => 'id',
                $prefix . 'change_number' => 'change_number',
                $prefix . 'status' => 'status',
                $prefix . 'comment' => 'comment',
                $prefix . 'created' => 'created',
                $prefix . 'updated' => 'updated',
                $prefix . 'logical_connection_id' => 'logical_connection_id',
                $prefix . 'service_invoice_position_basic_number' => 'service_invoice_position_basic_number',
                $prefix . 'service_invoice_position_personal_number' => 'service_invoice_position_personal_number'
            ]);
        if ($id) {
            $select->where([
                'file_transfer_request.id = ?' => $id
            ]);
        }

        foreach ($criteria as $condition) {
            if (is_array($condition)) {
                if (array_key_exists('user_id', $condition)) {
                    $select->where(
                        [
                            'user_id = ?' => $condition['user_id']
                        ]);
                }
            }
        }

        $select->join('user', 'file_transfer_request.user_id = user.id',
            [
                'user' . '__' . 'id' => 'id',
                'user' . '__' . 'role' => 'role',
                'user' . '__' . 'username' => 'username'
            ], Join::JOIN_LEFT);
        $select->join('logical_connection', 'logical_connection.id = file_transfer_request.logical_connection_id',
            [
                'logical_connection' . '__' . 'id' => 'id',
                'logical_connection' . '__' . 'type' => 'type'
            ], Select::JOIN_LEFT);
        $select->join('physical_connection', 'physical_connection.logical_connection_id = logical_connection.id',
            [
                'physical_connection' . '__' . 'id' => 'id',
                'physical_connection' . '__' . 'logical_connection_id' => 'logical_connection_id',
                'physical_connection' . '__' . 'role' => 'role',
                'physical_connection' . '__' . 'type' => 'type'
            ], Select::JOIN_LEFT);
        $select->join('physical_connection_cd', 'physical_connection_cd.physical_connection_id = physical_connection.id',
            [
                'physical_connection_cd' . '__' . 'physical_connection_id' => 'physical_connection_id',
                'physical_connection_cd' . '__' . 'secure_plus' => 'secure_plus'
            ], Select::JOIN_LEFT);
        $select->join('physical_connection_ftgw', 'physical_connection_ftgw.physical_connection_id = physical_connection.id',
            [
                'physical_connection_ftgw' . '__' . 'physical_connection_id' => 'physical_connection_id',
            ], Select::JOIN_LEFT);
        $select->join('notification', 'notification.logical_connection_id = logical_connection.id',
            [
                'notification' . '__' . 'id' => 'id',
                'notification' . '__' . 'email' => 'email',
                'notification' . '__' . 'success' => 'success',
                'notification' . '__' . 'failure' => 'failure',
                'notification' . '__' . 'logical_connection_id' => 'logical_connection_id'
            ], Select::JOIN_LEFT);
        $select->join([
            'service_invoice_position_basic' => 'service_invoice_position'
        ], 'service_invoice_position_basic.number = file_transfer_request.service_invoice_position_basic_number',
            [
                'service_invoice_position_basic' . '__' . 'number' => 'number',
                'service_invoice_position_basic' . '__' . 'order_quantity' => 'order_quantity',
                'service_invoice_position_basic' . '__' . 'description' => 'description',
                'service_invoice_position_basic' . '__' . 'status' => 'status',
                'service_invoice_position_basic' . '__' . 'service_invoice_number' => 'service_invoice_number',
                'service_invoice_position_basic' . '__' . 'article_sku' => 'article_sku'
            ], Join::JOIN_LEFT);
        $select->join([
            'service_invoice_position_personal' => 'service_invoice_position'
        ], 'service_invoice_position_personal.number = file_transfer_request.service_invoice_position_personal_number',
            [
                'service_invoice_position_personal' . '__' . 'number' => 'number',
                'service_invoice_position_personal' . '__' . 'order_quantity' => 'order_quantity',
                'service_invoice_position_personal' . '__' . 'description' => 'description',
                'service_invoice_position_personal' . '__' . 'status' => 'status',
                'service_invoice_position_personal' . '__' . 'service_invoice_number' => 'service_invoice_number',
                'service_invoice_position_personal' . '__' . 'article_sku' => 'article_sku'
            ], Join::JOIN_LEFT);

        $select->join('service_invoice',
            'service_invoice.number = service_invoice_position_basic.service_invoice_number OR service_invoice.number = service_invoice_position_personal.service_invoice_number',
            [
                'service_invoice' . '__' . 'number' => 'number',
                'service_invoice' . '__' . 'description' => 'description',
            ], Select::JOIN_LEFT);
        $select->join('application',
            'application.technical_short_name = service_invoice.application_technical_short_name',
            [
                'application' . '__' . 'technical_short_name' => 'technical_short_name',
                'application' . '__' . 'technical_id' => 'technical_id',
                'application' . '__' . 'active' => 'active'
            ], Select::JOIN_LEFT);
        $select->join('environment', 'environment.severity = service_invoice.environment_severity',
            [
                'environment' . '__' . 'severity' => 'severity',
                'environment' . '__' . 'name' => 'name',
                'environment' . '__' . 'short_name' => 'short_name'
            ], Select::JOIN_LEFT);
        $select->join('endpoint', 'endpoint.physical_connection_id = physical_connection.id',
            [
                'endpoint' . '__' . 'id' => 'id',
                'endpoint' . '__' . 'physical_connection_id' => 'physical_connection_id',
                'endpoint' . '__' . 'role' => 'role',
                'endpoint' . '__' . 'type' => 'type',
                'endpoint' . '__' . 'server_place' => 'server_place',
                'endpoint' . '__' . 'contact_person' => 'contact_person'
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_application' => 'application'],
            'endpoint_application.technical_short_name = endpoint.application_technical_short_name',
            [
                'endpoint_application' . '__' . 'technical_short_name' => 'technical_short_name',
                'endpoint_application' . '__' . 'technical_id' => 'technical_id'
            ], Select::JOIN_LEFT);
        $select->join('endpoint_server_config',
            'endpoint_server_config.id = endpoint.endpoint_server_config_id',
            [
                'endpoint_server_config' . '__' . 'id' => 'id',
                'endpoint_server_config' . '__' . 'dns_address' => 'dns_address',
                'endpoint_server_config' . '__' . 'server_name' => 'server_name'
            ], Select::JOIN_LEFT);
        $select->join('server',
            'server.name = endpoint_server_config.server_name',
            [
                'server' . '__' . 'name' => 'name',
                'server' . '__' . 'active' => 'active',
                'server' . '__' . 'node_name' => 'node_name',
                'server' . '__' . 'virtual_node_name' => 'virtual_node_name'
            ], Select::JOIN_LEFT);
        $select->join('external_server',
            'external_server.id = endpoint.external_server_id',
            [
                'external_server' . '__' . 'id' => 'id',
                'external_server' . '__' . 'name' => 'name',
            ], Select::JOIN_LEFT);
        $select->join('customer',
            'customer.id = endpoint.customer_id',
            [
                'customer' . '__' . 'id' => 'id',
                'customer' . '__' . 'name' => 'name'
            ], Select::JOIN_LEFT);
        $select->join('endpoint_cd_as400', 'endpoint_cd_as400.endpoint_id = endpoint.id',
            [
                'endpoint_cd_as400' . '__' . 'endpoint_id' => 'endpoint_id',
                'endpoint_cd_as400' . '__' . 'username' => 'username',
                'endpoint_cd_as400' . '__' . 'folder' => 'folder'
            ], Select::JOIN_LEFT);
        $select->join('endpoint_cd_tandem', 'endpoint_cd_tandem.endpoint_id = endpoint.id',
            [
                'endpoint_cd_tandem' . '__' . 'endpoint_id' => 'endpoint_id',
                'endpoint_cd_tandem' . '__' . 'username' => 'username',
                'endpoint_cd_tandem' . '__' . 'folder' => 'folder'
            ], Select::JOIN_LEFT);
        $select->join('endpoint_cd_linux_unix', 'endpoint_cd_linux_unix.endpoint_id = endpoint.id',
            [
                'endpoint_cd_linux_unix' . '__' . 'endpoint_id' => 'endpoint_id',
                'endpoint_cd_linux_unix' . '__' . 'username' => 'username',
                'endpoint_cd_linux_unix' . '__' . 'folder' => 'folder',
                'endpoint_cd_linux_unix' . '__' . 'transmission_type' => 'transmission_type',
                'endpoint_cd_linux_unix' . '__' . 'transmission_interval' => 'transmission_interval',
                'endpoint_cd_linux_unix' . '__' . 'service_address' => 'service_address'
            ], Select::JOIN_LEFT);
        $select->join(['cd_linux_unix_cluster_config' => 'endpoint_cluster_config'], 'cd_linux_unix_cluster_config.id = endpoint_cd_linux_unix.endpoint_cluster_config_id',
            [
                'cd_linux_unix_cluster_config' . '__' . 'id' => 'id',
                'cd_linux_unix_cluster_config' . '__' . 'dns_address' => 'dns_address',
                'cd_linux_unix_cluster_config' . '__' . 'cluster_id' => 'cluster_id',
            ], Select::JOIN_LEFT);
        $select->join(['cd_linux_unix_cluster' => 'cluster'], 'cd_linux_unix_cluster.id = cd_linux_unix_cluster_config.cluster_id',
            [
                'cd_linux_unix_cluster' . '__' . 'id' => 'id',
                'cd_linux_unix_cluster' . '__' . 'virtual_node_name' => 'virtual_node_name',
            ], Select::JOIN_LEFT);
        $select->join(['cd_linux_unix_server' => 'server'],
            'cd_linux_unix_server.cluster_id = cd_linux_unix_cluster.id',
            [
                'cd_linux_unix_server' . '__' . 'name' => 'name',
                'cd_linux_unix_server' . '__' . 'node_name' => 'node_name',
                'cd_linux_unix_server' . '__' . 'virtual_node_name' => 'virtual_node_name',
                'cd_linux_unix_server' . '__' . 'cluster_id' => 'cluster_id',
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_cd_linux_unix_include_parameter_set' => 'include_parameter_set'], 'endpoint_cd_linux_unix_include_parameter_set.id = endpoint_cd_linux_unix.include_parameter_set_id',
            [
                'endpoint_cd_linux_unix_include_parameter_set' . '__' . 'id' => 'id'
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_cd_linux_unix_include_parameter' => 'include_parameter'], 'endpoint_cd_linux_unix_include_parameter.include_parameter_set_id = endpoint_cd_linux_unix_include_parameter_set.id',
            [
                'endpoint_cd_linux_unix_include_parameter' . '__' . 'id' => 'id',
                'endpoint_cd_linux_unix_include_parameter' . '__' . 'expression' => 'expression',
                'endpoint_cd_linux_unix_include_parameter' . '__' . 'include_parameter_set_id' => 'include_parameter_set_id'
            ], Select::JOIN_LEFT);
        $select->join('endpoint_cd_windows', 'endpoint_cd_windows.endpoint_id = endpoint.id',
            [
                'endpoint_cd_windows' . '__' . 'endpoint_id' => 'endpoint_id',
                'endpoint_cd_windows' . '__' . 'folder' => 'folder',
                'endpoint_cd_windows' . '__' . 'transmission_type' => 'transmission_type',
                'endpoint_cd_windows' . '__' . 'include_parameter_set_id' => 'include_parameter_set_id'
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_cd_windows_include_parameter_set' => 'include_parameter_set'], 'endpoint_cd_windows_include_parameter_set.id = endpoint_cd_windows.include_parameter_set_id',
            [
                'endpoint_cd_windows_include_parameter_set' . '__' . 'id' => 'id'
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_cd_windows_include_parameter' => 'include_parameter'], 'endpoint_cd_windows_include_parameter.include_parameter_set_id = endpoint_cd_windows_include_parameter_set.id',
            [
                'endpoint_cd_windows_include_parameter' . '__' . 'id' => 'id',
                'endpoint_cd_windows_include_parameter' . '__' . 'expression' => 'expression',
                'endpoint_cd_windows_include_parameter' . '__' . 'include_parameter_set_id' => 'include_parameter_set_id'
            ], Select::JOIN_LEFT);
        $select->join('endpoint_cd_zos', 'endpoint_cd_zos.endpoint_id = endpoint.id',
            [
                'endpoint_cd_zos' . '__' . 'endpoint_id' => 'endpoint_id',
                'endpoint_cd_zos' . '__' . 'username' => 'username',
                'endpoint_cd_zos' . '__' . 'file_parameter_set_id' => 'file_parameter_set_id',
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_cd_zos_file_parameter_set' => 'file_parameter_set'], 'endpoint_cd_zos_file_parameter_set.id = endpoint_cd_zos.file_parameter_set_id',
            [
                'endpoint_cd_zos_file_parameter_set' . '__' . 'id' => 'id'
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_cd_zos_file_parameter' => 'file_parameter'], 'endpoint_cd_zos_file_parameter.file_parameter_set_id = endpoint_cd_zos_file_parameter_set.id',
            [
                'endpoint_cd_zos_file_parameter' . '__' . 'id' => 'id',
                'endpoint_cd_zos_file_parameter' . '__' . 'filename' => 'filename',
                'endpoint_cd_zos_file_parameter' . '__' . 'record_length' => 'record_length',
                'endpoint_cd_zos_file_parameter' . '__' . 'blocking' => 'blocking',
                'endpoint_cd_zos_file_parameter' . '__' . 'block_size' => 'block_size',
                'endpoint_cd_zos_file_parameter' . '__' . 'file_parameter_set_id' => 'file_parameter_set_id'
            ], Select::JOIN_LEFT);
        $select->join('endpoint_cd_windows_share', 'endpoint_cd_windows_share.endpoint_id = endpoint.id',
            [
                'endpoint_cd_windows_share' . '__' . 'endpoint_id' => 'endpoint_id',
                'endpoint_cd_windows_share' . '__' . 'sharename' => 'sharename',
                'endpoint_cd_windows_share' . '__' . 'folder' => 'folder',
                'endpoint_cd_windows_share' . '__' . 'transmission_type' => 'transmission_type',
                'endpoint_cd_windows_share' . '__' . 'include_parameter_set_id' => 'include_parameter_set_id',
                'endpoint_cd_windows_share' . '__' . 'access_config_set_id' => 'access_config_set_id'
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_cd_windows_share_include_parameter_set' => 'include_parameter_set'], 'endpoint_cd_windows_share_include_parameter_set.id = endpoint_cd_windows_share.include_parameter_set_id',
            [
                'endpoint_cd_windows_share_include_parameter_set' . '__' . 'id' => 'id'
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_cd_windows_share_include_parameter' => 'include_parameter'], 'endpoint_cd_windows_share_include_parameter.include_parameter_set_id = endpoint_cd_windows_share_include_parameter_set.id',
            [
                'endpoint_cd_windows_share_include_parameter' . '__' . 'id' => 'id',
                'endpoint_cd_windows_share_include_parameter' . '__' . 'expression' => 'expression',
                'endpoint_cd_windows_share_include_parameter' . '__' . 'include_parameter_set_id' => 'include_parameter_set_id'
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_cd_windows_share_access_config_set' => 'access_config_set'], 'endpoint_cd_windows_share_access_config_set.id = endpoint_cd_windows_share.access_config_set_id',
            [
                'endpoint_cd_windows_share_access_config_set' . '__' . 'id' => 'id'
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_cd_windows_share_access_config' => 'access_config'], 'endpoint_cd_windows_share_access_config.access_config_set_id = endpoint_cd_windows_share_access_config_set.id',
            [
                'endpoint_cd_windows_share_access_config' . '__' . 'id' => 'id',
                'endpoint_cd_windows_share_access_config' . '__' . 'username' => 'username',
                'endpoint_cd_windows_share_access_config' . '__' . 'permission_read' => 'permission_read',
                'endpoint_cd_windows_share_access_config' . '__' . 'permission_write' => 'permission_write',
                'endpoint_cd_windows_share_access_config' . '__' . 'permission_delete' => 'permission_delete',
                'endpoint_cd_windows_share_access_config' . '__' . 'access_config_set_id' => 'access_config_set_id'
            ], Select::JOIN_LEFT);
        $select->join('endpoint_ftgw_windows', 'endpoint_ftgw_windows.endpoint_id = endpoint.id',
            [
                'endpoint_ftgw_windows' . '__' . 'endpoint_id' => 'endpoint_id',
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_ftgw_windows_include_parameter_set' => 'include_parameter_set'], 'endpoint_ftgw_windows_include_parameter_set.id = endpoint_ftgw_windows.include_parameter_set_id',
            [
                'endpoint_ftgw_windows_include_parameter_set' . '__' . 'id' => 'id'
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_ftgw_windows_include_parameter' => 'include_parameter'], 'endpoint_ftgw_windows_include_parameter.include_parameter_set_id = endpoint_ftgw_windows_include_parameter_set.id',
            [
                'endpoint_ftgw_windows_include_parameter' . '__' . 'id' => 'id',
                'endpoint_ftgw_windows_include_parameter' . '__' . 'expression' => 'expression',
                'endpoint_ftgw_windows_include_parameter' . '__' . 'include_parameter_set_id' => 'include_parameter_set_id'
            ], Select::JOIN_LEFT);
        $select->join('endpoint_ftgw_self_service', 'endpoint_ftgw_self_service.endpoint_id = endpoint.id',
            [
                'endpoint_ftgw_self_service' . '__' . 'endpoint_id' => 'endpoint_id',
                'endpoint_ftgw_self_service' . '__' . 'ftgw_username' => 'ftgw_username',
                'endpoint_ftgw_self_service' . '__' . 'mailbox' => 'mailbox',
                'endpoint_ftgw_self_service' . '__' . 'connection_type' => 'connection_type',
                'endpoint_ftgw_self_service' . '__' . 'protocol_set_id' => 'protocol_set_id'
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_ftgw_self_service_protocol_set' => 'protocol_set'], 'endpoint_ftgw_self_service_protocol_set.id = endpoint_ftgw_self_service.protocol_set_id',
            [
                'endpoint_ftgw_self_service_protocol_set' . '__' . 'id' => 'id'
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_ftgw_self_service_protocol' => 'protocol'], 'endpoint_ftgw_self_service_protocol.protocol_set_id = endpoint_ftgw_self_service_protocol_set.id',
            [
                'endpoint_ftgw_self_service_protocol' . '__' . 'id' => 'id',
                'endpoint_ftgw_self_service_protocol' . '__' . 'name' => 'name',
                'endpoint_ftgw_self_service_protocol' . '__' . 'protocol_set_id' => 'protocol_set_id'
            ], Select::JOIN_LEFT);
        $select->join('endpoint_ftgw_protocol_server', 'endpoint_ftgw_protocol_server.endpoint_id = endpoint.id',
            [
                'endpoint_ftgw_protocol_server' . '__' . 'endpoint_id' => 'endpoint_id',
                'endpoint_ftgw_protocol_server' . '__' . 'username' => 'username',
                'endpoint_ftgw_protocol_server' . '__' . 'folder' => 'folder',
                'endpoint_ftgw_protocol_server' . '__' . 'dns_address' => 'dns_address',
                'endpoint_ftgw_protocol_server' . '__' . 'ip' => 'ip',
                'endpoint_ftgw_protocol_server' . '__' . 'port' => 'port',
                'endpoint_ftgw_protocol_server' . '__' . 'transmission_type' => 'transmission_type',
                'endpoint_ftgw_protocol_server' . '__' . 'include_parameter_set_id' => 'include_parameter_set_id',
                'endpoint_ftgw_protocol_server' . '__' . 'protocol_set_id' => 'protocol_set_id',
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_ftgw_protocol_server_include_parameter_set' => 'include_parameter_set'], 'endpoint_ftgw_protocol_server_include_parameter_set.id = endpoint_ftgw_protocol_server.include_parameter_set_id',
            [
                'endpoint_ftgw_protocol_server_include_parameter_set' . '__' . 'id' => 'id'
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_ftgw_protocol_server_include_parameter' => 'include_parameter'], 'endpoint_ftgw_protocol_server_include_parameter.include_parameter_set_id = endpoint_ftgw_protocol_server_include_parameter_set.id',
            [
                'endpoint_ftgw_protocol_server_include_parameter' . '__' . 'id' => 'id',
                'endpoint_ftgw_protocol_server_include_parameter' . '__' . 'expression' => 'expression',
                'endpoint_ftgw_protocol_server_include_parameter' . '__' . 'include_parameter_set_id' => 'include_parameter_set_id'
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_ftgw_protocol_server_protocol_set' => 'protocol_set'], 'endpoint_ftgw_protocol_server_protocol_set.id = endpoint_ftgw_protocol_server.protocol_set_id',
            [
                'endpoint_ftgw_protocol_server_protocol_set' . '__' . 'id' => 'id'
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_ftgw_protocol_server_protocol' => 'protocol'], 'endpoint_ftgw_protocol_server_protocol.protocol_set_id = endpoint_ftgw_protocol_server_protocol_set.id',
            [
                'endpoint_ftgw_protocol_server_protocol' . '__' . 'id' => 'id',
                'endpoint_ftgw_protocol_server_protocol' . '__' . 'name' => 'name',
                'endpoint_ftgw_protocol_server_protocol' . '__' . 'protocol_set_id' => 'protocol_set_id'
            ], Select::JOIN_LEFT);
        $select->order(['file_transfer_request__' . 'id' => 'ASC']);
        $select->join('endpoint_ftgw_windows_share', 'endpoint_ftgw_windows_share.endpoint_id = endpoint.id',
            [
                'endpoint_ftgw_windows_share' . '__' . 'endpoint_id' => 'endpoint_id',
                'endpoint_ftgw_windows_share' . '__' . 'sharename' => 'sharename',
                'endpoint_ftgw_windows_share' . '__' . 'folder' => 'folder',
                'endpoint_ftgw_windows_share' . '__' . 'include_parameter_set_id' => 'include_parameter_set_id',
                'endpoint_ftgw_windows_share' . '__' . 'access_config_set_id' => 'access_config_set_id'
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_ftgw_windows_share_include_parameter_set' => 'include_parameter_set'], 'endpoint_ftgw_windows_share_include_parameter_set.id = endpoint_ftgw_windows_share.include_parameter_set_id',
            [
                'endpoint_ftgw_windows_share_include_parameter_set' . '__' . 'id' => 'id'
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_ftgw_windows_share_include_parameter' => 'include_parameter'], 'endpoint_ftgw_windows_share_include_parameter.include_parameter_set_id = endpoint_ftgw_windows_share_include_parameter_set.id',
            [
                'endpoint_ftgw_windows_share_include_parameter' . '__' . 'id' => 'id',
                'endpoint_ftgw_windows_share_include_parameter' . '__' . 'expression' => 'expression',
                'endpoint_ftgw_windows_share_include_parameter' . '__' . 'include_parameter_set_id' => 'include_parameter_set_id'
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_ftgw_windows_share_access_config_set' => 'access_config_set'], 'endpoint_ftgw_windows_share_access_config_set.id = endpoint_ftgw_windows_share.access_config_set_id',
            [
                'endpoint_ftgw_windows_share_access_config_set' . '__' . 'id' => 'id'
            ], Select::JOIN_LEFT);
        $select->join(['endpoint_ftgw_windows_share_access_config' => 'access_config'], 'endpoint_ftgw_windows_share_access_config.access_config_set_id = endpoint_ftgw_windows_share_access_config_set.id',
            [
                'endpoint_ftgw_windows_share_access_config' . '__' . 'id' => 'id',
                'endpoint_ftgw_windows_share_access_config' . '__' . 'username' => 'username',
                'endpoint_ftgw_windows_share_access_config' . '__' . 'permission_read' => 'permission_read',
                'endpoint_ftgw_windows_share_access_config' . '__' . 'permission_write' => 'permission_write',
                'endpoint_ftgw_windows_share_access_config' . '__' . 'permission_delete' => 'permission_delete',
                'endpoint_ftgw_windows_share_access_config' . '__' . 'access_config_set_id' => 'access_config_set_id'
            ], Select::JOIN_LEFT);

        $adapter = new FileTransferRequestPaginatorAdapter($select, $this->dbAdapter);
        $paginator = new Paginator($adapter);
        $paginator->setCurrentPageNumber($page);
        if (! $paginationNeeded) {
            $paginator->setItemCountPerPage(null);
        }

//         echo $select->getSqlString($this->dbAdapter->getPlatform());
//         die('');

        $resultSetArray = $paginator->getCurrentItems();

        if ($resultSetArray) {
            $resultSetArray = iterator_to_array($resultSetArray);
            foreach ($resultSetArray as $key => $arrayObject) {
                $resultSetArray[$key] = $arrayObject->getArrayCopy();
            }
            
//             echo '<pre>';
//             print_r($resultSetArray);
//             die(__FILE__);

            $dataObjects = $this->createDataObjects($resultSetArray, null, null, 'id', 'file_transfer_request__', null,
                null, null, null, false);

//             echo '<pre>';
//             print_r($dataObjects);
//             die('###');

            $paginator->setCurrentItems($dataObjects);

            return $paginator;
        }

        return [];
    }

    /**
     *
     * @param FileTransferRequest $dataObject
     *
     * @return FileTransferRequest
     * @throws \Exception
     */
    public function save(FileTransferRequest $dataObject)
    {
        $data = [];
        // data retrieved directly from the input
        $data['id'] = $dataObject->getId();
        $data['change_number'] = $dataObject->getChangeNumber();
        $data['service_invoice_position_basic_number'] = $dataObject->getServiceInvoicePositionBasic()->getNumber();
        $data['service_invoice_position_personal_number'] = $dataObject->getServiceInvoicePositionPersonal()->getNumber();
        if ($dataObject->getStatus()) {
            $data['status'] = $dataObject->getStatus();
        }
        $data['comment'] = $dataObject->getComment();
        // creating sub-objects
        // $newFoo = $this->fooMapper->save($dataObject->getFoo());
        $newLogicalConnection = $this->logicalConnectionMapper->save($dataObject->getLogicalConnection());
        $dataObject->setLogicalConnection($newLogicalConnection);
        $newUser = $this->userMapper->save($dataObject->getUser());
        $dataObject->setUser($newUser);
        // data from the recently persisted objects
        $data['logical_connection_id'] = $newLogicalConnection->getId();
        $data['user_id'] = $newUser->getId();

        if (! $data['id']) {
            $action = new Insert('file_transfer_request');
            unset($data['id']);
            $action->values($data);
        } else {
            $action = new Update('file_transfer_request');
            $action->where(['id' => $data['id']]);
            unset($data['id']);
            $action->set($data);
        }

        $sql = new Sql($this->dbAdapter);
        $statement = $sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();

        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue() ?: $dataObject->getId();
            if ($newId) {
                $dataObject->setId($newId);
            }
            return $dataObject;
        }
        throw new \Exception('Database error in ' . __METHOD__);
    }

    public function createDataObjects(array $resultSetArray, $parentIdentifier = null, $parentPrefix = null,
        $identifier = null, $prefix = null, $childIdentifier = null, $childPrefix = null, $prototype = null,
        callable $dataObjectCondition = null, bool $isCollection = false)
    {
        $dataObjects = parent::createDataObjects($resultSetArray, null, null, $identifier, $prefix, $childIdentifier, $childPrefix, $prototype, $dataObjectCondition, $isCollection);

        $logicalConnectionDataObjects = $this->logicalConnectionMapper->createDataObjects($resultSetArray, null, null,
            'id', 'logical_connection__', $identifier, $prefix);
        $serviceInvoicePositionBasicDataObjects = $this->serviceInvoicePositionMapper->createDataObjects(
            $resultSetArray, null, null, 'number', 'service_invoice_position_basic__', $identifier, $prefix);
        $serviceInvoicePositionPersonalDataObjects = $this->serviceInvoicePositionMapper->createDataObjects(
            $resultSetArray, null, null, 'number', 'service_invoice_position_personal__', $identifier, $prefix);
        $userDataObjects = $this->userMapper->createDataObjects($resultSetArray, null, null, 'id', 'user__', $identifier,
            $prefix);

        foreach ($dataObjects as $key => $dataObject) {
            $this->appendSubDataObject($dataObject, $dataObject->getId(), $logicalConnectionDataObjects,
                'setLogicalConnection', 'getId');
            $this->appendSubDataObject($dataObject, $dataObject->getId(), $serviceInvoicePositionBasicDataObjects,
                'setServiceInvoicePositionBasic', 'getId');
            $this->appendSubDataObject($dataObject, $dataObject->getId(), $serviceInvoicePositionPersonalDataObjects,
                'setServiceInvoicePositionPersonal', 'getId');
            $this->appendSubDataObject($dataObject, $dataObject->getId(), $userDataObjects, 'setUser', 'getId');
        }

        return $dataObjects;
    }

}
