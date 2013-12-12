
/* Drop Indexes */

DROP INDEX IF EXISTS cursos_semestre_anio_asignatura_fk_docente_fk_key;
DROP INDEX IF EXISTS reservas_fecha_sala_fk_periodo_fk_key;
DROP INDEX IF EXISTS salas_facultad_fk_sala_key;
DROP INDEX IF EXISTS asignaturas_codigo_nombre_key;



/* Drop Tables */

DROP TABLE IF EXISTS public.reservas;
DROP TABLE IF EXISTS public.administrador;
DROP TABLE IF EXISTS public.cursos;
DROP TABLE IF EXISTS public.docentes;
DROP TABLE IF EXISTS public.escuelas;
DROP TABLE IF EXISTS public.asignaturas;
DROP TABLE IF EXISTS public.departamentos;
DROP TABLE IF EXISTS public.salas;
DROP TABLE IF EXISTS public.facultades;
DROP TABLE IF EXISTS public.periodos;



/* Drop Sequences */

DROP SEQUENCE IF EXISTS public.administrador_pk_seq;
DROP SEQUENCE IF EXISTS public.asignaturas_pk_seq;
DROP SEQUENCE IF EXISTS public.cursos_pk_seq;
DROP SEQUENCE IF EXISTS public.departamentos_pk_seq;
DROP SEQUENCE IF EXISTS public.docentes_pk_seq;
DROP SEQUENCE IF EXISTS public.escuelas_pk_seq;
DROP SEQUENCE IF EXISTS public.facultades_pk_seq;
DROP SEQUENCE IF EXISTS public.periodos_pk_seq;
DROP SEQUENCE IF EXISTS public.reservas_pk_seq;
DROP SEQUENCE IF EXISTS public.salas_pk_seq;




/* Create Tables */

CREATE TABLE public.administrador
(
	pk bigserial NOT NULL,
	nombre varchar(50) NOT NULL,
	clave varchar(50) NOT NULL,
	contacto varchar(50),
	rut varchar(20) NOT NULL,
	CONSTRAINT administrador_pkey PRIMARY KEY (pk)
) WITHOUT OIDS;


CREATE TABLE public.cursos
(
	pk bigserial NOT NULL,
	semestre int DEFAULT 0 NOT NULL,
	anio int NOT NULL,
	asignatura_fk bigint NOT NULL,
	docente_fk bigint NOT NULL,
	seccion int NOT NULL,
	CONSTRAINT cursos_pkey PRIMARY KEY (pk)
) WITHOUT OIDS;


CREATE TABLE public.docentes
(
	pk bigserial NOT NULL,
	nombres varchar(50) NOT NULL,
	apellidos varchar(50) NOT NULL,
	rut varchar(20) NOT NULL UNIQUE,
	departamento_fk int NOT NULL,
	CONSTRAINT docentes_pkey PRIMARY KEY (pk)
) WITHOUT OIDS;


CREATE TABLE public.escuelas
(
	pk serial NOT NULL,
	departamento_fk int NOT NULL,
	escuela varchar(50) NOT NULL UNIQUE,
	descripcion text,
	CONSTRAINT escuelas_pkey PRIMARY KEY (pk)
) WITHOUT OIDS;


CREATE TABLE public.facultades
(
	pk serial NOT NULL,
	facultad varchar(50) NOT NULL UNIQUE,
	descripcion text,
	CONSTRAINT facultades_pkey PRIMARY KEY (pk)
) WITHOUT OIDS;


CREATE TABLE public.periodos
(
	pk serial NOT NULL,
	numero int NOT NULL UNIQUE,
	periodo varchar(50) NOT NULL UNIQUE,
	inicio time NOT NULL,
	termino time NOT NULL,
	CONSTRAINT periodos_pkey PRIMARY KEY (pk)
) WITHOUT OIDS;


CREATE TABLE public.reservas
(
	pk bigserial NOT NULL,
	fecha date DEFAULT now() NOT NULL,
	sala_fk int NOT NULL,
	periodo_fk int NOT NULL,
	curso_fk bigint NOT NULL,
	adm_fk bigint NOT NULL,
	CONSTRAINT reservas_pkey PRIMARY KEY (pk)
) WITHOUT OIDS;


