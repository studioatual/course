create tablespace tbs_course
datafile '/u01/app/oracle/oradata/XE/tbs_course.dbf' size 10M reuse
autoextend on next 1M maxsize 200M
online;

-- Cria usuario (define usuario a tabela)
create user course --usuario
identified by "123456"  --senha
default tablespace tbs_course
temporary tablespace temp;

-- Cria e define a "role" de privilegios (perfil)
create role profile;

grant
create cluster,
create database link,
create procedure,
create session,
create sequence,
create synonym,
create table,
create any type,
create trigger,
create view
to profile;

-- atribui a "role" para o usuario
grant profile to course;

-- define ilimitado tablespace para o usuario
grant unlimited tablespace to course;
