/*
Navicat PGSQL Data Transfer

Source Server         : linksys
Source Server Version : 90501
Source Host           : 192.168.1.1:5432
Source Database       : BWProject
Source Schema         : public

Target Server Type    : PGSQL
Target Server Version : 90501
File Encoding         : 65001

Date: 2016-10-20 10:48:33
*/


-- ----------------------------
-- Table structure for t_autoload
-- ----------------------------
DROP TABLE IF EXISTS "public"."t_autoload";
CREATE TABLE "public"."t_autoload" (
"f_id" char(36) COLLATE "default" NOT NULL,
"f_create_time" timestamp(6) NOT NULL,
"f_update_time" timestamp(6),
"f_version" int4 NOT NULL,
"f_url" varchar(500) COLLATE "default",
"f_floor" int4,
"f_page" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of t_autoload
-- ----------------------------
INSERT INTO "public"."t_autoload" VALUES ('8F2F463D-22B3-01CC-E921-B0E3691E0E0D', '2016-04-28 14:48:30.342348', null, '0', 'http://tieba.baidu.com/p/4448568199', '55', '2');
INSERT INTO "public"."t_autoload" VALUES ('C20C2870-F8A1-A44B-D43A-2A99F656868A', '2016-04-28 14:25:47.585338', null, '0', 'http://tieba.baidu.com/p/4448568199', '61', '2');

-- ----------------------------
-- Table structure for t_base
-- ----------------------------
DROP TABLE IF EXISTS "public"."t_base";
CREATE TABLE "public"."t_base" (
"f_id" char(36) COLLATE "default" NOT NULL,
"f_create_time" timestamp(6) NOT NULL,
"f_update_time" timestamp(6),
"f_version" int4 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of t_base
-- ----------------------------

-- ----------------------------
-- Table structure for t_client
-- ----------------------------
DROP TABLE IF EXISTS "public"."t_client";
CREATE TABLE "public"."t_client" (
"f_id" char(36) COLLATE "default" NOT NULL,
"f_create_time" timestamp(6) NOT NULL,
"f_update_time" timestamp(6),
"f_version" int4 NOT NULL,
"f_type" int4 NOT NULL,
"f_name" varchar(50) COLLATE "default" NOT NULL,
"f_name_type" int4 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of t_client
-- ----------------------------
INSERT INTO "public"."t_client" VALUES ('DB6BC76F-85B6-4FFB-2D26-FBFEA9FFDD98', '2016-04-28 14:25:47.585338', null, '0', '0', '423322318', '0');

-- ----------------------------
-- Table structure for t_comment
-- ----------------------------
DROP TABLE IF EXISTS "public"."t_comment";
CREATE TABLE "public"."t_comment" (
"f_id" char(36) COLLATE "default" NOT NULL,
"f_create_time" timestamp(6) NOT NULL,
"f_update_time" timestamp(6),
"f_version" int4 NOT NULL,
"f_event_id" varchar(36) COLLATE "default" NOT NULL,
"f_type" int4 NOT NULL,
"f_remark" varchar(500) COLLATE "default" NOT NULL,
"f_agree" int4 NOT NULL,
"f_against" int4 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of t_comment
-- ----------------------------

-- ----------------------------
-- Table structure for t_dictionaries
-- ----------------------------
DROP TABLE IF EXISTS "public"."t_dictionaries";
CREATE TABLE "public"."t_dictionaries" (
"f_id" char(36) COLLATE "default" NOT NULL,
"f_create_time" timestamp(6) NOT NULL,
"f_update_time" timestamp(6),
"f_version" int4 NOT NULL,
"f_name" varchar(50) COLLATE "default" NOT NULL,
"f_val" int4 NOT NULL,
"f_type" varchar(20) COLLATE "default" NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of t_dictionaries
-- ----------------------------

-- ----------------------------
-- Table structure for t_dictionaries_item
-- ----------------------------
DROP TABLE IF EXISTS "public"."t_dictionaries_item";
CREATE TABLE "public"."t_dictionaries_item" (
"f_id" char(36) COLLATE "default" NOT NULL,
"f_create_time" timestamp(6) NOT NULL,
"f_update_time" timestamp(6),
"f_version" int4 NOT NULL,
"f_name" varchar(50) COLLATE "default" NOT NULL,
"f_val" int4 NOT NULL,
"f_type" varchar(20) COLLATE "default" NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of t_dictionaries_item
-- ----------------------------

-- ----------------------------
-- Table structure for t_event
-- ----------------------------
DROP TABLE IF EXISTS "public"."t_event";
CREATE TABLE "public"."t_event" (
"f_id" char(36) COLLATE "default" NOT NULL,
"f_create_time" timestamp(6) NOT NULL,
"f_update_time" timestamp(6),
"f_version" int4 NOT NULL,
"f_title" varchar(50) COLLATE "default" NOT NULL,
"f_remark" varchar(500) COLLATE "default" NOT NULL,
"f_comment_count" int4 NOT NULL,
"f_ip" varchar(50) COLLATE "default" NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of t_event
-- ----------------------------
INSERT INTO "public"."t_event" VALUES ('5830C414-DEEF-FB70-45F4-F40559E463B3', '2016-04-28 14:25:47.585338', null, '0', '交易猫诈骗', '交易猫诈骗', '0', 'AutoEvent');

-- ----------------------------
-- Table structure for t_group
-- ----------------------------
DROP TABLE IF EXISTS "public"."t_group";
CREATE TABLE "public"."t_group" (
"f_id" char(36) COLLATE "default" NOT NULL,
"f_create_time" timestamp(6) NOT NULL,
"f_update_time" timestamp(6),
"f_version" int4 NOT NULL,
"f_client_id" varchar(36) COLLATE "default" NOT NULL,
"f_event_id" varchar(36) COLLATE "default" NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of t_group
-- ----------------------------
INSERT INTO "public"."t_group" VALUES ('CB50AFD9-0F3C-1964-D643-4B840AB8E28C', '2016-04-28 14:25:47.585338', null, '0', 'DB6BC76F-85B6-4FFB-2D26-FBFEA9FFDD98', '5830C414-DEEF-FB70-45F4-F40559E463B3');

-- ----------------------------
-- Table structure for t_log
-- ----------------------------
DROP TABLE IF EXISTS "public"."t_log";
CREATE TABLE "public"."t_log" (
"f_id" char(36) COLLATE "default" NOT NULL,
"f_create_time" timestamp(6) NOT NULL,
"f_update_time" timestamp(6),
"f_version" int4 NOT NULL,
"f_type" varchar(50) COLLATE "default" NOT NULL,
"f_msg" varchar(1000) COLLATE "default" NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of t_log
-- ----------------------------

-- ----------------------------
-- Table structure for t_point
-- ----------------------------
DROP TABLE IF EXISTS "public"."t_point";
CREATE TABLE "public"."t_point" (
"f_id" char(36) COLLATE "default" NOT NULL,
"f_create_time" timestamp(6) NOT NULL,
"f_update_time" timestamp(6),
"f_version" int4 NOT NULL,
"f_client_id" varchar(36) COLLATE "default" NOT NULL,
"f_type" int4 NOT NULL,
"f_name" varchar(50) COLLATE "default" NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of t_point
-- ----------------------------

-- ----------------------------
-- Table structure for t_question
-- ----------------------------
DROP TABLE IF EXISTS "public"."t_question";
CREATE TABLE "public"."t_question" (
"f_id" char(36) COLLATE "default" NOT NULL,
"f_create_time" timestamp(6) NOT NULL,
"f_update_time" timestamp(6),
"f_version" int4 NOT NULL,
"f_question" varchar(100) COLLATE "default" NOT NULL,
"f_answer" varchar(50) COLLATE "default" NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of t_question
-- ----------------------------
INSERT INTO "public"."t_question" VALUES ('A729AB08-035A-1BDA-905E-2982EB722196', '2016-02-15 21:48:38', null, '0', '1+1*2=', '3');
INSERT INTO "public"."t_question" VALUES ('F6B426BE-54AF-D8D2-0A01-E0EC9CD04473', '2016-02-15 21:47:56', null, '0', '(1+1)+(1-1)=', '2');

-- ----------------------------
-- Table structure for t_question_table
-- ----------------------------
DROP TABLE IF EXISTS "public"."t_question_table";
CREATE TABLE "public"."t_question_table" (
"f_id" char(36) COLLATE "default" NOT NULL,
"f_create_time" timestamp(6) NOT NULL,
"f_update_time" timestamp(6),
"f_version" int4 NOT NULL,
"f_mail" varchar(255) COLLATE "default" NOT NULL,
"f_question_id" char(36) COLLATE "default" NOT NULL,
"f_validation" bit(1) NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of t_question_table
-- ----------------------------
INSERT INTO "public"."t_question_table" VALUES ('32F5CFA5-8237-07C7-2581-12E765C85FC8', '2016-02-18 15:06:25', '2016-02-18 18:20:33', '2', 'tianfuwang1@sina.com', 'A729AB08-035A-1BDA-905E-2982EB722196', E'1');

-- ----------------------------
-- Table structure for t_url
-- ----------------------------
DROP TABLE IF EXISTS "public"."t_url";
CREATE TABLE "public"."t_url" (
"f_id" char(36) COLLATE "default" NOT NULL,
"f_create_time" timestamp(6) NOT NULL,
"f_update_time" timestamp(6),
"f_version" int4 NOT NULL,
"f_event_id" varchar(36) COLLATE "default" NOT NULL,
"f_title" varchar(50) COLLATE "default" NOT NULL,
"f_url" varchar(500) COLLATE "default" NOT NULL,
"f_type" int4 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of t_url
-- ----------------------------
INSERT INTO "public"."t_url" VALUES ('7060388D-8E09-CBBE-9C96-FB6B85A98F3A', '2016-04-28 14:25:47.585338', null, '0', '5830C414-DEEF-FB70-45F4-F40559E463B3', '广东', '广东', '0');

-- ----------------------------
-- Table structure for t_user
-- ----------------------------
DROP TABLE IF EXISTS "public"."t_user";
CREATE TABLE "public"."t_user" (
"f_id" char(36) COLLATE "default" NOT NULL,
"f_create_time" timestamp(6) NOT NULL,
"f_update_time" timestamp(6),
"f_version" int4 NOT NULL,
"f_login_name" varchar(50) COLLATE "default" NOT NULL,
"f_login_password" varchar(50) COLLATE "default" NOT NULL,
"f_password_key" varchar(16) COLLATE "default" NOT NULL,
"f_mail" varchar(255) COLLATE "default" NOT NULL,
"f_show_name" varchar(50) COLLATE "default" NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of t_user
-- ----------------------------
INSERT INTO "public"."t_user" VALUES ('194386E6-1768-1AE9-537B-A9E8739C6471', '2016-02-18 18:20:33', null, '0', 'tianfuwang1@sina.com', 'FqFeyeVl0yFvaxI6rTjZ7yoIL2TiUmFrN2YIcCgsZmA=', 'XaPYxA2YXaPYxA2Y', 'tianfuwang1@sina.com', 'test');

-- ----------------------------
-- Table structure for t_user_info
-- ----------------------------
DROP TABLE IF EXISTS "public"."t_user_info";
CREATE TABLE "public"."t_user_info" (
"f_id" char(36) COLLATE "default" NOT NULL,
"f_create_time" timestamp(6) NOT NULL,
"f_update_time" timestamp(6),
"f_version" int4 NOT NULL,
"f_user_id" char(36) COLLATE "default" NOT NULL,
"f_sex" int4 NOT NULL,
"f_phone" varchar(20) COLLATE "default" DEFAULT NULL::character varying
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of t_user_info
-- ----------------------------

-- ----------------------------
-- Alter Sequences Owned By 
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table t_autoload
-- ----------------------------
ALTER TABLE "public"."t_autoload" ADD PRIMARY KEY ("f_id");

-- ----------------------------
-- Primary Key structure for table t_base
-- ----------------------------
ALTER TABLE "public"."t_base" ADD PRIMARY KEY ("f_id");

-- ----------------------------
-- Primary Key structure for table t_client
-- ----------------------------
ALTER TABLE "public"."t_client" ADD PRIMARY KEY ("f_id");

-- ----------------------------
-- Primary Key structure for table t_comment
-- ----------------------------
ALTER TABLE "public"."t_comment" ADD PRIMARY KEY ("f_id");

-- ----------------------------
-- Primary Key structure for table t_dictionaries
-- ----------------------------
ALTER TABLE "public"."t_dictionaries" ADD PRIMARY KEY ("f_id");

-- ----------------------------
-- Primary Key structure for table t_dictionaries_item
-- ----------------------------
ALTER TABLE "public"."t_dictionaries_item" ADD PRIMARY KEY ("f_id");

-- ----------------------------
-- Primary Key structure for table t_event
-- ----------------------------
ALTER TABLE "public"."t_event" ADD PRIMARY KEY ("f_id");

-- ----------------------------
-- Primary Key structure for table t_group
-- ----------------------------
ALTER TABLE "public"."t_group" ADD PRIMARY KEY ("f_id");

-- ----------------------------
-- Primary Key structure for table t_log
-- ----------------------------
ALTER TABLE "public"."t_log" ADD PRIMARY KEY ("f_id");

-- ----------------------------
-- Primary Key structure for table t_point
-- ----------------------------
ALTER TABLE "public"."t_point" ADD PRIMARY KEY ("f_id");

-- ----------------------------
-- Primary Key structure for table t_question
-- ----------------------------
ALTER TABLE "public"."t_question" ADD PRIMARY KEY ("f_id");

-- ----------------------------
-- Primary Key structure for table t_question_table
-- ----------------------------
ALTER TABLE "public"."t_question_table" ADD PRIMARY KEY ("f_id");

-- ----------------------------
-- Primary Key structure for table t_url
-- ----------------------------
ALTER TABLE "public"."t_url" ADD PRIMARY KEY ("f_id");

-- ----------------------------
-- Primary Key structure for table t_user
-- ----------------------------
ALTER TABLE "public"."t_user" ADD PRIMARY KEY ("f_id");

-- ----------------------------
-- Primary Key structure for table t_user_info
-- ----------------------------
ALTER TABLE "public"."t_user_info" ADD PRIMARY KEY ("f_id");
