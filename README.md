# Introdução

Aplicação desenvolvida para a [vaga de desenvolvedor web na ByCoders.](INSTRUCTIONS.md)

# Índice
- [Requisitos](#requisitos)
- [Estrutura](#estrutura)
- [Tecnologias](#tecnologias)
- [Preparação do ambiente](#preparação-do-ambiente)
- [Iniciando a aplicação](#iniciando-a-aplicação)
- [Rodando os testes](#rodando-os-testes)
- [Comandos úteis](#comandos-úteis)
- [Links](#links)
- [Notas](#notas)
- [Créditos](#créditos)
- [Licença](#licença)

# Requisitos
- [Docker][docker]

# Estrutura
A aplicação utiliza [docker] para virtualização do ambiente.

Estrutura de arquivos:

```
 |_api
 |_app
 |-.env.example
 |-CNAB.txt
 |-docker-compose.yml
 |-Makefile
 |-setup.sh
``` 
- **api**: Contém os arquivos da API
- **app**: Contém os arquivos do SPA (app frontend)
- **.env.example**: Variáveis de ambiente dos serviços
- **CNAB.txt**: Arquivo CNAB padrão para ser utilizado em testes
- **docker-compose.yml**: Arquivo de configuração dos serviços docker
- **Makefile**: Arquivo com rotinas úteis para instalação e configuração do ambiente
- **setup.sh**: Script para preparar o ambiente instalando dependências e copiando arquivos

# Tecnologias
- [Laravel][laravel]
- [Vue.js][vue]
- [MySQL][mysql]
- [Docker][docker]

# Preparação do ambiente
```
make setup
```
Este comando vai preparar o ambiente para a primeira utilização da aplicação. 
Ele executará os seguintes passos: 
- Baixar as imagens [docker], caso não estejam presentes localmente
- Copiar os arquivos .env do docker, API e da aplicação frontend
- Instalar as dependências da API e da aplicação frontend

# Iniciando a aplicação
```
make start
```
Este comando levantará todos os serviços [docker] utilizados pela aplicação
e disponibilizará os endereços:
- API: http://localhost
- APP: http://localhost:8080

# Rodando os testes
```
make test
```
Este comando irá rodar os testes unitários da API e aplicação frontend.

Para rodar os testes especícos
- API: ```make test-api```
- APP: ```make test-app```

# Comandos úteis
Para facilitar a utilização e configuração da aplicação utilize o comando `make`

- `make start` Inicia os serviços da aplicação
- `make setup` Instalação e configuração do ambiente
- `make stop` Para todos os serviços
- `make logs` Exibe os logs dos serviços
- `make fresh` **ATENÇÃO** Remove os arquivos .env, todas as dependências e apaga todo o banco de dados
- `make down` Remove todos os serviços
- `make test` Roda todos os testes unitários (API e APP)
- `make test-api` Roda os testes unitários da API
- `make test-app` Roda os testes unitários da aplicação frontend


# Links
- Documentação da API: https://documenter.getpostman.com/view/4094324/TzzEmYnS

# Notas

- **Estratégia de importação de arquivos**: 
Criei uma solução para evitar a duplicação dos registros, caso um arquivo seja importado mais de uma vez. Basicamente salvo um registro na tabela `import_history`
contendo o path, nome e hash do arquivo importado. Antes de efetuar uma importação pesquiso se existe um histórico com o mesmo hash do arquivo atual, caso não exista prossigo com a importação normalmente.
- **Pontos de melhoria**: 
  - Não foquei na validação no frontend, poderia ter utilizado alguma lib de validação como o Vuelidate
  - Procurei criar uma camada simples para services, mas poderia ter utilizado scopes dos próprios models.
  - No caso do arquivo CNAB ser muito grande poderia ser utilizado a estrutura de [filas](https://laravel.com/docs/7.x/queues) do [Laravel][laravel],
dessa forma melhoraria a performance e experiência do usuário.
  - Tratar a paginação no frontend
  - Exibir componente de `loading`

# Créditos
Lincoln Silva Brito <lincoln.sbrito@gmail.com>

# Licença
[MIT]

[github]:https://github.com
[laravel]:https://laravel.com/
[vue]:https://vuejs.org/
[mysql]:https://www.mysql.com/
[docker]:https://www.docker.com/
[mit]:http://opensource.org/licenses/MIT