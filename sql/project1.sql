
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
    user_email integer NOT NULL,
    message_date integer NOT NULL,
    thread_id integer NOT NULL
);


ALTER TABLE simple_imageboard.message OWNER TO postgres;

--
-- Name: message_message_date_seq; Type: SEQUENCE; Schema: simple_imageboard; Owner: postgres
--

CREATE SEQUENCE simple_imageboard.message_message_date_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE simple_imageboard.message_message_date_seq OWNER TO postgres;

--
-- Name: message_message_date_seq; Type: SEQUENCE OWNED BY; Schema: simple_imageboard; Owner: postgres
--

ALTER SEQUENCE simple_imageboard.message_message_date_seq OWNED BY simple_imageboard.message.message_date;


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
-- Name: message_user_email_seq; Type: SEQUENCE; Schema: simple_imageboard; Owner: postgres
--

CREATE SEQUENCE simple_imageboard.message_user_email_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE simple_imageboard.message_user_email_seq OWNER TO postgres;

--
-- Name: message_user_email_seq; Type: SEQUENCE OWNED BY; Schema: simple_imageboard; Owner: postgres
--

ALTER SEQUENCE simple_imageboard.message_user_email_seq OWNED BY simple_imageboard.message.user_email;


--
-- Name: thread; Type: TABLE; Schema: simple_imageboard; Owner: postgres
--

CREATE TABLE simple_imageboard.thread (
    thread_id integer NOT NULL,
    thread_title text NOT NULL,
    thread_date date NOT NULL,
    user_email integer NOT NULL
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
-- Name: message user_email; Type: DEFAULT; Schema: simple_imageboard; Owner: postgres
--

ALTER TABLE ONLY simple_imageboard.message ALTER COLUMN user_email SET DEFAULT nextval('simple_imageboard.message_user_email_seq'::regclass);


--
-- Name: message message_date; Type: DEFAULT; Schema: simple_imageboard; Owner: postgres
--

ALTER TABLE ONLY simple_imageboard.message ALTER COLUMN message_date SET DEFAULT nextval('simple_imageboard.message_message_date_seq'::regclass);


--
-- Name: thread thread_id; Type: DEFAULT; Schema: simple_imageboard; Owner: postgres
--

ALTER TABLE ONLY simple_imageboard.thread ALTER COLUMN thread_id SET DEFAULT nextval('simple_imageboard.thread_thread_id_seq'::regclass);


--
-- Name: thread user_email; Type: DEFAULT; Schema: simple_imageboard; Owner: postgres
--

ALTER TABLE ONLY simple_imageboard.thread ALTER COLUMN user_email SET DEFAULT nextval('simple_imageboard.thread_user_email_seq'::regclass);


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