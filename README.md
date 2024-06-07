Для исправной работы системы необходимо установить СУБД MySQL или MariaDB

После установки, откройте консолль ОС, выполните команду:

    sudo mysql -u root -p

Введите пароль.

После данныго действия откроется терминал СУБД, в котором есть возможность выполнять SQL-запросы.

Выполните следующие команды:

```sql

    CREATE DATABASE workshop_solving_problems;

    CREATE USER 'workshop_admin'@'localhost' IDENTIFIED BY '12344321';

    GRANT ALL PRIVILEGES ON *.* TO 'workshop_admin'@'localhost';

    USE workshop_solving_problems;

    CREATE TABLE IF NOT EXISTS users (
        id INT NOT NULL AUTO_INCREMENT,
        first_name VARCHAR(255),
        last_name VARCHAR(255),
        role ENUM('user', 'admin'),
        PRIMARY KEY (id)
    );

    CREATE TABLE IF NOT EXISTS sections (
        id INT NOT NULL AUTO_INCREMENT,
        title VARCHAR(255),
        PRIMARY KEY (id)
    );

    CREATE TABLE IF NOT EXISTS chapters (
        id INT NOT NULL AUTO_INCREMENT,
        title VARCHAR(255),
        section_id  INT NOT NULL,
        content TEXT,
        PRIMARY KEY (id),

        FOREIGN KEY (section_id)
            REFERENCES sections(id)
            ON UPDATE CASCADE ON DELETE CASCADE
    );

    CREATE TABLE IF NOT EXISTS tasks (
        id INT NOT NULL AUTO_INCREMENT,
        content VARCHAR(500),
        file_name   VARCHAR(16),
        chapter_id  INT NOT NULL,
        PRIMARY KEY (id),

        FOREIGN KEY (chapter_id)
            REFERENCES chapters(id)
            ON UPDATE CASCADE ON DELETE CASCADE
    );

    INSERT INTO sections (id, title) VALUES
        (1, 'Кинематика'),
        (2, 'Динамика'),
        (3, 'Законы сохранения в механике'),
        (4, 'Молекулярная физика'),
        (5, 'Термодинамика'),
        (6, 'Электростатика'),
        (7, 'Электродинамика'),
        (8, 'Электромагнитные колебания и волны'),
        (9, 'Постоянный электрический ток'),
        (10, 'Механические колебания и волны'),
        (11, 'Оптика');

    INSERT INTO chapters (id, title, section_id) VALUES
        (1, 'Колебательный контур', 8),
        (2, 'Переменный электрический ток', 8),
        (3, 'Трансформатор', 8),
        (4, 'Электромагнитные волны и их свойства', 8);

    INSERT INTO tasks (id, content, chapter_id, file_name) VALUES
        (
            1,
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id risus elementum, placerat velit condimentum, aliquam ex. Maecenas et nibh nec erat imperdiet semper. Nullam posuere, arcu vel ornare accumsan, enim velit imperdiet urna, nec blandit enim urna vel nibh. Phasellus sodales quis quam eget tincidunt.',
            1,
            '2e82204890ae.jpg'
        ),
        (
            2,
            'Curabitur a ante eu purus bibendum imperdiet. Curabitur sodales dolor nibh, vitae interdum dolor mattis sit amet. Curabitur at volutpat enim, sed mollis felis.',
            1,
            '41a87d77edd1.jpg'
        ),
        (
            3,
            'Ut et neque pretium, pulvinar orci quis, fermentum lectus. Nunc facilisis diam vel elit rutrum vestibulum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean sed dui commodo, vulputate diam faucibus, cursus purus. Praesent accumsan ante id urna consectetur porttitor. Vestibulum augue nisl, dapibus quis ipsum ut, consequat iaculis orci. Morbi sagittis gravida vestibulum.',
            1,
            '69cb05094dd6.jpg'
        );

```
