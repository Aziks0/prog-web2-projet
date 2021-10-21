<?php

class ORM
{
    private PDO $pdo;

    public function __construc()
    {
        $this->pdo = new PDO('sqlite:' . dirname(__FILE__) . '/database.db');

        $this->createTables();
    }

    /**
     * Create a users and an articles table if they do not exist
     */
    private function createTables(): void
    {
        $this->pdo->query('CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        )');

        $this->pdo->query('CREATE TABLE IF NOT EXISTS articles (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title VARCHAR(100) NOT NULL,
            body TEXT NOT NULL,
            category VARCHAR(20) NOT NULL
        )');
    }

    /**
     * Insert an article into the database
     * 
     * @param string $title The title of the article
     * @param string $body The body of the article
     * @param string $category The category of the article
     */
    public function insertArticle(string $title, string $body, string $category): void
    {
        $statement = $this->pdo->prepare('INSERT INTO articles (title, body, category) VALUES (:title, :body, :category)');
        $statement->bindValue(':title', $title);
        $statement->bindValue(':body', $body);
        $statement->bindValue(':category', $category);
        $statement->execute();
    }

    /**
     * Fetch articles from the database
     * 
     * @return array An array containing all articles, the articles are arrays
     * indexed by their column name, or an empy array if there are no article
     */
    public function fetchArticles(): array
    {
        return $this->pdo->query('SELECT * FROM articles')->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Check if a username is in the database
     * 
     * @param string $username The username to check
     * 
     * @return bool true if the username is in the database, false otherwise
     */
    public function isUsernameInDatabase(string $username): bool
    {
        $statement = $this->pdo->prepare('SELECT COUNT(*) FROM users WHERE username = :username');
        $statement->bindValue(':username', $username);
        $statement->execute();
        $rowCount = (int) $statement->fetchColumn();

        return $rowCount == 0 ? false : true;
    }

    /**
     * Insert a user into the database
     * 
     * @param string $username The username of the user
     * @param string $password The hashed password of the user
     */
    public function insertUser(string $username, string $password): void
    {
        $statement = $this->pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();
    }

    /**
     * Fetch a user id and hashed password from the database
     * 
     * @param string $username The username of the user
     * 
     * @return array An array containing the id and the hashed password of the
     * user indexed by their column name, or an empty array if the user is not in the database
     */
    public function fetchUser(string $username): array
    {
        $statement = $this->pdo->prepare('SELECT id, password FROM users WHERE username = :username');
        $statement->bindValue(':username', $username);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
