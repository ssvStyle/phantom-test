# SIMON-LIB

composer create-project simonov/simon-lib


Уведомления пользователей
Для того, чтобы вам проще было понять задание, мы сняли видеоролик. Начните с него https://youtu.be/BtibRCqdCBE
Задание - разработать инструмент уведомления пользователей. При условии что у каждого конкретного пользователя свои правила получения таких уведомлений.
Для выполнения задания вам будет необходимо:
Создать карточку пользователя с полями:
Логин
Пароль
Почта (email)
Группа
В карточке пользователя можно менять все что угодно, а группа выбирается из уже заведенных групп
Проверка наличия обязательных полей при сохранении карточки пользователя
Пользователи отображаются в отдельной таблице
Создать карточку транспортного средства с полями:
Марка - выпадающий список заведенных марок
Модель - выпадающий список второго уровня (зависящий от выбранной марки), перезагружается при каждом изменении “марки”
Гос.номер - поле текстовое
Сумма аренды - не обязательное числовое поле, с двумя знаками после “,”, не принимать значения меньше нуля
Статус - выпадающий список из 5 статусов:
'На выдачу',
'Резерв',
'В работе',
'Ремонт',
'Угон',
Проверка наличия обязательных полей при сохранении карточки ТС
Если добавите возможность добавления групп марок и моделей - хорошо, но это могут быть зашитые данные в БД
Отдельная страница настройки доступов, должна быть разделена на 3 зоны
“Кому” пользователь или группа - “где” раздел или группа доступов - “что” конкретные настройки этой группы пользователей или конкретного пользователя (см пример в видео)
Индивидуальные настройки прав пользователя замещают групповые настройки для выбранной группы доступов (см пример в видео)
Теперь про уведомления, смотри ролик:
Я перехожу в настройки и отмечаю себе по каким статусам я хотел бы получать уведомления. 
Показываю что вот я поставил себе индивидуальные права, а тут на группу. В группе только на выдачу, а у меня другие уведомления (чтобы показать разницу)
Перехожу в любое ТС, меняю статус на любой другой и получаю или не получаю уведомление в течение следующих 10 секунд
Уведомление пропадает через 30 секунд после появления если пользователь ничего на нажал, или сразу при клике на крестик или заголовке уведомления, или появляющаяся кнопка “принято”
При клике на заголовок открывается карточка связанная с этим уведомлением
При клике на появляющуюся кнопку “прочитано” уведомление считается прочитанным. Как и в случае клика на заголовок, но не открывает упомянутую в уведомлении карточку
Если прошло больше 10 минут, но пользователь не прочитал уведомление (крестик не считается), то высылается письмо на почту с текстом и заголовком уведомления
В правом верхнем углу показывать “колокольчик” в котором отражается количество непрочитанных уведомлений
Клик на колокольчик показывает отдельную страницу из требуемых. Таблицу уведомлений с полями:
Когда
Кто
Заголовок
Сообщение
Уведомлений должно показываться не более 5 штук, если их больше то появляется полоса прокрутки. Сортировка уведомлений по дате от самого позднего к самому раннему сверху вниз
При наведении мышки на заголовок появляется логин пользователя совершившего изменение и дата создания уведомления

Срок выполнения - 10 календарных дней с дня отправки вам ссылки на этот документ. К этому моменту предоставьте любое решение, даже если оно будет незавершенным.

В случае возникновения вопросов, обращаться в телеграмм к нашему специалисту https://t.me/PhantomAce (Пётр Владимирович)
Готовый результат в виде архива кода (php+js+css) и дампа БД (mysql) выложите в любой общедоступный ресурс (например, на Google-диск), а ссылку пришлите в телеграм.
Важное условие - не использовать никаких фреймворков, весь код должен быть создан вами.
Удачи!



-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'users'
-- 
-- ---

DROP TABLE IF EXISTS `users`;
		
CREATE TABLE `users` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(255) NOT NULL,
  `psw` VARCHAR(255) NOT NULL,
  `email` MEDIUMTEXT NOT NULL,
  `created_at` INT NULL DEFAULT NULL,
  `updated_at` INT NOT NULL,
  `group_id` BIGINT NOT NULL,
  `session_token` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'group'
