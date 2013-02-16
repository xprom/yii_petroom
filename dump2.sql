--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: postgres; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE postgres IS 'default administrative connection database';


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
-- Name: tbl_follow; Type: TABLE; Schema: public; Owner: petroom; Tablespace: 
--

CREATE TABLE tbl_follow (
    user_id bigint NOT NULL,
    friend_user_id bigint NOT NULL
);


ALTER TABLE public.tbl_follow OWNER TO petroom;

--
-- Name: tbl_friends; Type: TABLE; Schema: public; Owner: petroom; Tablespace: 
--

CREATE TABLE tbl_friends (
    user_id bigint NOT NULL,
    friend_user_id bigint NOT NULL,
    date_add timestamp without time zone,
    status bigint DEFAULT 1
);


ALTER TABLE public.tbl_friends OWNER TO petroom;

--
-- Name: COLUMN tbl_friends.status; Type: COMMENT; Schema: public; Owner: petroom
--

COMMENT ON COLUMN tbl_friends.status IS '1 новый друг
2 принятый в друзья';


--
-- Name: tbl_like; Type: TABLE; Schema: public; Owner: petroom; Tablespace: 
--

CREATE TABLE tbl_like (
    post_id bigint NOT NULL,
    user_id bigint NOT NULL
);


ALTER TABLE public.tbl_like OWNER TO petroom;

--
-- Name: tbl_photos; Type: TABLE; Schema: public; Owner: petroom; Tablespace: 
--

CREATE TABLE tbl_photos (
    id integer NOT NULL,
    folder_id bigint,
    image character varying(255),
    image_thumb character varying(255),
    image_50 character varying(255),
    image_31 character varying(255),
    user_id bigint,
    image_1024 character varying(255),
    image_145 character varying(255)
);


ALTER TABLE public.tbl_photos OWNER TO petroom;

--
-- Name: tbl_photos_folder_id_seq; Type: SEQUENCE; Schema: public; Owner: petroom
--

CREATE SEQUENCE tbl_photos_folder_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_photos_folder_id_seq OWNER TO petroom;

--
-- Name: tbl_photos_folder_id_seq; Type: SEQUENCE SET; Schema: public; Owner: petroom
--

SELECT pg_catalog.setval('tbl_photos_folder_id_seq', 3, true);


--
-- Name: tbl_photos_folder; Type: TABLE; Schema: public; Owner: petroom; Tablespace: 
--

CREATE TABLE tbl_photos_folder (
    id bigint DEFAULT nextval('tbl_photos_folder_id_seq'::regclass) NOT NULL,
    user_id bigint,
    title character varying(255),
    date timestamp without time zone,
    visible bigint
);


ALTER TABLE public.tbl_photos_folder OWNER TO petroom;

--
-- Name: tbl_photos_id_seq; Type: SEQUENCE; Schema: public; Owner: petroom
--

CREATE SEQUENCE tbl_photos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_photos_id_seq OWNER TO petroom;

--
-- Name: tbl_photos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: petroom
--

ALTER SEQUENCE tbl_photos_id_seq OWNED BY tbl_photos.id;


--
-- Name: tbl_photos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: petroom
--

SELECT pg_catalog.setval('tbl_photos_id_seq', 35, true);


--
-- Name: tbl_post; Type: TABLE; Schema: public; Owner: petroom; Tablespace: 
--

CREATE TABLE tbl_post (
    id integer NOT NULL,
    user_id bigint,
    date timestamp without time zone,
    text text,
    link character varying(500),
    parent_id integer,
    deleted smallint DEFAULT 0,
    map_x double precision,
    map_y double precision,
    zoom smallint,
    image integer
);


ALTER TABLE public.tbl_post OWNER TO petroom;

--
-- Name: tbl_post_id_seq; Type: SEQUENCE; Schema: public; Owner: petroom
--

CREATE SEQUENCE tbl_post_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_post_id_seq OWNER TO petroom;

--
-- Name: tbl_post_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: petroom
--

ALTER SEQUENCE tbl_post_id_seq OWNED BY tbl_post.id;


--
-- Name: tbl_post_id_seq; Type: SEQUENCE SET; Schema: public; Owner: petroom
--

SELECT pg_catalog.setval('tbl_post_id_seq', 135, true);


--
-- Name: tbl_post_link; Type: TABLE; Schema: public; Owner: petroom; Tablespace: 
--

CREATE TABLE tbl_post_link (
    id_post bigint NOT NULL,
    link character varying(500),
    title character varying(500),
    description character varying(500),
    image character varying(500)
);


ALTER TABLE public.tbl_post_link OWNER TO petroom;

--
-- Name: tbl_present; Type: TABLE; Schema: public; Owner: petroom; Tablespace: 
--

CREATE TABLE tbl_present (
    id integer NOT NULL,
    image character varying(255),
    image_short character varying(255)
);


ALTER TABLE public.tbl_present OWNER TO petroom;

--
-- Name: tbl_present_id_seq; Type: SEQUENCE; Schema: public; Owner: petroom
--

CREATE SEQUENCE tbl_present_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_present_id_seq OWNER TO petroom;

--
-- Name: tbl_present_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: petroom
--

ALTER SEQUENCE tbl_present_id_seq OWNED BY tbl_present.id;


--
-- Name: tbl_present_id_seq; Type: SEQUENCE SET; Schema: public; Owner: petroom
--

SELECT pg_catalog.setval('tbl_present_id_seq', 3, true);


