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
-- Table 'msg_to_users'
-- 
-- ---

DROP TABLE IF EXISTS `msg_to_users`;
		
CREATE TABLE `msg_to_users` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `login_who_edited` VARCHAR(255) NOT NULL,
  `header` MEDIUMTEXT NOT NULL,
  `mesage` MEDIUMTEXT NOT NULL,
  `status_from_settings` BIGINT NOT NULL,
  `created_at` INTEGER NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'settings'
-- 
-- ---

DROP TABLE IF EXISTS `settings`;
		
CREATE TABLE `settings` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `name` MEDIUMTEXT NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'msg_status_by_user'
-- 
-- ---

DROP TABLE IF EXISTS `msg_status_by_user`;
		
CREATE TABLE `msg_status_by_user` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `status_id` INTEGER NOT NULL,
  `user_id` BIGINT NOT NULL,
  `message_id` BIGINT NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'msg_status'
-- 
-- ---

DROP TABLE IF EXISTS `msg_status`;
		
CREATE TABLE `msg_status` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `status_name` MEDIUMTEXT NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `users` ADD FOREIGN KEY (group_id) REFERENCES `group` (`id`);
ALTER TABLE `user_settings` ADD FOREIGN KEY (user_id) REFERENCES `users` (`id`);
ALTER TABLE `user_settings` ADD FOREIGN KEY (setting_id) REFERENCES `settings` (`id`);
ALTER TABLE `groop_settings` ADD FOREIGN KEY (group_id) REFERENCES `group` (`id`);
ALTER TABLE `groop_settings` ADD FOREIGN KEY (setting_id) REFERENCES `settings` (`id`);
ALTER TABLE `msg_to_users` ADD FOREIGN KEY (status_from_settings) REFERENCES `settings` (`id`);
ALTER TABLE `msg_status_by_user` ADD FOREIGN KEY (status_id) REFERENCES `msg_status` (`id`);
ALTER TABLE `msg_status_by_user` ADD FOREIGN KEY (user_id) REFERENCES `users` (`id`);
ALTER TABLE `msg_status_by_user` ADD FOREIGN KEY (message_id) REFERENCES `msg_to_users` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `users` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `group` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `user_settings` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `groop_settings` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `msg_to_users` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `settings` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `msg_status_by_user` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `msg_status` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

INSERT INTO `users` (`id`, `login`, `psw`, `email`, `created_at`, `group_id`, `session_token`) VALUES (NULL, 'ssv', '$2y$10$F0P4E2ZMlXDpfKbttn3E6uEjZ3AdPwwb2ZPL3Vq72vZocQN10OZFe', 'test@gmail.com', '1602929044', '1', '');
INSERT INTO `group` (`id`,`group_name`) VALUES(NULL,'users');
-- ('','');
-- INSERT INTO `user_settings` (`id`,`user_id`,`setting_id`) VALUES
-- ('','','');
-- INSERT INTO `groop_settings` (`id`,`group_id`,`setting_id`) VALUES
-- ('','','');
-- INSERT INTO `msg_to_users` (`id`,`login_who_edited`,`header`,`mesage`,`status_from_settings`,`created_at`) VALUES
-- ('','','','','','');
-- INSERT INTO `settings` (`id`,`name`) VALUES
-- ('','');
-- INSERT INTO `msg_status_by_user` (`id`,`status_id`,`user_id`,`message_id`) VALUES
-- ('','','','');
-- INSERT INTO `msg_status` (`id`,`status_name`) VALUES
-- ('','');

