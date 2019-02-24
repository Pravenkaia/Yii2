CREATE TABLE yii2basic.auth_assignment
(
    item_name varchar(64) NOT NULL,
    user_id varchar(64) NOT NULL,
    created_at int(11),
    CONSTRAINT `PRIMARY` PRIMARY KEY (item_name, user_id),
    CONSTRAINT auth_assignment_ibfk_1 FOREIGN KEY (item_name) REFERENCES yii2basic.auth_item (name) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE INDEX auth_assignment_user_id_idx ON yii2basic.auth_assignment (user_id);
INSERT INTO yii2basic.auth_assignment (item_name, user_id, created_at) VALUES ('admin', '25', 1550004046);
INSERT INTO yii2basic.auth_assignment (item_name, user_id, created_at) VALUES ('user', '1', 1550004046);
INSERT INTO yii2basic.auth_assignment (item_name, user_id, created_at) VALUES ('user', '29', 1550004046);
INSERT INTO yii2basic.auth_assignment (item_name, user_id, created_at) VALUES ('user', '33', 1550004046);
INSERT INTO yii2basic.auth_assignment (item_name, user_id, created_at) VALUES ('user', '42', 1550004046);
INSERT INTO yii2basic.auth_assignment (item_name, user_id, created_at) VALUES ('user', '43', 1550136324);