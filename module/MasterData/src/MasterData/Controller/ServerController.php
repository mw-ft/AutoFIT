<?php
namespace MasterData\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DbSystel\DataObject\Server;
use Order\Service\ServerService;
use MasterData\Form\ServerForm;

class ServerController extends AbstractActionController
{

    /**
     *
     * @var Server
     */
    protected $server;

    /**
     * 
     * @var ServerService
     */
    protected $serverService;

    /**
     * 
     * @var ServerForm
     */
    protected $serverForm;

    public function __construct(Server $server, ServerService $serverService)
    {
        $this->server = $server;
        $this->serverService = $serverService;
    }

    /**
     *
     * @param FormInterface $serverForm
     */
    public function setServerForm($serverForm)
    {
        $this->serverForm = $serverForm;
    }

    public function editAction()
    {
        if ($this->IsInSync()) {
            return $this->redirect()->toRoute('sync-in-progress');
        }

        $this->serverForm->bind($this->server);

        $request = $this->getRequest();

        if ($request->isPost()) {
            $this->serverForm->setData($request->getPost());
            if ($this->serverForm->isValid()) {
                $this->serverService->saveOne($this->server);
                return $this->forward()->dispatch('MasterData\Controller\Server',
                    [
                        'action' => 'edited'
                    ]);
            }
        }

        return [
            'form' => $this->serverForm
        ];
    }

    public function editedAction()
    {
        return new ViewModel();
    }

}