--
-- Name: tbl_present_user; Type: TABLE; Schema: public; Owner: petroom; Tablespace: 
--

CREATE TABLE tbl_present_user (
    id integer NOT NULL,
    date timestamp without time zone,
    present_id integer,
    user_from_id integer,
    user_to_id integer,
    message character varying(500),
    is_view integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.tbl_present_user OWNER TO petroom;

--
-- Name: tbl_present_user_id_seq; Type: SEQUENCE; Schema: public; Owner: petroom
--

CREATE SEQUENCE tbl_present_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_present_user_id_seq OWNER TO petroom;

--
-- Name: tbl_present_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: petroom
--

ALTER SEQUENCE tbl_present_user_id_seq OWNED BY tbl_present_user.id;


--
-- Name: tbl_present_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: petroom
--

SELECT pg_catalog.setval('tbl_present_user_id_seq', 1, true);


--
-- Name: tbl_status; Type: TABLE; Schema: public; Owner: petroom; Tablespace: 
--

CREATE TABLE tbl_status (
    id integer NOT NULL,
    user_id integer,
    date timestamp without time zone,
    text character(255)
);


ALTER TABLE public.tbl_status OWNER TO petroom;

--
-- Name: tbl_status_id_seq; Type: SEQUENCE; Schema: public; Owner: petroom
--

CREATE SEQUENCE tbl_status_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_status_id_seq OWNER TO petroom;

--
-- Name: tbl_status_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: petroom
--

ALTER SEQUENCE tbl_status_id_seq OWNED BY tbl_status.id;


--
-- Name: tbl_status_id_seq; Type: SEQUENCE SET; Schema: public; Owner: petroom
--

SELECT pg_catalog.setval('tbl_status_id_seq', 9, true);


--
-- Name: tbl_user; Type: TABLE; Schema: public; Owner: petroom; Tablespace: 
--

CREATE TABLE tbl_user (
    id integer NOT NULL,
    name character(255),
    email character(255),
    password character(255),
    username character(255),
    timezone character(255),
    birthday date,
    site character(255),
    twitter character(255),
    facebook character(255),
    aim character(255),
    about text,
    sex numeric(1,0),
    image character varying(255),
    image_thumb character(255),
    image_50 character(255),
    image_31 character(255)
);


ALTER TABLE public.tbl_user OWNER TO petroom;

--
-- Name: tbl_user_id_seq; Type: SEQUENCE; Schema: public; Owner: petroom
--

CREATE SEQUENCE tbl_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_user_id_seq OWNER TO petroom;

--
-- Name: tbl_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: petroom
--

ALTER SEQUENCE tbl_user_id_seq OWNED BY tbl_user.id;


--
-- Name: tbl_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: petroom
--

SELECT pg_catalog.setval('tbl_user_id_seq', 4, true);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: petroom
--

ALTER TABLE tbl_photos ALTER COLUMN id SET DEFAULT nextval('tbl_photos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: petroom
--

ALTER TABLE tbl_post ALTER COLUMN id SET DEFAULT nextval('tbl_post_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: petroom
--

ALTER TABLE tbl_present ALTER COLUMN id SET DEFAULT nextval('tbl_present_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: petroom
--

ALTER TABLE tbl_present_user ALTER COLUMN id SET DEFAULT nextval('tbl_present_user_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: petroom
--

ALTER TABLE tbl_status ALTER COLUMN id SET DEFAULT nextval('tbl_status_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: petroom
--

ALTER TABLE tbl_user ALTER COLUMN id SET DEFAULT nextval('tbl_user_id_seq'::regclass);


--
-- Data for Name: tbl_follow; Type: TABLE DATA; Schema: public; Owner: petroom
--

COPY tbl_follow (user_id, friend_user_id) FROM stdin;
\.


--
-- Data for Name: tbl_friends; Type: TABLE DATA; Schema: public; Owner: petroom
--

COPY tbl_friends (user_id, friend_user_id, date_add, status) FROM stdin;
4	1	2013-01-08 23:58:25	2
\.


--
-- Data for Name: tbl_like; Type: TABLE DATA; Schema: public; Owner: petroom
--

COPY tbl_like (post_id, user_id) FROM stdin;
11	3
11	4
15	4
17	4
19	4
34	4
20	4
32	4
47	4
46	4
88	4
87	4
12	4
89	4
92	4
94	4
99	4
98	4
113	4
114	4
115	4
116	4
117	4
118	4
119	4
120	4
121	4
125	4
125	1
\.


--
-- Data for Name: tbl_photos; Type: TABLE DATA; Schema: public; Owner: petroom
--

COPY tbl_photos (id, folder_id, image, image_thumb, image_50, image_31, user_id, image_1024, image_145) FROM stdin;
30	1	big_dfcae1ed88182cc42a633080a28e64e0.jpg	thumb_dfcae1ed88182cc42a633080a28e64e0.jpg	50_dfcae1ed88182cc42a633080a28e64e0.jpg	31_dfcae1ed88182cc42a633080a28e64e0.jpg	4	1024_3e985091c4ca483bda005875f37a0654.jpg	145_dfcae1ed88182cc42a633080a28e64e0.jpg
31	1	big_b56404fd745f049e0f476f18bad512fb.jpg	thumb_b56404fd745f049e0f476f18bad512fb.jpg	50_b56404fd745f049e0f476f18bad512fb.jpg	31_b56404fd745f049e0f476f18bad512fb.jpg	4	1024_d7ea4b519a5d34d0eaf44230e1b48dbb.jpg	145_b56404fd745f049e0f476f18bad512fb.jpg
32	1	big_c15ba6a667132f98aa47399d68834f6f.jpg	thumb_c15ba6a667132f98aa47399d68834f6f.jpg	50_c15ba6a667132f98aa47399d68834f6f.jpg	31_c15ba6a667132f98aa47399d68834f6f.jpg	4	1024_8a55fa7309970653b2049d9b5dce4514.jpg	145_c15ba6a667132f98aa47399d68834f6f.jpg
33	1	big_79ade4dd30e295bdbd76646f594db844.jpg	thumb_79ade4dd30e295bdbd76646f594db844.jpg	50_79ade4dd30e295bdbd76646f594db844.jpg	31_79ade4dd30e295bdbd76646f594db844.jpg	4	1024_8a55fa7309970653b2049d9b5dce4514.jpg	145_79ade4dd30e295bdbd76646f594db844.jpg
34	1	big_bd28b6b8730be8da93fa5d02510a9831.jpg	thumb_bd28b6b8730be8da93fa5d02510a9831.jpg	50_bd28b6b8730be8da93fa5d02510a9831.jpg	31_bd28b6b8730be8da93fa5d02510a9831.jpg	4	1024_8a55fa7309970653b2049d9b5dce4514.jpg	145_bd28b6b8730be8da93fa5d02510a9831.jpg
35	1	big_a74859588cbc3d423808894d797aea30.jpg	thumb_a74859588cbc3d423808894d797aea30.jpg	50_a74859588cbc3d423808894d797aea30.jpg	31_a74859588cbc3d423808894d797aea30.jpg	4	1024_3139a426c5c6a78707f60ec03d9ba5a4.jpg	145_a74859588cbc3d423808894d797aea30.jpg
\.


--
-- Data for Name: tbl_photos_folder; Type: TABLE DATA; Schema: public; Owner: petroom
--

COPY tbl_photos_folder (id, user_id, title, date, visible) FROM stdin;
1	4	profile_photo	2013-01-30 18:01:46.167713	1
2	4	testes	2013-02-07 05:17:18	1
3	1	profile_photo	2013-02-11 04:29:15.150999	1
\.


--
-- Data for Name: tbl_post; Type: TABLE DATA; Schema: public; Owner: petroom
--

COPY tbl_post (id, user_id, date, text, link, parent_id, deleted, map_x, map_y, zoom, image) FROM stdin;
1	4	2013-01-11 05:40:28.447926	\N	\N	\N	0	\N	\N	\N	\N
2	4	2013-01-11 05:47:55.721967	ыа ыыв ыв ыв 	\N	\N	0	\N	\N	\N	\N
3	4	2013-01-11 05:47:58.081675	111111111111111111	\N	\N	0	\N	\N	\N	\N
4	4	2013-01-11 06:30:35.386005	ыываыва ыфа ыф фффф фаыаыыв\nыаыа\nываыва\n	\N	\N	0	\N	\N	\N	\N
5	4	2013-01-11 06:49:38.42739	sdfsdfsf	\N	\N	0	\N	\N	\N	\N
6	4	2013-01-11 07:46:32.135278	ygg	\N	\N	0	\N	\N	\N	\N
7	4	2013-01-11 07:49:44.541688	цукцукцук	\N	\N	0	\N	\N	\N	\N
8	4	2013-01-11 18:25:31.138436	dfdsf dsf sdf sd f	\N	\N	0	\N	\N	\N	\N
9	4	2013-01-11 18:25:36.806836	dfgdfg dfg dfg 	\N	\N	0	\N	\N	\N	\N
10	4	2013-01-11 18:26:47.277426	dfgdfgdfg	\N	\N	0	\N	\N	\N	\N
11	4	2013-01-13 19:06:34.15547	sdfsdfsdf\nsdf\nds	\N	\N	0	\N	\N	\N	\N
12	4	2013-01-13 19:20:23.570187	sdfsdfds fds sd sssdf\ndsfdsfs d sd fsa d s	\N	11	0	\N	\N	\N	\N
13	4	2013-01-13 19:20:35.779916	11111111111111111111111111111111111111111111	\N	11	0	\N	\N	\N	\N
14	4	2013-01-13 19:50:23.663441	sfsfsfsfsf	\N	\N	0	\N	\N	\N	\N
15	4	2013-01-13 22:39:33.843576	222222222222222222222222	\N	11	0	\N	\N	\N	\N
16	4	2013-01-15 05:11:12.817563	вапва пва ва	\N	14	0	\N	\N	\N	\N
17	4	2013-01-15 05:16:24.170663	вапвапвап	\N	\N	0	\N	\N	\N	\N
18	4	2013-01-15 05:33:22.020923	cxvxcvxcvcx	\N	11	0	\N	\N	\N	\N
19	4	2013-01-15 05:59:16.467539	dgdfgdfg	\N	\N	0	\N	\N	\N	\N
20	4	2013-01-15 08:17:50.16809	авпавпапап\nвап\nавп	\N	\N	0	\N	\N	\N	\N
21	4	2013-01-15 19:10:17.422427	sdfsd fsd s	\N	11	0	\N	\N	\N	\N
22	4	2013-01-15 19:10:19.180223	sdf sd s	\N	11	0	\N	\N	\N	\N
23	4	2013-01-15 19:10:21.011031	sd s sd	\N	11	0	\N	\N	\N	\N
24	4	2013-01-15 19:10:23.298977	sd s s sd	\N	11	0	\N	\N	\N	\N
25	4	2013-01-15 19:10:25.929961	dfg df df fd	\N	11	0	\N	\N	\N	\N
26	4	2013-01-15 19:11:24.104679	sdfsd fs	\N	11	0	\N	\N	\N	\N
27	4	2013-01-15 19:11:25.730076	s fs sd	\N	11	0	\N	\N	\N	\N
28	4	2013-01-15 19:11:28.299648	435345435 43	\N	11	0	\N	\N	\N	\N
29	4	2013-01-15 19:11:31.259468	43 43 43 5	\N	11	0	\N	\N	\N	\N
30	4	2013-01-15 19:11:34.0579	gf hfg fg h h	\N	11	0	\N	\N	\N	\N
31	4	2013-01-15 19:11:36.603787	fg hfg fg fg	\N	11	0	\N	\N	\N	\N
40	4	2013-01-17 04:40:17.074157	dfgdfg df df  df	\N	39	0	\N	\N	\N	\N
41	4	2013-01-17 04:42:10.589364	dsfsdfsdf	\N	39	0	\N	\N	\N	\N
42	4	2013-01-17 04:48:28.952574	чссч	\N	39	0	\N	\N	\N	\N
43	4	2013-01-17 06:59:48.442423	fsdfdsf	\N	39	0	\N	\N	\N	\N
45	4	2013-01-17 07:24:30.893019	fghfh	\N	\N	1	\N	\N	\N	\N
44	4	2013-01-17 07:23:41.250364	dfgdfg	\N	\N	1	\N	\N	\N	\N
39	4	2013-01-17 04:38:35.944459	fghffhfgh	\N	\N	1	\N	\N	\N	\N
38	4	2013-01-17 03:19:55.375943	dfgdfg df gfd \n	\N	\N	1	\N	\N	\N	\N
37	4	2013-01-16 22:13:59.25775	dfgdfg dd f	\N	\N	1	\N	\N	\N	\N
36	4	2013-01-16 22:13:43.364719	sdfsfsdfsdf	\N	\N	1	\N	\N	\N	\N
35	4	2013-01-16 22:08:34.98805	fdgdfg	\N	\N	1	\N	\N	\N	\N
34	4	2013-01-16 22:06:56.530452	fhfh	\N	\N	1	\N	\N	\N	\N
33	4	2013-01-16 21:38:08.815254	dfgdfg	\N	\N	1	\N	\N	\N	\N
93	4	2013-02-04 02:49:53.825638	safsfs       	\N	\N	1	\N	\N	\N	\N
32	4	2013-01-16 20:02:12.146449	sdfdsfsdf	\N	\N	0	\N	\N	\N	\N
46	4	2013-01-21 17:59:44.757763	sffsdf	\N	\N	0	\N	\N	\N	\N
47	4	2013-01-21 18:06:31.774189	111111111111	\N	\N	0	47.3673470000000023	8.55000199999989974	15	\N
48	4	2013-01-22 03:26:35.546653		\N	\N	0	55.3555115999999998	86.0867317000000014	16	\N
49	4	2013-01-22 03:32:39.224629	fg d fd df df 	\N	\N	0	47.3613274255979988	8.53697776794430041	15	\N
50	4	2013-01-22 03:32:48.992921	ddfsg dfs dsf	\N	\N	0	\N	\N	\N	\N
51	4	2013-01-24 05:14:00.4421	sf s fs fs fs s 	\N	\N	0	\N	\N	\N	\N
52	4	2013-01-24 05:14:07.482012	111111111111111	\N	\N	0	\N	\N	\N	\N
53	4	2013-01-24 05:20:39.241966	Teile hier etwas	\N	\N	0	\N	\N	\N	\N
54	4	2013-01-24 05:36:44.160121	Teile hier etwas	\N	\N	0	\N	\N	\N	\N
55	4	2013-01-25 04:48:02.435231	Teile hier etwas	\N	\N	0	\N	\N	\N	\N
56	4	2013-01-25 04:50:52.165372	Teile hier etwas	\N	\N	0	\N	\N	\N	\N
57	4	2013-01-25 05:04:33.644238	Teile hier etwas	\N	\N	0	\N	\N	\N	\N
58	4	2013-01-25 05:04:58.882837	Teile hier etwas	\N	\N	0	\N	\N	\N	\N
59	4	2013-01-25 05:05:08.925124	Teile hier etwas	\N	\N	0	\N	\N	\N	\N
60	4	2013-01-25 05:10:00.622427	Teile hier etwas	\N	\N	0	\N	\N	\N	\N
61	4	2013-01-25 05:10:09.761116	Teile hier etwas	\N	\N	0	\N	\N	\N	\N
62	4	2013-01-25 05:11:17.355202	Teile hier etwas	\N	\N	0	\N	\N	\N	\N
63	4	2013-01-25 05:11:33.669938	Teile hier etwas	\N	\N	0	\N	\N	\N	\N
64	4	2013-01-25 05:11:46.696507	Teile hier etwas	\N	\N	0	\N	\N	\N	\N
65	4	2013-01-25 05:12:13.179986	Teile hier etwas	\N	\N	0	\N	\N	\N	\N
66	4	2013-01-25 05:12:28.416507	Teile hier etwas	\N	\N	0	\N	\N	\N	\N
67	4	2013-01-25 05:15:53.60235		\N	\N	0	\N	\N	\N	\N
68	4	2013-01-25 05:15:59.495982		\N	\N	0	\N	\N	\N	\N
69	4	2013-01-25 05:16:12.556876		\N	\N	0	\N	\N	\N	\N
70	4	2013-01-25 05:18:51.588232	f gdf gfd sd 	\N	\N	0	47.3673470000000023	8.55000199999989974	15	\N
71	4	2013-01-25 05:23:36.965215	1111111111111	\N	\N	0	\N	\N	\N	\N
72	4	2013-01-25 05:45:58.755258	Teile hier etwas	\N	\N	0	\N	\N	\N	\N
73	4	2013-01-25 13:10:47.01966	Teile hier etwas	\N	\N	0	\N	\N	\N	\N
74	4	2013-01-30 23:57:55.999731		\N	\N	0	\N	\N	\N	\N
75	4	2013-01-31 03:41:29.778394		\N	\N	0	\N	\N	\N	\N
76	4	2013-01-31 04:07:49.131635		\N	\N	0	\N	\N	\N	8
77	4	2013-01-31 18:16:32.185093		\N	\N	0	\N	\N	\N	9
78	4	2013-01-31 18:21:16.623545		\N	\N	0	\N	\N	\N	10
79	4	2013-01-31 18:24:19.695542		\N	\N	0	\N	\N	\N	11
80	4	2013-01-31 18:24:42.620016		\N	\N	0	\N	\N	\N	12
81	4	2013-01-31 18:26:18.665808		\N	\N	0	\N	\N	\N	13
82	4	2013-01-31 18:26:52.815218		\N	\N	0	\N	\N	\N	14
83	4	2013-01-31 18:31:33.977605		\N	\N	0	\N	\N	\N	15
84	4	2013-01-31 18:31:44.894208		\N	\N	0	\N	\N	\N	16
85	4	2013-02-01 13:08:21.569237		\N	\N	0	\N	\N	\N	17
86	4	2013-02-01 13:13:00.086494		\N	\N	0	\N	\N	\N	18
87	4	2013-02-01 13:14:16.534145		\N	\N	0	\N	\N	\N	19
88	4	2013-02-01 13:15:51.091958		\N	\N	0	\N	\N	\N	20
91	4	2013-02-03 23:43:42.798575	22222222	\N	89	0	\N	\N	\N	\N
94	4	2013-02-04 02:50:51.461802	22222222222222222231123123 12	\N	89	1	\N	\N	\N	\N
90	4	2013-02-03 23:43:40.105408	fs s fs s fs	\N	89	0	\N	\N	\N	\N
92	4	2013-02-04 02:19:52.077797	ыфафы ы ы ы ыф	\N	89	1	\N	\N	\N	\N
89	4	2013-02-01 13:16:23.747084		\N	\N	1	\N	\N	\N	21
95	4	2013-02-04 03:22:06.819322	11111	\N	88	0	\N	\N	\N	\N
96	4	2013-02-04 03:22:09.030051	22222222	\N	88	0	\N	\N	\N	\N
97	4	2013-02-04 03:22:11.443658	33333333333	\N	88	0	\N	\N	\N	\N
98	4	2013-02-04 03:22:13.833268	4444444444	\N	88	0	\N	\N	\N	\N
103	4	2013-02-04 03:22:25.197789	999999999999	\N	88	1	\N	\N	\N	\N
102	4	2013-02-04 03:22:23.326514	88888888888888	\N	88	1	\N	\N	\N	\N
101	4	2013-02-04 03:22:20.812417	77777777777777	\N	88	1	\N	\N	\N	\N
100	4	2013-02-04 03:22:18.019156	66666666666	\N	88	1	\N	\N	\N	\N
104	4	2013-02-04 04:08:31.861588	вапвап	\N	88	1	\N	\N	\N	\N
99	4	2013-02-04 03:22:16.148915	55555555555	\N	88	1	\N	\N	\N	\N
105	4	2013-02-04 04:58:14.514179	9999999999999999999	\N	88	0	\N	\N	\N	\N
106	4	2013-02-04 04:58:45.959323	1	\N	88	0	\N	\N	\N	\N
107	4	2013-02-04 04:59:23.278324	2	\N	88	0	\N	\N	\N	\N
108	4	2013-02-04 05:10:27.164576	3	\N	88	0	\N	\N	\N	\N
109	4	2013-02-04 05:27:40.643495	ццук цу	\N	88	0	\N	\N	\N	\N
110	4	2013-02-04 05:28:13.905684	5	\N	88	0	\N	\N	\N	\N
111	4	2013-02-04 06:27:58.620557	1	\N	88	0	\N	\N	\N	\N
112	4	2013-02-04 06:29:23.306436	2	\N	88	0	\N	\N	\N	\N
113	4	2013-02-04 06:31:47.67122	3	\N	88	0	\N	\N	\N	\N
114	4	2013-02-04 12:22:19.75679	112323	\N	88	0	\N	\N	\N	\N
115	4	2013-02-04 12:22:57.173862	111	\N	88	0	\N	\N	\N	\N
116	4	2013-02-04 12:25:39.150848	3	\N	88	0	\N	\N	\N	\N
117	4	2013-02-04 12:26:01.11153	4	\N	88	0	\N	\N	\N	\N
118	4	2013-02-04 12:54:00.821343	5	\N	88	0	\N	\N	\N	\N
119	4	2013-02-04 12:55:26.027157	4	\N	88	0	\N	\N	\N	\N
120	4	2013-02-04 12:55:42.645055	55	\N	88	0	\N	\N	\N	\N
121	4	2013-02-05 05:32:50.028387	dsfg 	\N	\N	0	\N	\N	\N	\N
122	\N	2013-02-11 04:29:15.297967		\N	\N	0	\N	\N	\N	22
123	\N	2013-02-11 04:41:15.964474		\N	\N	0	\N	\N	\N	23
124	\N	2013-02-11 05:53:11.175513		\N	\N	0	\N	\N	\N	24
125	1	2013-02-11 05:55:36.56599		\N	\N	0	\N	\N	\N	25
126	4	2013-02-16 21:02:01.630462		\N	\N	0	\N	\N	\N	26
127	4	2013-02-17 00:06:40.052032		\N	\N	0	\N	\N	\N	27
128	4	2013-02-17 00:13:31.119223		\N	\N	0	\N	\N	\N	28
129	4	2013-02-17 00:14:04.846894		\N	\N	0	\N	\N	\N	29
130	4	2013-02-17 00:15:40.666404		\N	\N	0	\N	\N	\N	30
131	4	2013-02-17 00:18:19.690438		\N	\N	0	\N	\N	\N	31
132	4	2013-02-17 00:18:51.918309		\N	\N	0	\N	\N	\N	32
133	4	2013-02-17 00:23:18.650948		\N	\N	0	\N	\N	\N	33
134	4	2013-02-17 00:23:42.961787		\N	\N	0	\N	\N	\N	34
135	4	2013-02-17 00:23:59.794984		\N	\N	0	\N	\N	\N	35
\.


--
-- Data for Name: tbl_post_link; Type: TABLE DATA; Schema: public; Owner: petroom
--

COPY tbl_post_link (id_post, link, title, description, image) FROM stdin;
66	http://habrahabr.ru	Лучшие за сутки / Посты / Хабрахабр	Хабрахабр – самое крупное в Рунете сообщество людей, занятых в индустрии высоких технологий. Уникальная аудитория, свежая информация, конструктивное общение и коллективное творчество – всё это делает Хабрахабр самым оригинальным IT-проектом в России.	http://habrahabr.ru/i/habralogo.jpg
67	http://habrahabr.ru	Лучшие за сутки / Посты / Хабрахабр	Хабрахабр – самое крупное в Рунете сообщество людей, занятых в индустрии высоких технологий. Уникальная аудитория, свежая информация, конструктивное общение и коллективное творчество – всё это делает Хабрахабр самым оригинальным IT-проектом в России.	http://habrahabr.ru/i/habralogo.jpg
68	http://habrahabr.ru	Лучшие за сутки / Посты / Хабрахабр	Хабрахабр – самое крупное в Рунете сообщество людей, занятых в индустрии высоких технологий. Уникальная аудитория, свежая информация, конструктивное общение и коллективное творчество – всё это делает Хабрахабр самым оригинальным IT-проектом в России.	http://habrahabr.ru/i/habralogo.jpg
69	http://habrahabr.ru	Лучшие за сутки / Посты / Хабрахабр	Хабрахабр – самое крупное в Рунете сообщество людей, занятых в индустрии высоких технологий. Уникальная аудитория, свежая информация, конструктивное общение и коллективное творчество – всё это делает Хабрахабр самым оригинальным IT-проектом в России.	http://habrahabr.ru/i/habralogo.jpg
71	http://habrahabr.ru	Лучшие за сутки / Посты / Хабрахабр	Хабрахабр – самое крупное в Рунете сообщество людей, занятых в индустрии высоких технологий. Уникальная аудитория, свежая информация, конструктивное общение и коллективное творчество – всё это делает Хабрахабр самым оригинальным IT-проектом в России.	http://habrahabr.ru/i/habralogo.jpg
72	http://habrahabr.ru	Лучшие за сутки / Посты / Хабрахабр	Хабрахабр – самое крупное в Рунете сообщество людей, занятых в индустрии высоких технологий. Уникальная аудитория, свежая информация, конструктивное общение и коллективное творчество – всё это делает Хабрахабр самым оригинальным IT-проектом в России.	http://habrahabr.ru/i/habralogo.jpg
73	http://habrahabr.ru	Лучшие за сутки / Посты / Хабрахабр	Хабрахабр – самое крупное в Рунете сообщество людей, занятых в индустрии высоких технологий. Уникальная аудитория, свежая информация, конструктивное общение и коллективное творчество – всё это делает Хабрахабр самым оригинальным IT-проектом в России.	http://habrahabr.ru/i/habralogo.jpg
\.


--
-- Data for Name: tbl_present; Type: TABLE DATA; Schema: public; Owner: petroom
--

COPY tbl_present (id, image, image_short) FROM stdin;
1	present.png	\N
2	present.png	\N
3	present.png	\N
\.


--
-- Data for Name: tbl_present_user; Type: TABLE DATA; Schema: public; Owner: petroom
--

COPY tbl_present_user (id, date, present_id, user_from_id, user_to_id, message, is_view) FROM stdin;
1	2013-02-07 03:30:54	1	3	4	gdf ds gdf 	0
\.


--
-- Data for Name: tbl_status; Type: TABLE DATA; Schema: public; Owner: petroom
--

COPY tbl_status (id, user_id, date, text) FROM stdin;
2	4	2013-01-09 08:17:59.847088	safsdfsaf sd fsd sd                                                                                                                                                                                                                                            
3	4	2013-01-09 08:18:04.249575	safsdfsaf sd fsd sd s s fds sd sd                                                                                                                                                                                                                              
4	4	2013-01-09 08:18:39.343982	safsdfsaf sd fsd sd s s fds sd sd                                                                                                                                                                                                                              
5	4	2013-01-09 08:18:44.788575	safsdfsaf sd fsd sd s s fds sd sd sdfdsddfsddsf                                                                                                                                                                                                                
6	4	2013-01-10 00:52:19.684941	safsdfsaf sd fsd sd s s fds sd sd sdfdsddfsddsf                                                                                                                                                                                                                
7	4	2013-01-15 19:09:55.103301	dfdsf dsfsdd                                                                                                                                                                                                                                                   
8	4	2013-01-16 17:36:29.682372	fggff f f f                                                                                                                                                                                                                                                    
9	4	2013-01-18 05:50:53.504307	fggff f f f                                                                                                                                                                                                                                                    
\.


--
-- Data for Name: tbl_user; Type: TABLE DATA; Schema: public; Owner: petroom
--

COPY tbl_user (id, name, email, password, username, timezone, birthday, site, twitter, facebook, aim, about, sex, image, image_thumb, image_50, image_31) FROM stdin;
1	VPuh                                                                                                                                                                                                                                                           	test@mail.ru                                                                                                                                                                                                                                                   	123456                                                                                                                                                                                                                                                         	ktkt                                                                                                                                                                                                                                                           	US/Pacific                                                                                                                                                                                                                                                     	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	31_9bb31ec147894df56d89d201ee1a6c29.jpg                                                                                                                                                                                                                        
3	Tomas                                                                                                                                                                                                                                                          	testwer@sdfdsf.ru                                                                                                                                                                                                                                              	123456                                                                                                                                                                                                                                                         	dsfsdfdf                                                                                                                                                                                                                                                       	US/Pacific                                                                                                                                                                                                                                                     	\N	\N	\N	\N	\N	\N	\N	big_66db764bfda473b8c73f01361f535ffe.jpg	thumb_20cc02937dd8f187bae09ba3391926fa.jpg                                                                                                                                                                                                                     	50_c90e56c780cc0328b82884e0249d81a7.jpg                                                                                                                                                                                                                        	31_9bb31ec147894df56d89d201ee1a6c29.jpg                                                                                                                                                                                                                        
2	Bingo                                                                                                                                                                                                                                                          	sd@sfsdf.ru                                                                                                                                                                                                                                                    	123456                                                                                                                                                                                                                                                         	dsfsdf                                                                                                                                                                                                                                                         	US/Pacific                                                                                                                                                                                                                                                     	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	31_9bb31ec147894df56d89d201ee1a6c29.jpg                                                                                                                                                                                                                        
4	Marly                                                                                                                                                                                                                                                          	test2@mail.ru                                                                                                                                                                                                                                                  	123456                                                                                                                                                                                                                                                         	dsfsdfsdf                                                                                                                                                                                                                                                      	US/Pacific                                                                                                                                                                                                                                                     	2013-01-02	                                                                                                                                                                                                                                                               	                                                                                                                                                                                                                                                               	                                                                                                                                                                                                                                                               	                                                                                                                                                                                                                                                               		2	big_b36d26cb566757024c7200f372f81a29.jpg	thumb_b36d26cb566757024c7200f372f81a29.jpg                                                                                                                                                                                                                     	50_c90e56c780cc0328b82884e0249d81a7.jpg                                                                                                                                                                                                                        	31_b36d26cb566757024c7200f372f81a29.jpg                                                                                                                                                                                                                        
\.


--
-- Name: PK_USER; Type: CONSTRAINT; Schema: public; Owner: petroom; Tablespace: 
--

ALTER TABLE ONLY tbl_user
    ADD CONSTRAINT "PK_USER" UNIQUE (id);


--
-- Name: tbl_follow_pkey; Type: CONSTRAINT; Schema: public; Owner: petroom; Tablespace: 
--

ALTER TABLE ONLY tbl_follow
    ADD CONSTRAINT tbl_follow_pkey PRIMARY KEY (user_id, friend_user_id);


--
-- Name: tbl_friends_pkey; Type: CONSTRAINT; Schema: public; Owner: petroom; Tablespace: 
--

ALTER TABLE ONLY tbl_friends
    ADD CONSTRAINT tbl_friends_pkey PRIMARY KEY (user_id, friend_user_id);


--
-- Name: tbl_like_pkey; Type: CONSTRAINT; Schema: public; Owner: petroom; Tablespace: 
--

ALTER TABLE ONLY tbl_like
    ADD CONSTRAINT tbl_like_pkey PRIMARY KEY (post_id, user_id);


--
-- Name: tbl_photos_folder_pkey; Type: CONSTRAINT; Schema: public; Owner: petroom; Tablespace: 
--

ALTER TABLE ONLY tbl_photos_folder
    ADD CONSTRAINT tbl_photos_folder_pkey PRIMARY KEY (id);


--
-- Name: tbl_photos_pkey; Type: CONSTRAINT; Schema: public; Owner: petroom; Tablespace: 
--

ALTER TABLE ONLY tbl_photos
    ADD CONSTRAINT tbl_photos_pkey PRIMARY KEY (id);


--
-- Name: tbl_post_link_pkey; Type: CONSTRAINT; Schema: public; Owner: petroom; Tablespace: 
--

ALTER TABLE ONLY tbl_post_link
    ADD CONSTRAINT tbl_post_link_pkey PRIMARY KEY (id_post);


--
-- Name: tbl_post_pkey; Type: CONSTRAINT; Schema: public; Owner: petroom; Tablespace: 
--

ALTER TABLE ONLY tbl_post
    ADD CONSTRAINT tbl_post_pkey PRIMARY KEY (id);


--
-- Name: tbl_present_pkey; Type: CONSTRAINT; Schema: public; Owner: petroom; Tablespace: 
--

ALTER TABLE ONLY tbl_present
    ADD CONSTRAINT tbl_present_pkey PRIMARY KEY (id);


--
-- Name: tbl_present_user_pkey; Type: CONSTRAINT; Schema: public; Owner: petroom; Tablespace: 
--

ALTER TABLE ONLY tbl_present_user
    ADD CONSTRAINT tbl_present_user_pkey PRIMARY KEY (id);


--
-- Name: tbl_status_pkey; Type: CONSTRAINT; Schema: public; Owner: petroom; Tablespace: 
--

ALTER TABLE ONLY tbl_status
    ADD CONSTRAINT tbl_status_pkey PRIMARY KEY (id);


--
-- Name: tbl_user_pkey; Type: CONSTRAINT; Schema: public; Owner: petroom; Tablespace: 
--

ALTER TABLE ONLY tbl_user
    ADD CONSTRAINT tbl_user_pkey PRIMARY KEY (id);


--
-- Name: IND_USER; Type: INDEX; Schema: public; Owner: petroom; Tablespace: 
--

CREATE UNIQUE INDEX "IND_USER" ON tbl_user USING btree (id);


--
-- Name: FK_FRIEND_USER_DI; Type: FK CONSTRAINT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_friends
    ADD CONSTRAINT "FK_FRIEND_USER_DI" FOREIGN KEY (friend_user_id) REFERENCES tbl_user(id) ON DELETE CASCADE;


--
-- Name: FK_LIKE_POST; Type: FK CONSTRAINT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_like
    ADD CONSTRAINT "FK_LIKE_POST" FOREIGN KEY (post_id) REFERENCES tbl_post(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: FK_LIKE_USER_ID; Type: FK CONSTRAINT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_like
    ADD CONSTRAINT "FK_LIKE_USER_ID" FOREIGN KEY (user_id) REFERENCES tbl_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: FK_PHOTO$USER_ID; Type: FK CONSTRAINT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_photos
    ADD CONSTRAINT "FK_PHOTO$USER_ID" FOREIGN KEY (user_id) REFERENCES tbl_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: FK_PHOTOS_FOLDER; Type: FK CONSTRAINT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_photos
    ADD CONSTRAINT "FK_PHOTOS_FOLDER" FOREIGN KEY (folder_id) REFERENCES tbl_photos_folder(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: FK_PHOTOS_USER_ID; Type: FK CONSTRAINT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_photos_folder
    ADD CONSTRAINT "FK_PHOTOS_USER_ID" FOREIGN KEY (user_id) REFERENCES tbl_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: FK_POST_LINK$POST_ID; Type: FK CONSTRAINT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_post_link
    ADD CONSTRAINT "FK_POST_LINK$POST_ID" FOREIGN KEY (id_post) REFERENCES tbl_post(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: FK_POST_PARENT_ID; Type: FK CONSTRAINT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_post
    ADD CONSTRAINT "FK_POST_PARENT_ID" FOREIGN KEY (parent_id) REFERENCES tbl_post(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: FK_POST_USER_ID; Type: FK CONSTRAINT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_post
    ADD CONSTRAINT "FK_POST_USER_ID" FOREIGN KEY (user_id) REFERENCES tbl_user(id) ON DELETE CASCADE;


--
-- Name: FK_PRESENT_USER$FROM_ID; Type: FK CONSTRAINT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_present_user
    ADD CONSTRAINT "FK_PRESENT_USER$FROM_ID" FOREIGN KEY (user_from_id) REFERENCES tbl_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: CONSTRAINT "FK_PRESENT_USER$FROM_ID" ON tbl_present_user; Type: COMMENT; Schema: public; Owner: petroom
--

COMMENT ON CONSTRAINT "FK_PRESENT_USER$FROM_ID" ON tbl_present_user IS 'USE';


--
-- Name: FK_PRESENT_USER$PRESENT_ID; Type: FK CONSTRAINT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_present_user
    ADD CONSTRAINT "FK_PRESENT_USER$PRESENT_ID" FOREIGN KEY (present_id) REFERENCES tbl_present(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: FK_PRESENT_USER$TO_ID; Type: FK CONSTRAINT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_present_user
    ADD CONSTRAINT "FK_PRESENT_USER$TO_ID" FOREIGN KEY (user_to_id) REFERENCES tbl_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: FK_USER_ID; Type: FK CONSTRAINT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_status
    ADD CONSTRAINT "FK_USER_ID" FOREIGN KEY (user_id) REFERENCES tbl_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: FK_USER_ID; Type: FK CONSTRAINT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_friends
    ADD CONSTRAINT "FK_USER_ID" FOREIGN KEY (user_id) REFERENCES tbl_user(id) ON DELETE CASCADE;


--
-- Name: tbl_follow_friend_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_follow
    ADD CONSTRAINT tbl_follow_friend_user_id_fkey FOREIGN KEY (friend_user_id) REFERENCES tbl_user(id) ON DELETE CASCADE;


--
-- Name: tbl_follow_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_follow
    ADD CONSTRAINT tbl_follow_user_id_fkey FOREIGN KEY (user_id) REFERENCES tbl_user(id) ON DELETE CASCADE;


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

