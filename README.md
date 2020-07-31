# traditional-lands

A dataset that attempts to show the closest traditional Indigenous Australian land names based on a postcode.

Central GPS coordiantes of Traditional Land names where from Tindale's Map produced in 1974 (see notes from SA Museum).

Results in: postcode2landname.csv
Includes postcode, land name, GPS Coordinates

For each postcode, there may be multiple land names due to suburbs within the postcode being closer to different centers of traditional lands. This could be used to present the user with multiple options to manually select the correct region.


Description of Tindale's map data by South Australian Museum - http://archives.samuseum.sa.gov.au/tindaletribes/index.html
"This is the full catalogue of Aboriginal language groups, described by Tindale as 'tribes', as published by him in his 1974 book Aboriginal Tribes of Australia. Their Terrain, Environmental Controls, Distribution, Limits, and Proper Names. This book serves as a catalogue to the tribal map.

The information on this catalogue is reproduced from NB Tindale's Aboriginal Tribes of Australia (1974). Please be aware that much of the data relating to Aboriginal language group distribution and definition has undergone revision since 1974. Please note also that this catalogue represents Tindale's attempt to depict Aboriginal tribal distribution at the time of European contact."

Note that 'tribes' was used for clarity in code during extraction, however otherwise referred to as lands.

Land data from Tindale http://archives.samuseum.sa.gov.au/tindaletribes/
postcode data from Matthew Proctor https://www.matthewproctor.com/australian_postcodes
distance calc from martinstoeckli https://stackoverflow.com/a/10054282


** WordCloud Generator
Using wordcloud2.js
Demo page at https://whose.country

index.php + MySQL DB with two tables

CREATE TABLE inputCount (
    nam varchar(40),
    lat FLOAT(24),
    lon FLOAT(24),
    cnt INT(255)
);

CREATE TABLE postcode (
    nam varchar(40),
    code INT(255)
);

Populate with data from postcode2landname.csv

Future potential improvements:
styling, conference session id, cleanup data
