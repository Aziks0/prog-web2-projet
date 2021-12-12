<?php

class ORM
{
    private PDO $pdo;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        try {
            $this->pdo = new PDO('sqlite:' . dirname(__FILE__) . '/database.db');
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            echo 'Connexion failed: ' . $ex->getMessage();
            throw new Exception('Connexion failed');
        }

        $this->createTables();
    }

    /**
     * Create a users and an articles table if they do not exist
     * 
     * @throws Exception
     */
    private function createTables(): void
    {
        try {
            $this->pdo->query('CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username VARCHAR(255) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL
            )');

            $this->pdo->query('CREATE TABLE IF NOT EXISTS articles (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title VARCHAR(100) NOT NULL,
                body TEXT NOT NULL,
                category VARCHAR(20) NOT NULL,
                author VARCHAR(20) NOT NULL,
                image LONGBLOB NOT NULL,
                image_extension VARCHAR(5) NOT NULL,
                created_at DATETIME DEFAULT (datetime(\'now\', \'localtime\')),
                updated_at DATETIME DEFAULT (datetime(\'now\', \'localtime\'))
            )');
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            throw new Exception('Failed to create tables');
        }
    }

    /**
     * Insert an article into the database
     * 
     * @param string $title The title of the article
     * @param string $body The body of the article
     * @param string $category The category of the article
     * @param string $author The username of the author
     * @param string $image The base64 string of a png image
     * 
     * @return int The id of the inserted article
     * 
     * @throws Exception
     */
    public function insertArticle(
        string $title,
        string $body,
        string $category,
        string $author,
        string $image,
        string $image_extension
    ): int {
        try {
            $statement =
                $this->pdo->prepare(
                    'INSERT INTO articles (title, body, category, author, image, image_extension)' .
                        'VALUES (:title, :body, :category, :author, :image, :image_extension)'
                );
            $statement->bindValue(':title', $title);
            $statement->bindValue(':body', $body);
            $statement->bindValue(':category', $category);
            $statement->bindValue(':author', $author);
            $statement->bindValue(':image', $image);
            $statement->bindValue(':image_extension', $image_extension);
            $statement->execute();

            // Fetch the article's id
            $statement = $this->pdo->prepare('SELECT id FROM articles WHERE author = :author ORDER BY id DESC');
            $statement->bindValue(':author', $author);
            $statement->execute();
            return $statement->fetchColumn();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            throw new Exception('Failed to insert the article');
        }
    }

    /**
     * Fetch an article from the database
     * 
     * @param int Article ID
     * 
     * @return array An array containing an article \
     * The array is indexed by column name, or an empty array
     * if the article was not found
     * 
     * @throws Exception
     */
    public function fetchArticle(int $id): array
    {
        try {
            $statement = $this->pdo->prepare('SELECT * FROM articles WHERE id = :id');
            $statement->bindValue(':id', $id);
            $statement->execute();

            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            throw new Exception('Failed to fetch the article');
        }
    }

    /**
     * Fetch articles from the database, ordered by creation date in descending
     * order (last articles first), with a limit and an offset
     * 
     * Exemple: \
     * $limit = 5 and $offset = 0 will return the last 5 articles created \
     * $limit = 5 and $offset = 5 will return the last 5 articles created BEFORE
     * the last 5 articles created
     * 
     * @param int $limit The SQL LIMIT
     * @param int $offset The SQL OFFSET
     * 
     * @return array An array containing articles \
     * The articles are arrays indexed by their column name, or an empty array
     * if there are no article
     * 
     * @throws Exception
     */
    public function fetchArticlesLimited(int $limit, int $offset): array
    {
        try {
            $statement = $this->pdo->prepare('SELECT * FROM articles ORDER BY id DESC LIMIT :limit OFFSET :offset');
            $statement->bindValue(':limit', $limit);
            $statement->bindValue(':offset', $offset);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            throw new Exception('Failed to fetch the articles');
        }
    }

    /**
     * Get the number of articles in the database
     * 
     * @return int The number of articles in the database
     * 
     * @throws Exception
     */
    public function getCountArticles(): int
    {
        try {
            return (int) $this->pdo->query('SELECT COUNT(*) FROM articles')->fetchColumn();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            throw new Exception('Failed to get articles count');
        }
    }

    /**
     * Check if a username is in the database
     * 
     * @param string $username The username to check
     * 
     * @return bool true if the username is in the database, false otherwise
     * 
     * @throws Exception
     */
    public function isUsernameInDatabase(string $username): bool
    {
        try {
            $statement = $this->pdo->prepare('SELECT COUNT(*) FROM users WHERE username = :username');
            $statement->bindValue(':username', $username);
            $statement->execute();
            $rowCount = (int) $statement->fetchColumn();

            return $rowCount != 0;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            throw new Exception();
        }
    }

    /**
     * Insert a user into the database
     * 
     * @param string $username The username of the user
     * @param string $password The hashed password of the user
     * 
     * @throws Exception
     */
    public function insertUser(string $username, string $password): void
    {
        try {
            $statement = $this->pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
            $statement->bindValue(':username', $username);
            $statement->bindValue(':password', $password);
            $statement->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            throw new Exception('Failed to insert the user');
        }
    }

    /**
     * Fetch a user id and hashed password from the database
     * 
     * @param string $username The username of the user
     * 
     * @return array An array containing the id and the hashed password of the
     * user indexed by their column name, or an empty array if the user is not
     * in the database
     * 
     * @throws Exception
     */
    public function fetchUser(string $username): array
    {
        try {
            $statement = $this->pdo->prepare('SELECT id, password FROM users WHERE username = :username');
            $statement->bindValue(':username', $username);
            $statement->execute();

            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            throw new Exception('Failed to fetch the user');
        }
    }
}
