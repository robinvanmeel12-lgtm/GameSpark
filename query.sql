-- TABLE creation

CREATE TABLE gamespark.gamedata (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    platform VARCHAR(100) NOT NULL,
    genre VARCHAR(100) NULL,
    release_year SMALLINT NOT NULL,
    status ENUM('Wishlist', 'In bezit', 'Speelt nu', 'Uitgespeeld') NOT NULL,
    rating DECIMAL(3, 1) NULL,
    image_url VARCHAR(2048) NULL
) ENGINE = InnoDB;

-- CONSTRAINTS added

ALTER TABLE 'gamespark'.'gamedata'
    ADD CONSTRAINT 'unique_game' UNIQUE ('name', 'release_year'),
    ADD CONSTRAINT 'valid_release_year' CHECK ('release_year' BETWEEN 1000 AND 9999),
    ADD CONSTRAINT 'valid_rating' CHECK ('rating' BETWEEN 1 AND 10);