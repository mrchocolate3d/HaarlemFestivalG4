-- Jazz Arists
INSERT INTO artist (name, description, genre)
VALUES ("Gumbo Kings", "Description", "Classic Jazz");

INSERT INTO artist (name, description, genre)
VALUES ("Evolve", "Description", "Classic Jazz");

INSERT INTO artist (name, description, genre)
VALUES ("Ntjam Rosie", "Description", "Classic Jazz");

INSERT INTO artist (name, description, genre)
VALUES ("Wicked Jazz Sounds", "Description", "Classic Jazz");

INSERT INTO artist (name, description, genre)
VALUES ("Tom Thomson Assemble", "Description", "Classic Jazz");

INSERT INTO artist (name, description, genre)
VALUES ("Jonna Frazer", "Description", "Classic Jazz");

INSERT INTO artist (name, description, genre)
VALUES ("Fox & The Mayors", "Description", "Classic Jazz");

INSERT INTO artist (name, description, genre)
VALUES ("Uncle Sue", "Description", "Classic Jazz");

INSERT INTO artist (name, description, genre)
VALUES ("Chris Allen", "Description", "Classic Jazz");

INSERT INTO artist (name, description, genre)
VALUES ("Myles Sanko", "Description", "Classic Jazz");

INSERT INTO artist (name, description, genre)
VALUES ("Ruis Soundsystem", "Description", "Classic Jazz");

INSERT INTO artist (name, description, genre)
VALUES ("The Family XL", "Description", "Classic Jazz");

INSERT INTO artist (name, description, genre)
VALUES ("Gare du Nord", "Description", "Classic Jazz");

INSERT INTO artist (name, description, genre)
VALUES ("Rilan & The Bombadiers", "Description", "Classic Jazz");

INSERT INTO artist (name, description, genre)
VALUES ("Soul Six", "Description", "Classic Jazz");

INSERT INTO artist (name, description, genre)
VALUES ("Han Bennick", "Description", "Classic Jazz");

INSERT INTO artist (name, description, genre)
VALUES ("The Nordanians Lilith Merlot", "Description", "Classic Jazz");

-- Jazz Locations
INSERT INTO location(location_name, description, capacity)
VALUES ("Patronaat", "Main Hall", 300);

INSERT INTO location(location_name, description, capacity)
VALUES ("Patronaat", "Second Hall", 200);

INSERT INTO location(location_name, description, capacity)
VALUES ("Patronaat", "Third Hall", 150);

INSERT INTO location(location_name, description, capacity)
VALUES ("Grote Markt", "Main Stage", 5000);

-- Jazz Events
INSERT INTO event(event_name, category, start_time, end_time, event_date, location_id)
VALUES ("Gumbo Kings Patronaat", "Jazz", "18:00:00", "19:00:00", "2021-07-26", 
(
    SELECT location_id FROM location
    WHERE location_name = "Patronaat" AND description ="Main Hall"
));

INSERT INTO jazz_event (artist_id, event_id)
VALUES(
    (
        SELECT artist_id from artist
        WHERE artist_name = "Gumbo Kings"
    ),
    (
        SELECT event_id from event
        WHERE event_name = "Gumbo Kings Patronaat"
    )
);
INSERT INTO ticket (event_id, ticket_quantity, ticket_price)
SELECT event.event_id,
    location.capacity,
    15.00 AS ticket_price
FROM event
INNER JOIN location ON event.location_id = location.location_id
WHERE event.event_name = "Gumbo Kings Patronaat";