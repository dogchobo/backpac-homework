CREATE TABLE `backpac-homework`.users
(
    `id`            INT(11)         NOT NULL    AUTO_INCREMENT COMMENT '고유번호 (UNQ, AI)',
    `name`          VARCHAR(20)     NOT NULL    COMMENT '이름 (Max: 20)',
    `nickname`      VARCHAR(30)     NOT NULL    COMMENT '닉네임 (Max: 30)',
    `password`      VARCHAR(255)    NOT NULL    COMMENT '패스워드 (Hash)',
    `phone_number`  VARCHAR(20)     NOT NULL    COMMENT '전화번호 (Max: 20)',
    `email`         VARCHAR(100)    NOT NULL    COMMENT '이메일 (Max: 100)',
    `gender`        CHAR(1)         NULL        COMMENT '성별 (M: 남자, F: 여자)',
    `api_token`     VARCHAR(80)     NULL        COMMENT 'API 토큰 (Max: 80)',
    `created_at`    TIMESTAMP       NOT NULL    DEFAULT CURRENT_TIMESTAMP() COMMENT '가입일시',
    `updated_at`    TIMESTAMP       NOT NULL    DEFAULT CURRENT_TIMESTAMP() COMMENT '수정일시',
    PRIMARY KEY (id)
);

ALTER TABLE `backpac-homework`.users COMMENT '회원정보 테이블';

ALTER TABLE `backpac-homework`.users
    ADD CONSTRAINT UC_email UNIQUE (email);
