--
-- PostgreSQL database dump
--

-- Dumped from database version 16.1
-- Dumped by pg_dump version 16.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: ordine_dettagliato; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ordine_dettagliato (
    "ID_dettaglio" integer NOT NULL,
    idordine integer,
    prodotto text,
    prezzo numeric
);


ALTER TABLE public.ordine_dettagliato OWNER TO postgres;

--
-- Name: ordine_dettagliato_ID_dettaglio_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."ordine_dettagliato_ID_dettaglio_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public."ordine_dettagliato_ID_dettaglio_seq" OWNER TO postgres;

--
-- Name: ordine_dettagliato_ID_dettaglio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."ordine_dettagliato_ID_dettaglio_seq" OWNED BY public.ordine_dettagliato."ID_dettaglio";


--
-- Name: ordine_generale; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ordine_generale (
    utente text,
    totale numeric,
    data text,
    idordine integer NOT NULL
);


ALTER TABLE public.ordine_generale OWNER TO postgres;

--
-- Name: ordine_generale_idordine_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ordine_generale_idordine_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.ordine_generale_idordine_seq OWNER TO postgres;

--
-- Name: ordine_generale_idordine_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ordine_generale_idordine_seq OWNED BY public.ordine_generale.idordine;


--
-- Name: utente; Type: TABLE; Schema: public; Owner: www
--

CREATE TABLE public.utente (
    nome character varying(50),
    cognome character varying(50),
    password character varying(255),
    email character varying(50) NOT NULL
);


ALTER TABLE public.utente OWNER TO www;

--
-- Name: ordine_dettagliato ID_dettaglio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ordine_dettagliato ALTER COLUMN "ID_dettaglio" SET DEFAULT nextval('public."ordine_dettagliato_ID_dettaglio_seq"'::regclass);


--
-- Name: ordine_generale idordine; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ordine_generale ALTER COLUMN idordine SET DEFAULT nextval('public.ordine_generale_idordine_seq'::regclass);


--
-- Data for Name: ordine_dettagliato; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ordine_dettagliato ("ID_dettaglio", idordine, prodotto, prezzo) FROM stdin;
228	245	Beagle	800
229	245	Ara Giacinto	35000
230	245	Conuro Testa Nera	500
231	245	Distributore Acqua	12
232	245	Guinzaglio per Cani	10
233	245	Cibo per Uccelli	25
234	246	British Shorthair	1000
235	246	Tonchinese	1300
236	246	Cibo per Gatti	10
237	246	Spazzola	10
238	247	Sella Italiano	7500
239	247	Sella	500
240	247	Distributore Acqua	12
\.


--
-- Data for Name: ordine_generale; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ordine_generale (utente, totale, data, idordine) FROM stdin;
a.trofimets@studenti.unisa.it	36347	22/02/24	245
g.petrone27@studenti.unisa.it	2320	22/02/24	246
g.anzivino@studenti.unisa.it	8012	22/02/24	247
\.


--
-- Data for Name: utente; Type: TABLE DATA; Schema: public; Owner: www
--

COPY public.utente (nome, cognome, password, email) FROM stdin;
Gianluca	Petrone	$2y$10$hVDrGD31U8xvxy1/6FDYJ.GPlBDkmMOnPHDiiYaclQovBrcAJUN1y	g.petrone27@studenti.unisa.it
Giuseppe	Anzivino	$2y$10$c1FM2YS28V9xA23s.AePTeeNa/yGGFA3YMeZOf/7NZaL2HVJmXNqK	g.anzivino@studenti.unisa.it
Antonio	Trofimets	$2y$10$keYwu4xlPIdmZ8nxISxjGevan9g9o2CovR/qYsqjodZo8WeHsZFX.	a.trofimets@studenti.unisa.it
\.


--
-- Name: ordine_dettagliato_ID_dettaglio_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."ordine_dettagliato_ID_dettaglio_seq"', 240, true);


--
-- Name: ordine_generale_idordine_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ordine_generale_idordine_seq', 247, true);


--
-- Name: ordine_dettagliato ordine_dettagliato_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ordine_dettagliato
    ADD CONSTRAINT ordine_dettagliato_pkey PRIMARY KEY ("ID_dettaglio");


--
-- Name: ordine_generale ordine_generale_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ordine_generale
    ADD CONSTRAINT ordine_generale_pkey PRIMARY KEY (idordine);


--
-- Name: utente utente_pkey; Type: CONSTRAINT; Schema: public; Owner: www
--

ALTER TABLE ONLY public.utente
    ADD CONSTRAINT utente_pkey PRIMARY KEY (email);


--
-- Name: COLUMN utente.nome; Type: ACL; Schema: public; Owner: www
--

GRANT ALL(nome) ON TABLE public.utente TO www;


--
-- PostgreSQL database dump complete
--

