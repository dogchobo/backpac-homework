CREATE TABLE `backpac-homework`.orders
(
    `id`            INT(11)         NOT NULL    AUTO_INCREMENT COMMENT '고유번호 (UNQ, AI)',
    `user_id`       INT(11)         NOT NULL    COMMENT '주문자 고유번호 (FK: users uid)',
    `product_name`  VARCHAR(100)    NOT NULL    COMMENT '상품명 (Max: 100)',
    `order_number`  VARCHAR(12)     NOT NULL    COMMENT '주문번호 (Max: 10)',
    `created_at`    TIMESTAMP       NOT NULL    DEFAULT CURRENT_TIMESTAMP() COMMENT '주문일시',
    `updated_at`    TIMESTAMP       NOT NULL    DEFAULT CURRENT_TIMESTAMP() COMMENT '수정일시',
    PRIMARY KEY (id)
);

ALTER TABLE `backpac-homework`.orders COMMENT '주문정보 테이블';

ALTER TABLE `backpac-homework`.orders
    ADD CONSTRAINT FK_orders_user_id_users_id FOREIGN KEY (user_id)
        REFERENCES users (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `backpac-homework`.orders
    ADD CONSTRAINT UC_order_number UNIQUE (order_number);