-- 
-- ---

DROP TABLE IF EXISTS `group`;
		
CREATE TABLE `group` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `group_name` MEDIUMTEXT NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'user_settings'
-- 
-- ---

DROP TABLE IF EXISTS `user_settings`;
		
CREATE TABLE `user_settings` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT NOT NULL,
  `setting_id` BIGINT NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'groop_settings'
-- 
-- ---

DROP TABLE IF EXISTS `groop_settings`;
		
CREATE TABLE `groop_settings` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `group_id` BIGINT NOT NULL,
  `setting_id` BIGINT NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'messages'
-- 
-- ---

DROP TABLE IF EXISTS `messages`;
		
CREATE TABLE `messages` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `login_who_edited` VARCHAR(255) NOT NULL,
  `header` MEDIUMTEXT NOT NULL,
  `mesage` MEDIUMTEXT NOT NULL,
  `status_from_settings` BIGINT NOT NULL,
  `created_at` INTEGER NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'statuses'
-- 
-- ---

DROP TABLE IF EXISTS `statuses`;
		
CREATE TABLE `statuses` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `name` MEDIUMTEXT NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'msg_for_users'
-- 
-- ---

DROP TABLE IF EXISTS `msg_for_users`;
		
CREATE TABLE `msg_for_users` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT NOT NULL,
  `msg_status_id` BIGINT NOT NULL,
  `message_id` BIGINT NOT NULL,
  `is_send` INTEGER NOT NULL DEFAULT 0,
  `is_send_email` INTEGER NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'msg_status'
-- 
-- ---

DROP TABLE IF EXISTS `msg_status`;
		
CREATE TABLE `msg_status` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `status_name` MEDIUMTEXT NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'cars'
-- 
-- ---

DROP TABLE IF EXISTS `cars`;
		
CREATE TABLE `cars` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `brand_id` BIGINT NOT NULL,
  `model_id` BIGINT NOT NULL,
  `number` VARCHAR(20) NOT NULL,
  `credit` DOUBLE NOT NULL,
  `status_id` BIGINT NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'models'
-- 
-- ---

DROP TABLE IF EXISTS `models`;
		
CREATE TABLE `models` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `model_name` VARCHAR(255) NOT NULL,
  `brands_id` BIGINT NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'car_brands'
-- 
-- ---

DROP TABLE IF EXISTS `car_brands`;
		
