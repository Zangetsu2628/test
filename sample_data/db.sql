/*Sample data to create and fill the tables*/
CREATE DATABASE Test;

CREATE TABLE Test.Shelves (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(64) NOT NULL,
  PRIMARY KEY (id));

CREATE TABLE Test.Shelf_books (
  id INT NOT NULL AUTO_INCREMENT,
  book_name VARCHAR(64) NOT NULL,
  shelf_id INT NOT NULL,
  PRIMARY KEY (id));

CREATE TABLE Test.Songs (
  id INT NOT NULL AUTO_INCREMENT,
  song VARCHAR(64) NOT NULL,
  artist VARCHAR(64) NOT NULL,
  PRIMARY KEY (id));

/*Input Data*/
INSERT INTO Test.Shelves (name) VALUES ('History');
INSERT INTO Test.Shelves (name) VALUES ('Novels');
INSERT INTO Test.Shelves (name) VALUES ('Science Fiction');

INSERT INTO Test.Shelf_books (book_name, shelf_id) VALUES ('The English and Their History', 1);
INSERT INTO Test.Shelf_books (book_name, shelf_id) VALUES ('SPQR: A History of Ancient Rome', 1);
INSERT INTO Test.Shelf_books (book_name, shelf_id) VALUES ('Beautiful Idiots and Brilliant Lunatics', 1);
INSERT INTO Test.Shelf_books (book_name, shelf_id) VALUES ('Magna Carta', 1);
INSERT INTO Test.Shelf_books (book_name, shelf_id) VALUES ('Night Walking', 1);
INSERT INTO Test.Shelf_books (book_name, shelf_id) VALUES ('The Kite Runner', 2);
INSERT INTO Test.Shelf_books (book_name, shelf_id) VALUES ('Number the Stars', 2);
INSERT INTO Test.Shelf_books (book_name, shelf_id) VALUES ('Pride and Prejudice', 2);
INSERT INTO Test.Shelf_books (book_name, shelf_id) VALUES ('The Outsiders', 2);
INSERT INTO Test.Shelf_books (book_name, shelf_id) VALUES ('Little Women', 2);
INSERT INTO Test.Shelf_books (book_name, shelf_id) VALUES ('Dune', 3);
INSERT INTO Test.Shelf_books (book_name, shelf_id) VALUES ('The Moon is a Harsh Mistress', 3);
INSERT INTO Test.Shelf_books (book_name, shelf_id) VALUES ('Hyperion', 3);
INSERT INTO Test.Shelf_books (book_name, shelf_id) VALUES ('Neuromancer', 3);
INSERT INTO Test.Shelf_books (book_name, shelf_id) VALUES ('Use of Weapons', 3);

INSERT INTO Test.Songs (song, artist) VALUES ('Shape Of You', 'Ed Sheeran');
INSERT INTO Test.Songs (song, artist) VALUES ('Bad And Boujee', 'Migos Featuring Lil Uzi Vert');
INSERT INTO Test.Songs (song, artist) VALUES ('I Dont Wanna Live Forever (Fifty Shades Darker)', 'Machine Gun Kelly x Camila Cabello');
INSERT INTO Test.Songs (song, artist) VALUES ('Bad Things', 'The Chainsmokers Featuring Halsey');
INSERT INTO Test.Songs (song, artist) VALUES ('Closer', 'Maroon 5 Featuring Kendrick Lamar');
INSERT INTO Test.Songs (song, artist) VALUES ('Dont Wanna know', 'The Weeknd Featuring Daft Punk');
INSERT INTO Test.Songs (song, artist) VALUES ('Star Boy', 'Drake');
INSERT INTO Test.Songs (song, artist) VALUES ('Fake Love', 'Rae Sremmurd Featuring Gucci Mane');
INSERT INTO Test.Songs (song, artist) VALUES ('Black Beatles', 'Alessia Cara');
INSERT INTO Test.Songs (song, artist) VALUES ('Scars To Your Beautiful', 'The Chainsmokers');