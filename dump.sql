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
    thumb character varying(255),
    image character varying(255)
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

SELECT pg_catalog.setval('tbl_photos_folder_id_seq', 1, false);


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

SELECT pg_catalog.setval('tbl_photos_id_seq', 1, false);


--
-- Name: tbl_post; Type: TABLE; Schema: public; Owner: petroom; Tablespace: 
--

CREATE TABLE tbl_post (
    id integer NOT NULL,
    user_id bigint,
    date timestamp without time zone,
    text text,
    link character varying(500),
    image character varying(500),
    parent_id integer,
    deleted smallint DEFAULT 0
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

SELECT pg_catalog.setval('tbl_post_id_seq', 45, true);


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

SELECT pg_catalog.setval('tbl_status_id_seq', 8, true);


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

ALTER TABLE ONLY tbl_photos ALTER COLUMN id SET DEFAULT nextval('tbl_photos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_post ALTER COLUMN id SET DEFAULT nextval('tbl_post_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_status ALTER COLUMN id SET DEFAULT nextval('tbl_status_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_user ALTER COLUMN id SET DEFAULT nextval('tbl_user_id_seq'::regclass);


--
-- Data for Name: tbl_follow; Type: TABLE DATA; Schema: public; Owner: petroom
--



--
-- Data for Name: tbl_friends; Type: TABLE DATA; Schema: public; Owner: petroom
--

INSERT INTO tbl_friends VALUES (4, 1, '2013-01-08 23:58:25', 2);


--
-- Data for Name: tbl_like; Type: TABLE DATA; Schema: public; Owner: petroom
--

INSERT INTO tbl_like VALUES (11, 3);
INSERT INTO tbl_like VALUES (11, 4);
INSERT INTO tbl_like VALUES (15, 4);
INSERT INTO tbl_like VALUES (17, 4);
INSERT INTO tbl_like VALUES (19, 4);
INSERT INTO tbl_like VALUES (34, 4);
INSERT INTO tbl_like VALUES (20, 4);


--
-- Data for Name: tbl_photos; Type: TABLE DATA; Schema: public; Owner: petroom
--



--
-- Data for Name: tbl_photos_folder; Type: TABLE DATA; Schema: public; Owner: petroom
--



--
-- Data for Name: tbl_post; Type: TABLE DATA; Schema: public; Owner: petroom
--

INSERT INTO tbl_post VALUES (1, 4, '2013-01-11 05:40:28.447926', NULL, NULL, NULL, NULL, 0);
INSERT INTO tbl_post VALUES (2, 4, '2013-01-11 05:47:55.721967', 'ыа ыыв ыв ыв ', NULL, NULL, NULL, 0);
INSERT INTO tbl_post VALUES (3, 4, '2013-01-11 05:47:58.081675', '111111111111111111', NULL, NULL, NULL, 0);
INSERT INTO tbl_post VALUES (4, 4, '2013-01-11 06:30:35.386005', 'ыываыва ыфа ыф фффф фаыаыыв
ыаыа
ываыва
', NULL, NULL, NULL, 0);
INSERT INTO tbl_post VALUES (5, 4, '2013-01-11 06:49:38.42739', 'sdfsdfsf', NULL, NULL, NULL, 0);
INSERT INTO tbl_post VALUES (6, 4, '2013-01-11 07:46:32.135278', 'ygg', NULL, NULL, NULL, 0);
INSERT INTO tbl_post VALUES (7, 4, '2013-01-11 07:49:44.541688', 'цукцукцук', NULL, NULL, NULL, 0);
INSERT INTO tbl_post VALUES (8, 4, '2013-01-11 18:25:31.138436', 'dfdsf dsf sdf sd f', NULL, NULL, NULL, 0);
INSERT INTO tbl_post VALUES (9, 4, '2013-01-11 18:25:36.806836', 'dfgdfg dfg dfg ', NULL, NULL, NULL, 0);
INSERT INTO tbl_post VALUES (10, 4, '2013-01-11 18:26:47.277426', 'dfgdfgdfg', NULL, NULL, NULL, 0);
INSERT INTO tbl_post VALUES (11, 4, '2013-01-13 19:06:34.15547', 'sdfsdfsdf
sdf
ds', NULL, NULL, NULL, 0);
INSERT INTO tbl_post VALUES (12, 4, '2013-01-13 19:20:23.570187', 'sdfsdfds fds sd sssdf
dsfdsfs d sd fsa d s', NULL, NULL, 11, 0);
INSERT INTO tbl_post VALUES (13, 4, '2013-01-13 19:20:35.779916', '11111111111111111111111111111111111111111111', NULL, NULL, 11, 0);
INSERT INTO tbl_post VALUES (14, 4, '2013-01-13 19:50:23.663441', 'sfsfsfsfsf', NULL, NULL, NULL, 0);
INSERT INTO tbl_post VALUES (15, 4, '2013-01-13 22:39:33.843576', '222222222222222222222222', NULL, NULL, 11, 0);
INSERT INTO tbl_post VALUES (16, 4, '2013-01-15 05:11:12.817563', 'вапва пва ва', NULL, NULL, 14, 0);
INSERT INTO tbl_post VALUES (17, 4, '2013-01-15 05:16:24.170663', 'вапвапвап', NULL, NULL, NULL, 0);
INSERT INTO tbl_post VALUES (18, 4, '2013-01-15 05:33:22.020923', 'cxvxcvxcvcx', NULL, NULL, 11, 0);
INSERT INTO tbl_post VALUES (19, 4, '2013-01-15 05:59:16.467539', 'dgdfgdfg', NULL, NULL, NULL, 0);
INSERT INTO tbl_post VALUES (20, 4, '2013-01-15 08:17:50.16809', 'авпавпапап
вап
авп', NULL, NULL, NULL, 0);
INSERT INTO tbl_post VALUES (21, 4, '2013-01-15 19:10:17.422427', 'sdfsd fsd s', NULL, NULL, 11, 0);
INSERT INTO tbl_post VALUES (22, 4, '2013-01-15 19:10:19.180223', 'sdf sd s', NULL, NULL, 11, 0);
INSERT INTO tbl_post VALUES (23, 4, '2013-01-15 19:10:21.011031', 'sd s sd', NULL, NULL, 11, 0);
INSERT INTO tbl_post VALUES (24, 4, '2013-01-15 19:10:23.298977', 'sd s s sd', NULL, NULL, 11, 0);
INSERT INTO tbl_post VALUES (25, 4, '2013-01-15 19:10:25.929961', 'dfg df df fd', NULL, NULL, 11, 0);
INSERT INTO tbl_post VALUES (26, 4, '2013-01-15 19:11:24.104679', 'sdfsd fs', NULL, NULL, 11, 0);
INSERT INTO tbl_post VALUES (27, 4, '2013-01-15 19:11:25.730076', 's fs sd', NULL, NULL, 11, 0);
INSERT INTO tbl_post VALUES (28, 4, '2013-01-15 19:11:28.299648', '435345435 43', NULL, NULL, 11, 0);
INSERT INTO tbl_post VALUES (29, 4, '2013-01-15 19:11:31.259468', '43 43 43 5', NULL, NULL, 11, 0);
INSERT INTO tbl_post VALUES (30, 4, '2013-01-15 19:11:34.0579', 'gf hfg fg h h', NULL, NULL, 11, 0);
INSERT INTO tbl_post VALUES (31, 4, '2013-01-15 19:11:36.603787', 'fg hfg fg fg', NULL, NULL, 11, 0);
INSERT INTO tbl_post VALUES (40, 4, '2013-01-17 04:40:17.074157', 'dfgdfg df df  df', NULL, NULL, 39, 0);
INSERT INTO tbl_post VALUES (41, 4, '2013-01-17 04:42:10.589364', 'dsfsdfsdf', NULL, NULL, 39, 0);
INSERT INTO tbl_post VALUES (42, 4, '2013-01-17 04:48:28.952574', 'чссч', NULL, NULL, 39, 0);
INSERT INTO tbl_post VALUES (43, 4, '2013-01-17 06:59:48.442423', 'fsdfdsf', NULL, NULL, 39, 0);
INSERT INTO tbl_post VALUES (45, 4, '2013-01-17 07:24:30.893019', 'fghfh', NULL, NULL, NULL, 1);
INSERT INTO tbl_post VALUES (44, 4, '2013-01-17 07:23:41.250364', 'dfgdfg', NULL, NULL, NULL, 1);
INSERT INTO tbl_post VALUES (39, 4, '2013-01-17 04:38:35.944459', 'fghffhfgh', NULL, NULL, NULL, 1);
INSERT INTO tbl_post VALUES (38, 4, '2013-01-17 03:19:55.375943', 'dfgdfg df gfd 
', NULL, NULL, NULL, 1);
INSERT INTO tbl_post VALUES (37, 4, '2013-01-16 22:13:59.25775', 'dfgdfg dd f', NULL, NULL, NULL, 1);
INSERT INTO tbl_post VALUES (36, 4, '2013-01-16 22:13:43.364719', 'sdfsfsdfsdf', NULL, NULL, NULL, 1);
INSERT INTO tbl_post VALUES (35, 4, '2013-01-16 22:08:34.98805', 'fdgdfg', NULL, NULL, NULL, 1);
INSERT INTO tbl_post VALUES (34, 4, '2013-01-16 22:06:56.530452', 'fhfh', NULL, NULL, NULL, 1);
INSERT INTO tbl_post VALUES (33, 4, '2013-01-16 21:38:08.815254', 'dfgdfg', NULL, NULL, NULL, 1);
INSERT INTO tbl_post VALUES (32, 4, '2013-01-16 20:02:12.146449', 'sdfdsfsdf', NULL, NULL, NULL, 0);


--
-- Data for Name: tbl_status; Type: TABLE DATA; Schema: public; Owner: petroom
--

INSERT INTO tbl_status VALUES (2, 4, '2013-01-09 08:17:59.847088', 'safsdfsaf sd fsd sd                                                                                                                                                                                                                                            ');
INSERT INTO tbl_status VALUES (3, 4, '2013-01-09 08:18:04.249575', 'safsdfsaf sd fsd sd s s fds sd sd                                                                                                                                                                                                                              ');
INSERT INTO tbl_status VALUES (4, 4, '2013-01-09 08:18:39.343982', 'safsdfsaf sd fsd sd s s fds sd sd                                                                                                                                                                                                                              ');
INSERT INTO tbl_status VALUES (5, 4, '2013-01-09 08:18:44.788575', 'safsdfsaf sd fsd sd s s fds sd sd sdfdsddfsddsf                                                                                                                                                                                                                ');
INSERT INTO tbl_status VALUES (6, 4, '2013-01-10 00:52:19.684941', 'safsdfsaf sd fsd sd s s fds sd sd sdfdsddfsddsf                                                                                                                                                                                                                ');
INSERT INTO tbl_status VALUES (7, 4, '2013-01-15 19:09:55.103301', 'dfdsf dsfsdd                                                                                                                                                                                                                                                   ');
INSERT INTO tbl_status VALUES (8, 4, '2013-01-16 17:36:29.682372', 'fggff f f f                                                                                                                                                                                                                                                    ');


--
-- Data for Name: tbl_user; Type: TABLE DATA; Schema: public; Owner: petroom
--

INSERT INTO tbl_user VALUES (1, 'VPuh                                                                                                                                                                                                                                                           ', 'test@mail.ru                                                                                                                                                                                                                                                   ', '123456                                                                                                                                                                                                                                                         ', 'ktkt                                                                                                                                                                                                                                                           ', 'US/Pacific                                                                                                                                                                                                                                                     ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31_9bb31ec147894df56d89d201ee1a6c29.jpg                                                                                                                                                                                                                        ');
INSERT INTO tbl_user VALUES (3, 'Tomas                                                                                                                                                                                                                                                          ', 'testwer@sdfdsf.ru                                                                                                                                                                                                                                              ', '123456                                                                                                                                                                                                                                                         ', 'dsfsdfdf                                                                                                                                                                                                                                                       ', 'US/Pacific                                                                                                                                                                                                                                                     ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'big_66db764bfda473b8c73f01361f535ffe.jpg', 'thumb_20cc02937dd8f187bae09ba3391926fa.jpg                                                                                                                                                                                                                     ', '50_c90e56c780cc0328b82884e0249d81a7.jpg                                                                                                                                                                                                                        ', '31_9bb31ec147894df56d89d201ee1a6c29.jpg                                                                                                                                                                                                                        ');
INSERT INTO tbl_user VALUES (2, 'Bingo                                                                                                                                                                                                                                                          ', 'sd@sfsdf.ru                                                                                                                                                                                                                                                    ', '123456                                                                                                                                                                                                                                                         ', 'dsfsdf                                                                                                                                                                                                                                                         ', 'US/Pacific                                                                                                                                                                                                                                                     ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31_9bb31ec147894df56d89d201ee1a6c29.jpg                                                                                                                                                                                                                        ');
INSERT INTO tbl_user VALUES (4, 'Marly                                                                                                                                                                                                                                                          ', 'test2@mail.ru                                                                                                                                                                                                                                                  ', '123456                                                                                                                                                                                                                                                         ', 'dsfsdfsdf                                                                                                                                                                                                                                                      ', 'US/Pacific                                                                                                                                                                                                                                                     ', '2013-01-02', '                                                                                                                                                                                                                                                               ', '                                                                                                                                                                                                                                                               ', '                                                                                                                                                                                                                                                               ', '                                                                                                                                                                                                                                                               ', '', 2, 'big_b36d26cb566757024c7200f372f81a29.jpg', 'thumb_b36d26cb566757024c7200f372f81a29.jpg                                                                                                                                                                                                                     ', '50_c90e56c780cc0328b82884e0249d81a7.jpg                                                                                                                                                                                                                        ', '31_b36d26cb566757024c7200f372f81a29.jpg                                                                                                                                                                                                                        ');


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
-- Name: tbl_post_pkey; Type: CONSTRAINT; Schema: public; Owner: petroom; Tablespace: 
--

ALTER TABLE ONLY tbl_post
    ADD CONSTRAINT tbl_post_pkey PRIMARY KEY (id);


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
-- Name: FK_PHOTOS_OLDER; Type: FK CONSTRAINT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_photos
    ADD CONSTRAINT "FK_PHOTOS_OLDER" FOREIGN KEY (folder_id) REFERENCES tbl_photos_folder(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: FK_PHOTOS_USER_ID; Type: FK CONSTRAINT; Schema: public; Owner: petroom
--

ALTER TABLE ONLY tbl_photos_folder
    ADD CONSTRAINT "FK_PHOTOS_USER_ID" FOREIGN KEY (user_id) REFERENCES tbl_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


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

