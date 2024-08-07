PGDMP  3                    |            loginacc    16.3    16.3 ;    ;           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            <           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            =           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            >           1262    16502    loginacc    DATABASE        CREATE DATABASE loginacc WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_Indonesia.1252';
    DROP DATABASE loginacc;
                postgres    false            �            1259    17120    cache    TABLE     �   CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);
    DROP TABLE public.cache;
       public         heap    postgres    false            �            1259    17127    cache_locks    TABLE     �   CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);
    DROP TABLE public.cache_locks;
       public         heap    postgres    false            �            1259    17152    failed_jobs    TABLE     &  CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap    postgres    false            �            1259    17151    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public          postgres    false    225            ?           0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
          public          postgres    false    224            �            1259    17144    job_batches    TABLE     d  CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);
    DROP TABLE public.job_batches;
       public         heap    postgres    false            �            1259    17135    jobs    TABLE     �   CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);
    DROP TABLE public.jobs;
       public         heap    postgres    false            �            1259    17134    jobs_id_seq    SEQUENCE     t   CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.jobs_id_seq;
       public          postgres    false    222            @           0    0    jobs_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;
          public          postgres    false    221            �            1259    17087 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    postgres    false            �            1259    17086    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          postgres    false    216            A           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          postgres    false    215            �            1259    17104    password_reset_tokens    TABLE     �   CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 )   DROP TABLE public.password_reset_tokens;
       public         heap    postgres    false            �            1259    17165    products    TABLE     �  CREATE TABLE public.products (
    id bigint NOT NULL,
    product_name character varying(255) NOT NULL,
    description text NOT NULL,
    price numeric(10,2) NOT NULL,
    is_new boolean DEFAULT false NOT NULL,
    is_popular boolean DEFAULT false NOT NULL,
    product_images character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.products;
       public         heap    postgres    false            �            1259    17164    products_id_seq    SEQUENCE     x   CREATE SEQUENCE public.products_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.products_id_seq;
       public          postgres    false    227            B           0    0    products_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.products_id_seq OWNED BY public.products.id;
          public          postgres    false    226            �            1259    17111    sessions    TABLE     �   CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);
    DROP TABLE public.sessions;
       public         heap    postgres    false            �            1259    17177    users    TABLE     �   CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    17176    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    229            C           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    228            z           2604    17155    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    225    224    225            y           2604    17138    jobs id    DEFAULT     b   ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);
 6   ALTER TABLE public.jobs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    222    221    222            x           2604    17090    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    216    215    216            |           2604    17168    products id    DEFAULT     j   ALTER TABLE ONLY public.products ALTER COLUMN id SET DEFAULT nextval('public.products_id_seq'::regclass);
 :   ALTER TABLE public.products ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    227    226    227                       2604    17180    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    229    228    229            .          0    17120    cache 
   TABLE DATA           7   COPY public.cache (key, value, expiration) FROM stdin;
    public          postgres    false    219   [B       /          0    17127    cache_locks 
   TABLE DATA           =   COPY public.cache_locks (key, owner, expiration) FROM stdin;
    public          postgres    false    220   xB       4          0    17152    failed_jobs 
   TABLE DATA           a   COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
    public          postgres    false    225   �B       2          0    17144    job_batches 
   TABLE DATA           �   COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
    public          postgres    false    223   �B       1          0    17135    jobs 
   TABLE DATA           c   COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
    public          postgres    false    222   �B       +          0    17087 
   migrations 
   TABLE DATA           :   COPY public.migrations (id, migration, batch) FROM stdin;
    public          postgres    false    216   �B       ,          0    17104    password_reset_tokens 
   TABLE DATA           I   COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
    public          postgres    false    217   fC       6          0    17165    products 
   TABLE DATA           �   COPY public.products (id, product_name, description, price, is_new, is_popular, product_images, created_at, updated_at) FROM stdin;
    public          postgres    false    227   �C       -          0    17111    sessions 
   TABLE DATA           _   COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
    public          postgres    false    218   M       8          0    17177    users 
   TABLE DATA           K   COPY public.users (id, name, password, created_at, updated_at) FROM stdin;
    public          postgres    false    229   �N       D           0    0    failed_jobs_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);
          public          postgres    false    224            E           0    0    jobs_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);
          public          postgres    false    221            F           0    0    migrations_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.migrations_id_seq', 5, true);
          public          postgres    false    215            G           0    0    products_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.products_id_seq', 17, true);
          public          postgres    false    226            H           0    0    users_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.users_id_seq', 3, true);
          public          postgres    false    228            �           2606    17133    cache_locks cache_locks_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);
 F   ALTER TABLE ONLY public.cache_locks DROP CONSTRAINT cache_locks_pkey;
       public            postgres    false    220            �           2606    17126    cache cache_pkey 
   CONSTRAINT     O   ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);
 :   ALTER TABLE ONLY public.cache DROP CONSTRAINT cache_pkey;
       public            postgres    false    219            �           2606    17160    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public            postgres    false    225            �           2606    17162 #   failed_jobs failed_jobs_uuid_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
 M   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
       public            postgres    false    225            �           2606    17150    job_batches job_batches_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.job_batches DROP CONSTRAINT job_batches_pkey;
       public            postgres    false    223            �           2606    17142    jobs jobs_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.jobs DROP CONSTRAINT jobs_pkey;
       public            postgres    false    222            �           2606    17092    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            postgres    false    216            �           2606    17110 0   password_reset_tokens password_reset_tokens_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);
 Z   ALTER TABLE ONLY public.password_reset_tokens DROP CONSTRAINT password_reset_tokens_pkey;
       public            postgres    false    217            �           2606    17174    products products_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.products DROP CONSTRAINT products_pkey;
       public            postgres    false    227            �           2606    17117    sessions sessions_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.sessions DROP CONSTRAINT sessions_pkey;
       public            postgres    false    218            �           2606    17186    users users_name_unique 
   CONSTRAINT     R   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_name_unique UNIQUE (name);
 A   ALTER TABLE ONLY public.users DROP CONSTRAINT users_name_unique;
       public            postgres    false    229            �           2606    17184    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    229            �           1259    17143    jobs_queue_index    INDEX     B   CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);
 $   DROP INDEX public.jobs_queue_index;
       public            postgres    false    222            �           1259    17119    sessions_last_activity_index    INDEX     Z   CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);
 0   DROP INDEX public.sessions_last_activity_index;
       public            postgres    false    218            �           1259    17118    sessions_user_id_index    INDEX     N   CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);
 *   DROP INDEX public.sessions_user_id_index;
       public            postgres    false    218            .      x������ � �      /      x������ � �      4      x������ � �      2      x������ � �      1      x������ � �      +   j   x�m�A