CREATE TABLE public.salas
(
	pk serial NOT NULL,
	facultad_fk int NOT NULL,
	sala varchar(50) NOT NULL,
	CONSTRAINT salas_pkey PRIMARY KEY (pk)
) WITHOUT OIDS;


CREATE TABLE public.departamentos
(
	pk serial NOT NULL,
	facultad_fk int NOT NULL,
	departamento varchar(50) NOT NULL UNIQUE,
	descripcion text,
	CONSTRAINT departamentos_pkey PRIMARY KEY (pk)
) WITHOUT OIDS;


CREATE TABLE public.asignaturas
(
	pk bigserial NOT NULL,
	departamento_fk int NOT NULL,
	codigo varchar(8) NOT NULL,
	nombre varchar(50) NOT NULL,
	descripcion text,
	CONSTRAINT asignaturas_pkey PRIMARY KEY (pk)
) WITHOUT OIDS;



/* Create Foreign Keys */

ALTER TABLE public.reservas
	ADD FOREIGN KEY (adm_fk)
	REFERENCES public.administrador (pk)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE public.reservas
	ADD CONSTRAINT reservas_curso_fk_fkey FOREIGN KEY (curso_fk)
	REFERENCES public.cursos (pk)
	ON UPDATE CASCADE
	ON DELETE CASCADE
;


ALTER TABLE public.cursos
	ADD CONSTRAINT cursos_docente_fk_fkey FOREIGN KEY (docente_fk)
	REFERENCES public.docentes (pk)
	ON UPDATE CASCADE
	ON DELETE CASCADE
;


ALTER TABLE public.departamentos
	ADD CONSTRAINT departamentos_facultad_fk_fkey FOREIGN KEY (facultad_fk)
	REFERENCES public.facultades (pk)
	ON UPDATE CASCADE
	ON DELETE CASCADE
;


ALTER TABLE public.salas
	ADD CONSTRAINT salas_facultad_fk_fkey FOREIGN KEY (facultad_fk)
	REFERENCES public.facultades (pk)
	ON UPDATE CASCADE
	ON DELETE CASCADE
;


ALTER TABLE public.reservas
	ADD CONSTRAINT reservas_periodo_fk_fkey FOREIGN KEY (periodo_fk)
	REFERENCES public.periodos (pk)
	ON UPDATE CASCADE
	ON DELETE CASCADE
;


ALTER TABLE public.reservas
	ADD CONSTRAINT reservas_sala_fk_fkey FOREIGN KEY (sala_fk)
	REFERENCES public.salas (pk)
	ON UPDATE CASCADE
	ON DELETE CASCADE
;


ALTER TABLE public.escuelas
	ADD CONSTRAINT escuelas_departamento_fk_fkey FOREIGN KEY (departamento_fk)
	REFERENCES public.departamentos (pk)
	ON UPDATE CASCADE
	ON DELETE CASCADE
;


ALTER TABLE public.docentes
	ADD CONSTRAINT docentes_departamento_fk_fkey FOREIGN KEY (departamento_fk)
	REFERENCES public.departamentos (pk)
	ON UPDATE CASCADE
	ON DELETE CASCADE
;


ALTER TABLE public.asignaturas
	ADD CONSTRAINT asignaturas_departamento_fk_fkey FOREIGN KEY (departamento_fk)
	REFERENCES public.departamentos (pk)
	ON UPDATE CASCADE
	ON DELETE CASCADE
;


ALTER TABLE public.cursos
	ADD CONSTRAINT cursos_asignatura_fk_fkey FOREIGN KEY (asignatura_fk)
	REFERENCES public.asignaturas (pk)
	ON UPDATE CASCADE
	ON DELETE CASCADE
;



/* Create Indexes */

CREATE UNIQUE INDEX cursos_semestre_anio_asignatura_fk_docente_fk_key ON public.cursos USING BTREE (semestre, anio, asignatura_fk, docente_fk);
CREATE UNIQUE INDEX reservas_fecha_sala_fk_periodo_fk_key ON public.reservas USING BTREE (fecha, sala_fk, periodo_fk);
CREATE UNIQUE INDEX salas_facultad_fk_sala_key ON public.salas USING BTREE (facultad_fk, sala);
CREATE UNIQUE INDEX asignaturas_codigo_nombre_key ON public.asignaturas USING BTREE (codigo, nombre);



