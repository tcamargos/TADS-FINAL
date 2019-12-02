# homolog

Medicos:
    CadastrarMedico :
        - url= "/medicos/create" 
        - metodo="POST"
        - body:
            "nome": string,
            "crm": string,
            "endereco": string,
            "email": string,
            "senha": string
        - resposta:
            - "Medico Cadastrado com sucesso" -> Medico cadastrado na base de dados
            - "CRM ja cadastrado" -> Medico ja cadastrado.
    RealizarLogin:
        - url= "/medicos/login"
        - metodo= "GET"
        - body:
            "email": string,
            "senha": string
        - resposta:
            - (202) Objeto Medico
            - (401) "Login Incorreto"
     AtualizarMedico:
         - url= "/medicos/update"
         - metodo= "PUT"
         - body:
             "id":int,
             "nome": string,
             "crm": string,
             "endereco": string,
             "email": string,
             "senha": string
         - resposta:
             - (202) Objeto Empresa Atualizado
             - (401) Erros 
     CriaAtestado:
         - url= "/medicos/atestado"
         - metodo= "POST"
         - body:
             "crm":int,
             "data": date,
             "cpf": string,
             "dias": string,
             "nome": string,
             "cid": string
         - resposta:
                                       
Empresas:        
     CadastrarEmpresa:
         - url= "/empresas/create" 
         - metodo="POST"
         - body:
             "nome": string,
             "cnpj": string,
             "endereco": string
             "servico": string
             "email": string
             "senha": string
         - resposta:
             - (201) "Empresa cadastrada com sucesso" -> Empresa cadastrada na base de dados.
             - (226) "CNPJ ja cadastrado" -> Empresa ja cadastrada.       
     RealizarLogin:
         - url= "/empresas/login"
         - metodo= "GET"
         - body:
             "email": string,
             "senha": string
         - resposta:
             - (202) Objeto Empresa
             - (401) "Login Incorreto" 
     AtualizarEmpresa:
         - url= "/empresas/update"
         - metodo= "PUT"
         - body:
             "id":int,
             "nome": string,
             "cnpj": string,
             "endereco": string,
             "servico": string,
             "email": string,
             "senha": string
         - resposta:
             - (202) Objeto Empresa Atualizado
             - (401) Erros 
Paciente
    CadastrarPaciente
        CadastrarEmpresa:
         - url= "/pacientes/create" 
         - metodo="POST"
         - body:
             "nome": string,
             "cpf": string,
             "telefone": string,
             "endereco": string,
             "email": string,
             "senha": string
         - resposta:
                          
            
    
