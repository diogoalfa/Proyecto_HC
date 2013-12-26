--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: administrador; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE administrador (
    pk bigint NOT NULL,
    nombre character varying(50) NOT NULL,
    clave character varying(50) NOT NULL,
    contacto character varying(50),
    rut character varying(20) NOT NULL
);


ALTER TABLE public.administrador OWNER TO postgres;

--
-- Name: administrador_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE administrador_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.administrador_pk_seq OWNER TO postgres;

--
-- Name: administrador_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE administrador_pk_seq OWNED BY administrador.pk;


--
-- Name: asignaturas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE asignaturas (
    pk bigint NOT NULL,
    departamento_fk integer NOT NULL,
    codigo character varying(8) NOT NULL,
    nombre character varying(50) NOT NULL,
    descripcion text
);


ALTER TABLE public.asignaturas OWNER TO postgres;

--
-- Name: asignaturas_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE asignaturas_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.asignaturas_pk_seq OWNER TO postgres;

--
-- Name: asignaturas_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE asignaturas_pk_seq OWNED BY asignaturas.pk;


--
-- Name: cursos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cursos (
    pk bigint NOT NULL,
    semestre integer DEFAULT 0 NOT NULL,
    anio integer NOT NULL,
    asignatura_fk bigint NOT NULL,
    docente_fk bigint NOT NULL,
    seccion integer NOT NULL
);


ALTER TABLE public.cursos OWNER TO postgres;

--
-- Name: cursos_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cursos_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cursos_pk_seq OWNER TO postgres;

--
-- Name: cursos_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cursos_pk_seq OWNED BY cursos.pk;


--
-- Name: departamentos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE departamentos (
    pk integer NOT NULL,
    facultad_fk integer NOT NULL,
    departamento character varying(50) NOT NULL,
    descripcion text
);


ALTER TABLE public.departamentos OWNER TO postgres;

--
-- Name: departamentos_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE departamentos_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.departamentos_pk_seq OWNER TO postgres;

--
-- Name: departamentos_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE departamentos_pk_seq OWNED BY departamentos.pk;


--
-- Name: docentes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE docentes (
    pk bigint NOT NULL,
    nombres character varying(50) NOT NULL,
    apellidos character varying(50) NOT NULL,
    rut character varying(20) NOT NULL,
    departamento_fk integer NOT NULL
);


ALTER TABLE public.docentes OWNER TO postgres;

--
-- Name: docentes_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE docentes_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.docentes_pk_seq OWNER TO postgres;

--
-- Name: docentes_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE docentes_pk_seq OWNED BY docentes.pk;


--
-- Name: escuelas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE escuelas (
    pk integer NOT NULL,
    departamento_fk integer NOT NULL,
    escuela character varying(50) NOT NULL,
    descripcion text
);


ALTER TABLE public.escuelas OWNER TO postgres;

--
-- Name: escuelas_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE escuelas_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.escuelas_pk_seq OWNER TO postgres;

--
-- Name: escuelas_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE escuelas_pk_seq OWNED BY escuelas.pk;


--
-- Name: facultades; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE facultades (
    pk integer NOT NULL,
    facultad character varying NOT NULL,
    descripcion text
);


ALTER TABLE public.facultades OWNER TO postgres;

--
-- Name: facultades_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE facultades_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.facultades_pk_seq OWNER TO postgres;

--
-- Name: facultades_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE facultades_pk_seq OWNED BY facultades.pk;


--
-- Name: periodos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE periodos (
    pk integer NOT NULL,
    numero integer NOT NULL,
    periodo character varying(50) NOT NULL,
    inicio time without time zone NOT NULL,
    termino time without time zone NOT NULL
);


ALTER TABLE public.periodos OWNER TO postgres;

--
-- Name: periodos_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE periodos_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.periodos_pk_seq OWNER TO postgres;

--
-- Name: periodos_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE periodos_pk_seq OWNED BY periodos.pk;


--
-- Name: reservas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE reservas (
    pk bigint NOT NULL,
    fecha date DEFAULT now() NOT NULL,
    sala_fk integer NOT NULL,
    periodo_fk integer NOT NULL,
    curso_fk bigint NOT NULL,
    adm_fk bigint NOT NULL
);


ALTER TABLE public.reservas OWNER TO postgres;

--
-- Name: reservas_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE reservas_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.reservas_pk_seq OWNER TO postgres;

--
-- Name: reservas_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE reservas_pk_seq OWNED BY reservas.pk;


--
-- Name: salas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE salas (
    pk integer NOT NULL,
    facultad_fk integer NOT NULL,
    sala character varying(50) NOT NULL
);


ALTER TABLE public.salas OWNER TO postgres;

