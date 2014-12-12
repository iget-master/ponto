Ponto
=====

Sistema baseado em web, com o objetivo de monitorar a presença e pontualidade dos funcionários iGet.

Funcionalidades
=====

* Inclusão, exclusão e modificação de Funcionário
* Ponto de entrada
* Ponto de saída
* Justificativa de falta
* Relatório de ponto mensal por Funcionário com percentual de presença, dias de faltas e justificativas.
* Painel de estatísticas para o Funcionário (semelhante ao seu relatório)

**Funcionário**

O funcionário deve ter os seguintes atributos:
* Nome
* Sobrenome
* Horário de entrada e saída por dia da semana [FOREIGN TABLE]
* Email [UNIQUE]
* Senha

De forma que sua tabela `users` contenha as seguintes colunas:
* `id`
* `name VARCHAR(255)`
* `surname VARCHAR(255)`
* `email VARCHAR(255) UNIQUE`
* `password VARCHAR(255)`
* `remember_token VARCHAR(100) NULL`
* `Timestamps Laravel`

Os horários de entrada e saída por dia, devem ser armazenados numa tabela relacional

