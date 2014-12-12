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
* `id` (No formato gerado pelo laravel)
* `name VARCHAR(255)`
* `surname VARCHAR(255)`
* `email VARCHAR(255) UNIQUE`
* `password VARCHAR(255)`
* `remember_token VARCHAR(100) NULL`
* `Timestamps Laravel`

Os horários de entrada e saída por dia, devem ser armazenados numa tabela relacional `users_times` contendo as seguintes colunas:
* `id` (No formato gerado pelo laravel)
* `user_id` (No formato da `users.id`)
* `weekday TINYINT` (0=>Domingo, 6=>Sábado)
* `time_in TIME`
* `time_out TIME`

Esta tabela deve conter um indice `UNIQUE(user_id, weekday)` para impedir entradas duplicadas.

**Ponto**

As "batidas de ponto" devem ser armazenadas na tabela relacional `timetables`:
* `id`
* `user_id`
* `date DATE`
* `time_in TIME NULL`
* `time_out TIME NULL`
* `justification VARCHAR(255) NULL`

Esta tabela deve conter um indice `UNIQUE(user_id, date)` para impedir entradas duplicadas.
As colunas `time_in` e `time_out` podem ser nulas pois esta mesma tabela servirá para justificar faltas, atrasos e saídas antecipadas.