--
-- Name: salas_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE salas_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.salas_pk_seq OWNER TO postgres;

--
-- Name: salas_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE salas_pk_seq OWNED BY salas.pk;


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY administrador ALTER COLUMN pk SET DEFAULT nextval('administrador_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY asignaturas ALTER COLUMN pk SET DEFAULT nextval('asignaturas_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cursos ALTER COLUMN pk SET DEFAULT nextval('cursos_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY departamentos ALTER COLUMN pk SET DEFAULT nextval('departamentos_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY docentes ALTER COLUMN pk SET DEFAULT nextval('docentes_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY escuelas ALTER COLUMN pk SET DEFAULT nextval('escuelas_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY facultades ALTER COLUMN pk SET DEFAULT nextval('facultades_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY periodos ALTER COLUMN pk SET DEFAULT nextval('periodos_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reservas ALTER COLUMN pk SET DEFAULT nextval('reservas_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY salas ALTER COLUMN pk SET DEFAULT nextval('salas_pk_seq'::regclass);


--
-- Data for Name: administrador; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO administrador VALUES (1, 'jose', '4321', 'jose@utem.cl', '21776304-5');
INSERT INTO administrador VALUES (31, 'sebastian', 'nose', 'nose@jaja', 'nose');
INSERT INTO administrador VALUES (30, 'juancho2.0', 'nose', 'nose@jaja.com', 'nosexd');


--
-- Name: administrador_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('administrador_pk_seq', 32, true);


--
-- Data for Name: asignaturas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO asignaturas VALUES (104, 1, 'INF-762', 'Computacion Paralela', '');
INSERT INTO asignaturas VALUES (93, 1, 'INF-648', 'Analisis de Algoritmo', '');
INSERT INTO asignaturas VALUES (34, 1, 'INF-626', 'Lenguaje de Expresiones', '');
INSERT INTO asignaturas VALUES (55, 1, 'INF-642', 'Lenguaje de Programacion', '');
INSERT INTO asignaturas VALUES (111, 1, 'INF-752', 'Gestion Financiera de TI', '');
INSERT INTO asignaturas VALUES (82, 1, 'INF-653', 'Simulacion de Sistemas', '');
INSERT INTO asignaturas VALUES (103, 1, 'INF-750', 'Optimizacion de Sistemas', '');
INSERT INTO asignaturas VALUES (73, 1, 'INF-644', 'Teorias Automatas', '');
INSERT INTO asignaturas VALUES (1, 1, 'EFE', 'Computacion Movil', '');
INSERT INTO asignaturas VALUES (105, 1, 'INF-658', 'Auditoria de Sistemas', '');
INSERT INTO asignaturas VALUES (65, 1, 'INF-631', 'Bases de Datos', '');


--
-- Name: asignaturas_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('asignaturas_pk_seq', 1, false);


--
-- Data for Name: cursos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO cursos VALUES (1, 2, 2013, 82, 12, 1);


--
-- Name: cursos_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cursos_pk_seq', 1, true);


--
-- Data for Name: departamentos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO departamentos VALUES (2, 1, 'Industria', '');
INSERT INTO departamentos VALUES (1, 1, 'Informatica', '');


--
-- Name: departamentos_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('departamentos_pk_seq', 6, true);


--
-- Data for Name: docentes; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO docentes VALUES (1, 'Mauro', 'Castillo Valdes', '001', 1);
INSERT INTO docentes VALUES (2, 'Francisco Alberto ', 'Cofré Gajardo', '002', 1);
INSERT INTO docentes VALUES (3, 'Ricardo Osvaldo', 'Corbinaud Perez', '003', 1);
INSERT INTO docentes VALUES (4, 'Victor Heughes', 'Escobar Jeria', '004', 1);
INSERT INTO docentes VALUES (5, 'Oscar', 'Magna Veloso', '005', 1);
INSERT INTO docentes VALUES (6, 'Patricia', 'Mellado Acevedo', '006', 1);
INSERT INTO docentes VALUES (7, 'Rene', 'Peña Aguilar', '007', 1);
INSERT INTO docentes VALUES (8, 'Héctor Manuel', 'Pincheira Conejeros', '008', 1);
INSERT INTO docentes VALUES (9, 'Sara', 'Rojas Aldea', '009', 1);
INSERT INTO docentes VALUES (10, 'Marta', 'Rojas Estay', '010', 1);
INSERT INTO docentes VALUES (11, 'Maria Victoria', 'Vallejos Amado', '011', 1);
INSERT INTO docentes VALUES (12, 'Santiago', 'Zapata Caceres', '012', 1);
INSERT INTO docentes VALUES (13, 'Alejandro', 'Reyes', '013', 1);
INSERT INTO docentes VALUES (14, 'Sergio', 'Muñoz', '014', 1);
INSERT INTO docentes VALUES (15, 'Jorge', 'Pavez', '015', 1);
INSERT INTO docentes VALUES (16, 'Jorge', 'Morris', '016', 1);
INSERT INTO docentes VALUES (17, 'Rene', 'Peña', '017', 1);


--
-- Name: docentes_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('docentes_pk_seq', 1, false);


--
-- Data for Name: escuelas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO escuelas VALUES (1, 1, 'Informatica', 'Carreras ingenieria en informatica y civil en computacion');
INSERT INTO escuelas VALUES (2, 2, 'Industria y Civil industrial', '');


--
-- Name: escuelas_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('escuelas_pk_seq', 1, false);


--
-- Data for Name: facultades; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO facultades VALUES (1, 'Ingenieria', 'Macul');
INSERT INTO facultades VALUES (2, 'FAE', 'nose');


--
-- Name: facultades_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('facultades_pk_seq', 3, true);


--
-- Data for Name: periodos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO periodos VALUES (1, 1, '1', '08:15:00', '09:35:00');
INSERT INTO periodos VALUES (2, 2, '2', '09:45:00', '11:05:00');
INSERT INTO periodos VALUES (3, 3, '3', '11:15:00', '12:35:00');
INSERT INTO periodos VALUES (4, 4, '4', '12:45:00', '14:05:00');
INSERT INTO periodos VALUES (5, 5, '5', '14:15:00', '15:35:00');
INSERT INTO periodos VALUES (6, 6, '6', '15:45:00', '17:05:00');
INSERT INTO periodos VALUES (7, 7, '7', '17:15:00', '18:35:00');
INSERT INTO periodos VALUES (8, 8, '8', '19:00:00', '20:30:00');
INSERT INTO periodos VALUES (9, 9, '9', '20:45:00', '22:15:00');


--
-- Name: periodos_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('periodos_pk_seq', 1, false);


--
-- Data for Name: reservas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO reservas VALUES (1, '2013-12-20', 15, 6, 1, 1);


--
-- Name: reservas_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('reservas_pk_seq', 1, true);


--
-- Data for Name: salas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO salas VALUES (1, 1, 'M1-301');
INSERT INTO salas VALUES (2, 1, 'M1-302');
INSERT INTO salas VALUES (3, 1, 'M1-303');
INSERT INTO salas VALUES (4, 1, 'M1-304');
INSERT INTO salas VALUES (5, 1, 'M1-305');
INSERT INTO salas VALUES (6, 1, 'M1-306');
INSERT INTO salas VALUES (7, 1, 'M1-307');
INSERT INTO salas VALUES (8, 1, 'M2-201');
INSERT INTO salas VALUES (9, 1, 'M2-202');
INSERT INTO salas VALUES (10, 1, 'M2-203');
INSERT INTO salas VALUES (11, 1, 'M2-204');
INSERT INTO salas VALUES (12, 1, 'M2-301');
INSERT INTO salas VALUES (13, 1, 'M2-302');
INSERT INTO salas VALUES (14, 1, 'M2-303');
INSERT INTO salas VALUES (15, 1, 'M2-304');
INSERT INTO salas VALUES (16, 1, 'M3-101');
INSERT INTO salas VALUES (17, 1, 'M3-102');
INSERT INTO salas VALUES (18, 1, 'M3-103');
INSERT INTO salas VALUES (19, 1, 'M3-104');
INSERT INTO salas VALUES (20, 1, 'M3-201');
INSERT INTO salas VALUES (21, 1, 'M3-202');
INSERT INTO salas VALUES (22, 1, 'M3-203');
INSERT INTO salas VALUES (23, 1, 'M3-204');
INSERT INTO salas VALUES (24, 1, 'M3-301');
INSERT INTO salas VALUES (25, 1, 'M3-303');
INSERT INTO salas VALUES (26, 1, 'M3-304');
INSERT INTO salas VALUES (27, 1, 'M3-400');
INSERT INTO salas VALUES (28, 1, 'M3-402');
INSERT INTO salas VALUES (29, 1, 'M6-205');
INSERT INTO salas VALUES (30, 1, 'M6-206');
INSERT INTO salas VALUES (31, 1, 'M6-209');
INSERT INTO salas VALUES (32, 1, 'M6-210');
INSERT INTO salas VALUES (33, 1, 'M6-212');
INSERT INTO salas VALUES (34, 1, 'M6-214');
INSERT INTO salas VALUES (35, 1, 'M6-325');
INSERT INTO salas VALUES (36, 1, 'M6-326');
INSERT INTO salas VALUES (37, 1, 'M6-327');
INSERT INTO salas VALUES (38, 1, 'M6-330');
INSERT INTO salas VALUES (39, 1, 'M6-331');


--
-- Name: salas_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('salas_pk_seq', 1, false);


--
-- Name: administrador_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY administrador
    ADD CONSTRAINT administrador_pkey PRIMARY KEY (pk);


--
-- Name: asignaturas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY asignaturas
    ADD CONSTRAINT asignaturas_pkey PRIMARY KEY (pk);


--
-- Name: cursos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cursos
    ADD CONSTRAINT cursos_pkey PRIMARY KEY (pk);


--
-- Name: departamentos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY departamentos
    ADD CONSTRAINT departamentos_pkey PRIMARY KEY (pk);


--
-- Name: docentes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY docentes
    ADD CONSTRAINT docentes_pkey PRIMARY KEY (pk);


--
-- Name: docentes_rut_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY docentes
    ADD CONSTRAINT docentes_rut_key UNIQUE (rut);


--
-- Name: escuelas_escuela_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY escuelas
    ADD CONSTRAINT escuelas_escuela_key UNIQUE (escuela);


--
-- Name: escuelas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY escuelas
    ADD CONSTRAINT escuelas_pkey PRIMARY KEY (pk);


--
-- Name: facultades_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY facultades
    ADD CONSTRAINT facultades_pkey PRIMARY KEY (pk);


--
-- Name: periodos_numero_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY periodos
    ADD CONSTRAINT periodos_numero_key UNIQUE (numero);


--
-- Name: periodos_periodo_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY periodos
    ADD CONSTRAINT periodos_periodo_key UNIQUE (periodo);


--
-- Name: periodos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY periodos
    ADD CONSTRAINT periodos_pkey PRIMARY KEY (pk);


--
-- Name: reservas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY reservas
    ADD CONSTRAINT reservas_pkey PRIMARY KEY (pk);


--
-- Name: salas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY salas
    ADD CONSTRAINT salas_pkey PRIMARY KEY (pk);


--
-- Name: asignaturas_codigo_nombre_key; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX asignaturas_codigo_nombre_key ON asignaturas USING btree (codigo, nombre);


--
-- Name: cursos_semestre_anio_asignatura_fk_docente_fk_key; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX cursos_semestre_anio_asignatura_fk_docente_fk_key ON cursos USING btree (semestre, anio, asignatura_fk, docente_fk);


--
-- Name: reservas_fecha_sala_fk_periodo_fk_key; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX reservas_fecha_sala_fk_periodo_fk_key ON reservas USING btree (fecha, sala_fk, periodo_fk);


--
-- Name: salas_facultad_fk_sala_key; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX salas_facultad_fk_sala_key ON salas USING btree (facultad_fk, sala);


--
-- Name: asignaturas_departamento_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY asignaturas
    ADD CONSTRAINT asignaturas_departamento_fk_fkey FOREIGN KEY (departamento_fk) REFERENCES departamentos(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cursos_asignatura_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cursos
    ADD CONSTRAINT cursos_asignatura_fk_fkey FOREIGN KEY (asignatura_fk) REFERENCES asignaturas(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cursos_docente_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cursos
    ADD CONSTRAINT cursos_docente_fk_fkey FOREIGN KEY (docente_fk) REFERENCES docentes(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: departamentos_facultad_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY departamentos
    ADD CONSTRAINT departamentos_facultad_fk_fkey FOREIGN KEY (facultad_fk) REFERENCES facultades(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: docentes_departamento_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY docentes
    ADD CONSTRAINT docentes_departamento_fk_fkey FOREIGN KEY (departamento_fk) REFERENCES departamentos(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: escuelas_departamento_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY escuelas
    ADD CONSTRAINT escuelas_departamento_fk_fkey FOREIGN KEY (departamento_fk) REFERENCES departamentos(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: reservas_adm_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reservas
    ADD CONSTRAINT reservas_adm_fk_fkey FOREIGN KEY (adm_fk) REFERENCES administrador(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: reservas_curso_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reservas
    ADD CONSTRAINT reservas_curso_fk_fkey FOREIGN KEY (curso_fk) REFERENCES cursos(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: reservas_periodo_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reservas
    ADD CONSTRAINT reservas_periodo_fk_fkey FOREIGN KEY (periodo_fk) REFERENCES periodos(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: reservas_sala_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reservas
    ADD CONSTRAINT reservas_sala_fk_fkey FOREIGN KEY (sala_fk) REFERENCES salas(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: salas_facultad_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY salas
    ADD CONSTRAINT salas_facultad_fk_fkey FOREIGN KEY (facultad_fk) REFERENCES facultades(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