�0�u�02M[�0�P뀈��z����,!�0����H��ʱkޥ�aQc	/h+L1MzA���p^�{�0�p+��궼�G*Ղ��:v��KG}CD?Z=�      ,      x������ � �      6   }	  x��Zˎ��]K_Q��`f"�$E=W��z^���oZbK�!E
|x� �|@�,���,�5��OHu��H���c/�k��Wd�����ԩ�n�r�K�wv�Wwv��O��IW����x�O�����P�0�f��\4`��$.t�A�	U�X��[�eB�'b���J�_�3j ���e��Y�ekZ���Y:��V_;�5QF]ww�����?��N�j��ZZ[%��C��k����6}<���r����n�;��k�7��׆=�u�`C�����u2Ϻ��~h��sm��?B�]�ݿ��H�����Q�5T�u��G���ݶ|��;�F��k����xZ�������l��Gm
��L�S�{M���a�p���H�[ѣ/B<�P��iW�OÉQ�'&n�gfP{������"l����] �#��AL�R{��������8�BV`�-�z��Ǿ۝�x�;6����E�s�lE�m��������
 [Q+�r�2>�K|n���>Nl'G֖x�"��1�{��`��mI)א�FI�r~n�#.)=��:�H�Z��E�
�ԔjM��%��s�`��.�6��S/	���զ������W���DC��C��S �f���;�*��p�����7�aCH�P{-t���g3s���և�
�;�~׸��~���&����t�zS-g��\�6�<��2�T���XRQ"������,Sn�����_oD�_�0�o�eĺ�%�+9��D���|q�7h#����rpu6�x�����K�{��^�R��S�˕�\�-���ĳ��Iϰˎ����%�?�1�q���	�*q�)&~��A��u��d�aP���:�7]�B�� �X\N�w�֛g�<?�ڐ��%��ı���W��t˂�		���~�Mr�$��HE����|0Y:�Ƨ��Q?������Cx6�\I�L��xў���QUd�#K'�Bkjg���5�c`��_����X���͉{/C�	.E��M%��r+U�f��㿪C���Ho��X�/�ѯ�	q�P��� `G�x�JLzm��"Zx�Gf2��rA"R&��<-%��bɊ��ֈG[��"���K\�=W j�����Ao�3���7
͋ƽ/%�}��ͩ_��yO�0F�p��ާ��Q*K�:�'��*���f�fvqF~p����ޣ�H���!�`�js{#�{±��9.1=#�˄z��A2���C�_��ou�ak!/�H�!N�%�ʈ}��I�)��eQb;�&z@��������3g�\�q�!����\kV�*e��j�,��v���#�o�L�ȁC"'16�!�nqv�',�+�3É㶟�:V�x�D�N+����l��.���uR ��	�,xn���[q"{U��<��C(^`$���H����A*K�P�ʭb�yn��ԲdyYB\b^13y�x|��d�fp	�����_��/"�������<�DCC<�����/P�<��d xi������?^?D��!����ռ�q�/�ɀ���yj�~EΒ�e%7�;����$�ɔ-�o3��@�5)� V+��7(�|�| �9������U��Op5<�UK���/G`�d�"IR\�Z.Pn"�3d�J�=�T=�{��_Y��JQ�eޗ���L`�g^^����(,cϗ#L�RE�K=����Rum��q�p|��|�6��̲��j-�c��p7+�S��.�%^��'ƩQe[?���U嬔��k�_Sed��Ck�/�SCsd��Ǭ����1*\�^#��Zlƀ��az����
Ok����6q�w~��(�"��/0B�����R�R1ר��i>V�x
��v�n-�K�R-֔+��Z3ߒ�+�zYM��=!e&���rz~'d�rn�,����7�1�ϯ>��/O�#����]���r\e���DT�+�y��e�H- $�`SD�4�Ȇ+���)����zHjN鮡f�N�$:dD�q��'e�b7�9�)ڑ�r�u���b�x�"�딳�J�c8�ß3&��<�qط<=+'�%,�Ar&��M��%�Ws}tjЃI�-Q��~�����G��ˏz��VH��G��$�����n�)���B�Gq���'f�?>���z���	���P�����o�ǵ&̜�-7@۸8ԇb~Yl�4E�.ԓ����0�8K�Li���%�g�]v'�����?��B]�ǻ���v��]8i�k����2k}�Y�d��r97"��b����Yr����%_q�=O�`_�0V���2���:�)�����OKD�ZZ���EN�H�+�u�k|�,�z�����Ix���ID���Z�|�����[�ʋ�/,�[ip+��ź͉WseҷڔN�!�*���� �יE      -   �  x�=�Ms�@���+�Tm)3�*'����1#�^�R�@����S[}���}���p_�̢mBEh�"�ꏳޙ/�S��N�����AdN4pD�AH�L���xϛ��@�~J��gpųG0o[Y�"]�nj��D��a�0����
�*��y�㩩�)D�{�ޒ}r?�Q�H߻��v������p�lh4�lDm�� z����ʪ��ݱ��R���@������@z�ݏ���q}=f� (�1)ۛ>(���^�ڲ5�!�dhDZ�[vGZ�q�CK�7F�x2��%����s`V���7�+v룖;s��z��2;�Ŭߔ6��yO�1]��b]b'(sG�t�����󙢼M������L���m� ud����g�>.U^=.w���Z�HO�������z���F�/3i�#���G���J�<��AZB�|�����b���      8   �   x�m�MO�0 ��3�;p]���r�	s�� k⅏
d��n¯71Y�	��𼦖W]�k:u���z�R��/�KX�㎨P��,�t[�a��k|V?[kg{H'�5d ki�Kd/L�b�%�s �k�&��&$�&g��ؔ���f���^e��sܱ�p/��ץ�}u�h۵\�����n7u�N���\�Vt#�� 7��Y{��`/Y��M�i���D��@Ưl�5� ?��[#     