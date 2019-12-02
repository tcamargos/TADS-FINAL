<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/empresas/create' => [[['_route' => 'app_empresa_novaempresa', '_controller' => 'App\\Controller\\EmpresaController::novaEmpresa'], null, ['POST' => 0], null, false, false, null]],
        '/empresas/login' => [[['_route' => 'app_empresa_login', '_controller' => 'App\\Controller\\EmpresaController::login'], null, ['POST' => 0], null, false, false, null]],
        '/empresas/update' => [[['_route' => 'app_empresa_atualizar', '_controller' => 'App\\Controller\\EmpresaController::atualizar'], null, ['PUT' => 0], null, false, false, null]],
        '/empresas/atestados' => [[['_route' => 'app_empresa_pesquisaatestados', '_controller' => 'App\\Controller\\EmpresaController::pesquisaAtestados'], null, ['GET' => 0], null, false, false, null]],
        '/medicos/create' => [[['_route' => 'app_medico_novomedico', '_controller' => 'App\\Controller\\MedicoController::novoMedico'], null, ['POST' => 0], null, false, false, null]],
        '/medicos/login' => [[['_route' => 'app_medico_login', '_controller' => 'App\\Controller\\MedicoController::login'], null, ['POST' => 0], null, false, false, null]],
        '/medicos/update' => [[['_route' => 'app_medico_atualizar', '_controller' => 'App\\Controller\\MedicoController::atualizar'], null, ['PUT' => 0], null, false, false, null]],
        '/medicos/atestados' => [
            [['_route' => 'app_medico_criaatestado', '_controller' => 'App\\Controller\\MedicoController::criaAtestado'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'app_medico_validaatestado', '_controller' => 'App\\Controller\\MedicoController::validaAtestado'], null, ['GET' => 0], null, false, false, null],
        ],
        '/pacientes/create' => [[['_route' => 'app_paciente_novopaciente', '_controller' => 'App\\Controller\\PacienteController::novoPaciente'], null, ['POST' => 0], null, false, false, null]],
        '/pacientes/login' => [[['_route' => 'app_paciente_login', '_controller' => 'App\\Controller\\PacienteController::login'], null, ['POST' => 0], null, false, false, null]],
        '/pacientes/atestados' => [[['_route' => 'app_paciente_buscaratestados', '_controller' => 'App\\Controller\\PacienteController::buscarAtestados'], null, ['GET' => 0], null, false, false, null]],
    ],
    [ // $regexpList
    ],
    [ // $dynamicRoutes
    ],
    null, // $checkCondition
];
