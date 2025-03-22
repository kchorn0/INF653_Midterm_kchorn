CREATE DATABASE quotesdb;


SELECT current_database();


-- Swtich new querey folder..idk
\c quotesdb_lbff;

-- Create authors table
CREATE TABLE authors (
    id SERIAL PRIMARY KEY,
    author VARCHAR(255) NOT NULL
);

-- Create categories table
CREATE TABLE categories (
    id SERIAL PRIMARY KEY,
    category VARCHAR(255) NOT NULL
);

-- Create quotes table
CREATE TABLE quotes (
    id SERIAL PRIMARY KEY,
    quote TEXT NOT NULL,
    author_id INT NOT NULL,
    category_id INT NOT NULL,
    FOREIGN KEY (author_id) REFERENCES authors(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- Insert Categories
INSERT INTO categories (category) VALUES
('Life'),
('Funny'),
('Love'),
('Music'),
('Hope');

-- Insert Authors
INSERT INTO authors (author) VALUES
('Rose Kennedy'),
('John Lennon'),
('Donald Trump'),
('Paul Cezanne'),
('Socrates'),
('Will Rogers'),
('Elbert Hubbard'),
('Abraham Lincoln'),
('Mitch Hedberg'),
('Steve Martin'),
('Aristotle'),
('David Viscott'),
('Lao Tzu'),
('Lord Byron'),
('Tom Robbins'),
('Martin Luther'),
('Leo Tolstoy'),
('T. S. Eliot'),
('Dick Clark'),
('Mickey Hart'),
('Magic Johnson'),
('Jonas Salk'),
('Jesse Jackson'),
('Elie Wiesel'),
('Billy Graham'),
('John Wayne');

-- Insert Quotes
INSERT INTO quotes (quote, author_id, category_id) VALUES
('Life isnt a matter of milestones but of moments.', 1, 1),
('Life is what happens while you are busy making other plans.', 2, 1),
('Everything in life is luck.', 3, 1),
('We live in a rainbow of chaos.', 4, 1),
('Not life but good life is to be chiefly valued.', 5, 1),

('I am not a member of any organized political party. I am a Democrat.', 6, 2),
('Do not take life too seriously. You will never get out of it alive.', 7, 2),
('No man has a good enough memory to be a successful liar.', 8, 2),
('My fake plants died because I did not pretend to water them.', 9, 2),
('A day without sunshine is like you know night.', 10, 2),

('Love is composed of a single soul inhabiting two bodies.', 11, 3),
('To love and be loved is to feel the sun from both sides.', 12, 3),
('Being deeply loved by someone gives you strength while loving someone deeply gives you courage.', 13, 3),
('Friendship is Love without his wings!', 14, 3),
('We waste time looking for the perfect lover instead of creating the perfect love.', 15, 3),

('Beautiful music is the art of the prophets that can calm the agitations of the soul; it is one of the most magnificent and delightful presents God has given us.', 16, 4),
('Music is the shorthand of emotion.', 17, 4),
('You are the music while the music lasts.', 18, 4),
('Music is the soundtrack of your life.', 19, 4),
('Theres nothing like music to relieve the soul and uplift it.', 20, 4),

('All kids need is a little help a little hope and somebody who believes in them.', 21, 5),
('Hope lies in dreams in imagination and in the courage of those who dare to make dreams into reality.', 22, 5),
('At the end of the day we must go forward with hope and not backward by fear and division.', 23, 5),
('Hope is like peace. It is not a gift from God. It is a gift only we can give one another.', 24, 5),
('Gods mercy and grace give me hope for myself and for our world.', 25, 5),
('Tomorrow hopes we have learned something from yesterday.', 26, 5);



--Show results in DB
SELECT 
    quotes.id, 
    authors.author, 
    categories.category, 
    quotes.quote 
FROM quotes
JOIN authors ON quotes.author_id = authors.id
JOIN categories ON quotes.category_id = categories.id;




-- Your author with the id = 5 should have two quotes in the category id = 4
INSERT INTO quotes (quote, author_id, category_id) 
VALUES 
('I cannot teach anybody anything; I can only make them think', 5, 4),
('Wonder is the beginning of wisdom', 5, 4);



--Show author5 and category4 
SELECT * FROM quotes WHERE author_id = 5 AND category_id = 4;