CREATE TABLE `car_brands` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `brand_name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `users` ADD FOREIGN KEY (group_id) REFERENCES `group` (`id`);
ALTER TABLE `user_settings` ADD FOREIGN KEY (user_id) REFERENCES `users` (`id`);
ALTER TABLE `user_settings` ADD FOREIGN KEY (setting_id) REFERENCES `statuses` (`id`);
ALTER TABLE `groop_settings` ADD FOREIGN KEY (group_id) REFERENCES `group` (`id`);
ALTER TABLE `groop_settings` ADD FOREIGN KEY (setting_id) REFERENCES `statuses` (`id`);
ALTER TABLE `messages` ADD FOREIGN KEY (status_from_settings) REFERENCES `statuses` (`id`);
ALTER TABLE `msg_for_users` ADD FOREIGN KEY (user_id) REFERENCES `users` (`id`);
ALTER TABLE `msg_for_users` ADD FOREIGN KEY (msg_status_id) REFERENCES `msg_status` (`id`);
ALTER TABLE `msg_for_users` ADD FOREIGN KEY (message_id) REFERENCES `messages` (`id`);
ALTER TABLE `cars` ADD FOREIGN KEY (brand_id) REFERENCES `car_brands` (`id`);
ALTER TABLE `cars` ADD FOREIGN KEY (model_id) REFERENCES `models` (`id`);
ALTER TABLE `cars` ADD FOREIGN KEY (status_id) REFERENCES `statuses` (`id`);
ALTER TABLE `models` ADD FOREIGN KEY (brands_id) REFERENCES `car_brands` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `users` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `group` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `user_settings` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `groop_settings` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `messages` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `statuses` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `msg_for_users` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `msg_status` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `cars` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `models` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `car_brands` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `users` (`id`,`login`,`psw`,`email`,`created_at`,`updated_at`,`group_id`,`session_token`) VALUES
-- ('','','','','','','','');
-- INSERT INTO `group` (`id`,`group_name`) VALUES
-- ('','');
-- INSERT INTO `user_settings` (`id`,`user_id`,`setting_id`) VALUES
-- ('','','');
-- INSERT INTO `groop_settings` (`id`,`group_id`,`setting_id`) VALUES
-- ('','','');
-- INSERT INTO `messages` (`id`,`login_who_edited`,`header`,`mesage`,`status_from_settings`,`created_at`) VALUES
-- ('','','','','','');
-- INSERT INTO `statuses` (`id`,`name`) VALUES
-- ('','');
-- INSERT INTO `msg_for_users` (`id`,`user_id`,`msg_status_id`,`message_id`,`is_send`,`is_send_email`) VALUES
-- ('','','','','','');
-- INSERT INTO `msg_status` (`id`,`status_name`) VALUES
-- ('','');
-- INSERT INTO `cars` (`id`,`brand_id`,`model_id`,`number`,`credit`,`status_id`) VALUES
-- ('','','','','','');
-- INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
-- ('','','');
-- INSERT INTO `car_brands` (`id`,`brand_name`) VALUES
-- ('','');

INSERT INTO `statuses` (`id`,`name`) VALUES
(NULL,'На выдачу');
INSERT INTO `statuses` (`id`,`name`) VALUES
(NULL,'Резерв');
INSERT INTO `statuses` (`id`,`name`) VALUES
(NULL,'В работе');
INSERT INTO `statuses` (`id`,`name`) VALUES
(NULL,'Ремонт');
INSERT INTO `statuses` (`id`,`name`) VALUES
(NULL,'Угон');

INSERT INTO `car_brands` (`id`,`brand_name`) VALUES
(NULL,'Mitsubishi');
INSERT INTO `car_brands` (`id`,`brand_name`) VALUES
(NULL,'Toyota');
INSERT INTO `car_brands` (`id`,`brand_name`) VALUES
(NULL,'Lexus');
INSERT INTO `car_brands` (`id`,`brand_name`) VALUES
(NULL,'Acura');
INSERT INTO `car_brands` (`id`,`brand_name`) VALUES
(NULL,'Honda');
INSERT INTO `car_brands` (`id`,`brand_name`) VALUES
(NULL,'Isuzu');
INSERT INTO `car_brands` (`id`,`brand_name`) VALUES
(NULL,'Nissan');
INSERT INTO `car_brands` (`id`,`brand_name`) VALUES
(NULL,'Mazda');

INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Colt',1);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Lancer',1);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'ASX',1);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Galant',1);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Outlander',1);

INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Aygo',2);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Yaris',2);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Etios',2);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Auris',2);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Corolla',2);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Avensis',2);

INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'UX',3);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'NX',3);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'RX',3);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'GX',3);

INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'MDX',4);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'NSX',4);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'TLX',4);

INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Jazz',5);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Civic',5);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Accord',5);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Legend',5);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'NSX',5);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'S2000',5);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'CR-V',5);

INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'D-Max',6);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'MU-X',6);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Ascender',6);

INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Micra',7);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Tiida',7);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Note',7);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Almera',7);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Leaf',7);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Teana',7);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Qashqai',7);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Juke',7);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'Terrano',7);

INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'CX-7',8);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'MX-5',8);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'5',8);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'6',8);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'RX-8',8);
INSERT INTO `models` (`id`,`model_name`,`brands_id`) VALUES
(NULL,'2',8);



INSERT INTO `group` (`id`,`group_name`) VALUES
(NULL,'users');
INSERT INTO `group` (`id`,`group_name`) VALUES
(NULL,'admin');
INSERT INTO `users` (`id`,`login`,`psw`,`email`,`created_at`,`updated_at`,`group_id`,`session_token`) 
VALUES (NULL, 'Serj', '$2y$10$G0Io2BQjpYFD.8.M39RzSOOqcEEiKTiYYnRiVgG0KVgB.M73BLqM.', 'test@gmail.com', '1602929044', '', 1, '');