INSERT INTO users
SET dt_add = NOW(), name = 'John Snow', email = 'john_snow@stark.ws', password = 'WinterIsComing';

INSERT INTO users
SET dt_add = NOW(), name = 'Bran Stark', email = 'bran_stark@stark.ws', password = '3eyedRaven';

INSERT INTO projects (id_user, name)
VALUES (1,'Входящие'), (1, 'Учеба'), (2, 'Работа'), (3, 'Домашние дела'), (1, 'Авто');

INSERT INTO tasks
SET id_project = 3, dt_add = NOW(), name = 'Собеседование в IT компании', dt_end = '01.01.2019',
status = FALSE;

INSERT INTO tasks
SET id_project = 3, dt_add = NOW(), name = 'Выполнить тестовое задание', dt_end = '27.04.2019',
status = FALSE;

INSERT INTO tasks
SET id_project = 2, dt_add = NOW(), name = 'Сделать задание первого раздела', dt_end = '21.12.2019',
status = TRUE;

INSERT INTO tasks
SET id_project = 1, dt_add = NOW(), name = 'Встреча с другом', dt_end = '22.12.2019',
status = FALSE;

INSERT INTO tasks
SET id_project = 4, dt_add = NOW(), name = 'Купить корм для кота', status = FALSE;

INSERT INTO tasks
SET id_project = 4, dt_add = NOW(), name = 'Заказать пиццу', status = FALSE;

SELECT t.id_project FROM tasks t
JOIN projects p
ON t.id_project = p.id;

SELECT p.id_user FROM projects p
JOIN users u
ON p.id_user = u.id;

// получить список из всех проектов для одного пользователя.
// Объедините проекты с задачами, чтобы посчитать количество задач в каждом проекте
// и в дальнейшем выводить эту цифру рядом с именем проекта

SELECT * FROM projects
WHERE id_user = 1;

// получить список из всех задач для одного проекта
SELECT * FROM tasks
WHERE id_project = 3;

// пометить задачу как выполненную
UPDATE tasks SET status = TRUE
WHERE id = 1;

// обновить название задачи по её идентификатору

UPDATE tasks SET name = 'Заказать суши'
WHERE id = 6;