<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'App\Controller\MedicoController' shared autowired service.

include_once $this->targetDirs[3].'/vendor/symfony/framework-bundle/Controller/ControllerTrait.php';
include_once $this->targetDirs[3].'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
include_once $this->targetDirs[3].'/src/Controller/MedicoController.php';
include_once $this->targetDirs[3].'/src/Service/LoginService.php';
include_once $this->targetDirs[3].'/src/Service/MedicoService.php';
include_once $this->targetDirs[3].'/src/Service/EntidadeFactory.php';
include_once $this->targetDirs[3].'/src/Service/UserFactory.php';

$this->services['App\\Controller\\MedicoController'] = $instance = new \App\Controller\MedicoController(new \App\Service\MedicoService(($this->privates['App\\Service\\UserFactory'] ?? ($this->privates['App\\Service\\UserFactory'] = new \App\Service\UserFactory())), ($this->services['doctrine.orm.default_entity_manager'] ?? $this->load('getDoctrine_Orm_DefaultEntityManagerService.php')), ($this->privates['App\\Repository\\UserMedicoRepository'] ?? $this->load('getUserMedicoRepositoryService.php')), ($this->privates['App\\Repository\\UserRepository'] ?? $this->load('getUserRepositoryService.php'))));

$instance->setContainer(($this->privates['.service_locator.CDOTD6.'] ?? $this->load('get_ServiceLocator_CDOTD6_Service.php'))->withContext('App\\Controller\\MedicoController', $this));

return $instance;
