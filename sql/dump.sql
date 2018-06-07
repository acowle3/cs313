--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.9
-- Dumped by pg_dump version 9.6.9

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

ALTER TABLE ONLY simple_imageboard.message DROP CONSTRAINT message_thread_id_fkey;
ALTER TABLE ONLY simple_imageboard.thread DROP CONSTRAINT thread_pkey;
ALTER TABLE ONLY simple_imageboard.message DROP CONSTRAINT message_pkey;
ALTER TABLE simple_imageboard.thread ALTER COLUMN thread_id DROP DEFAULT;
ALTER TABLE simple_imageboard.message ALTER COLUMN message_id DROP DEFAULT;
DROP SEQUENCE simple_imageboard.thread_user_email_seq;
DROP SEQUENCE simple_imageboard.thread_thread_id_seq;
DROP TABLE simple_imageboard.thread;
DROP SEQUENCE simple_imageboard.message_message_id_seq;
DROP TABLE simple_imageboard.message;
DROP SCHEMA simple_imageboard;
--
-- Name: simple_imageboard; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA simple_imageboard;


ALTER SCHEMA simple_imageboard OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: message; Type: TABLE; Schema: simple_imageboard; Owner: postgres
--

CREATE TABLE simple_imageboard.message (
    message_id integer NOT NULL,
    message_body text,
    thread_id integer NOT NULL,
    message_date timestamp with time zone DEFAULT now() NOT NULL,
    user_email text NOT NULL
);


ALTER TABLE simple_imageboard.message OWNER TO postgres;

--
-- Name: message_message_id_seq; Type: SEQUENCE; Schema: simple_imageboard; Owner: postgres
--

CREATE SEQUENCE simple_imageboard.message_message_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE simple_imageboard.message_message_id_seq OWNER TO postgres;

--
-- Name: message_message_id_seq; Type: SEQUENCE OWNED BY; Schema: simple_imageboard; Owner: postgres
--

ALTER SEQUENCE simple_imageboard.message_message_id_seq OWNED BY simple_imageboard.message.message_id;


--
-- Name: thread; Type: TABLE; Schema: simple_imageboard; Owner: postgres
--

CREATE TABLE simple_imageboard.thread (
    thread_id integer NOT NULL,
    thread_title text NOT NULL,
    thread_date timestamp with time zone DEFAULT now() NOT NULL,
    user_email text NOT NULL,
    recent_post_date timestamp with time zone NOT NULL
);


ALTER TABLE simple_imageboard.thread OWNER TO postgres;

--
-- Name: thread_thread_id_seq; Type: SEQUENCE; Schema: simple_imageboard; Owner: postgres
--

CREATE SEQUENCE simple_imageboard.thread_thread_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE simple_imageboard.thread_thread_id_seq OWNER TO postgres;

--
-- Name: thread_thread_id_seq; Type: SEQUENCE OWNED BY; Schema: simple_imageboard; Owner: postgres
--

ALTER SEQUENCE simple_imageboard.thread_thread_id_seq OWNED BY simple_imageboard.thread.thread_id;


--
-- Name: thread_user_email_seq; Type: SEQUENCE; Schema: simple_imageboard; Owner: postgres
--

CREATE SEQUENCE simple_imageboard.thread_user_email_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE simple_imageboard.thread_user_email_seq OWNER TO postgres;

--
-- Name: thread_user_email_seq; Type: SEQUENCE OWNED BY; Schema: simple_imageboard; Owner: postgres
--

ALTER SEQUENCE simple_imageboard.thread_user_email_seq OWNED BY simple_imageboard.thread.user_email;


--
-- Name: message message_id; Type: DEFAULT; Schema: simple_imageboard; Owner: postgres
--

ALTER TABLE ONLY simple_imageboard.message ALTER COLUMN message_id SET DEFAULT nextval('simple_imageboard.message_message_id_seq'::regclass);


--
-- Name: thread thread_id; Type: DEFAULT; Schema: simple_imageboard; Owner: postgres
--

ALTER TABLE ONLY simple_imageboard.thread ALTER COLUMN thread_id SET DEFAULT nextval('simple_imageboard.thread_thread_id_seq'::regclass);


--
-- Data for Name: message; Type: TABLE DATA; Schema: simple_imageboard; Owner: postgres
--

INSERT INTO simple_imageboard.message VALUES (1, 'I do not knoe dah wey', 1, '2018-06-06 16:51:02.288217-06', 'aconditioner@gmail.com');
INSERT INTO simple_imageboard.message VALUES (2, 'You HAVE TO HAVE EBOLA TO KNOE DAH WEY!', 1, '2018-06-06 16:51:38.211542-06', 'aconditioner@gmail.com');


--
-- Name: message_message_id_seq; Type: SEQUENCE SET; Schema: simple_imageboard; Owner: postgres
--

SELECT pg_catalog.setval('simple_imageboard.message_message_id_seq', 2, true);


--
-- Data for Name: thread; Type: TABLE DATA; Schema: simple_imageboard; Owner: postgres
--

INSERT INTO simple_imageboard.thread VALUES (1, 'Do U know dah wey?', '2018-06-06 00:00:00-06', 'aconditioner@gmail.com', '2018-06-06 00:00:00-06');
INSERT INTO simple_imageboard.thread VALUES (2, 'pepe', '2018-06-06 00:00:00-06', 'aconditioner@gmail.com', '2018-06-06 00:00:00-06');


--
-- Name: thread_thread_id_seq; Type: SEQUENCE SET; Schema: simple_imageboard; Owner: postgres
--

SELECT pg_catalog.setval('simple_imageboard.thread_thread_id_seq', 2, true);


--
-- Name: thread_user_email_seq; Type: SEQUENCE SET; Schema: simple_imageboard; Owner: postgres
--

SELECT pg_catalog.setval('simple_imageboard.thread_user_email_seq', 1, false);


--
-- Name: message message_pkey; Type: CONSTRAINT; Schema: simple_imageboard; Owner: postgres
--

ALTER TABLE ONLY simple_imageboard.message
    ADD CONSTRAINT message_pkey PRIMARY KEY (message_id);


--
-- Name: thread thread_pkey; Type: CONSTRAINT; Schema: simple_imageboard; Owner: postgres
--

ALTER TABLE ONLY simple_imageboard.thread
    ADD CONSTRAINT thread_pkey PRIMARY KEY (thread_id);


--
-- Name: message message_thread_id_fkey; Type: FK CONSTRAINT; Schema: simple_imageboard; Owner: postgres
--

ALTER TABLE ONLY simple_imageboard.message
    ADD CONSTRAINT message_thread_id_fkey FOREIGN KEY (thread_id) REFERENCES simple_imageboard.thread(thread_id);


--
-- PostgreSQL database dump complete
--

