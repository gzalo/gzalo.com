---
title: "Using GPS modules with microcontrollers"
tags: ["articles", "electronics"]
summary: "How to get the position from a GPS module, by parsing the NMEA strings."
thumbnail: "/thumbs/gps.jpg"
aliases: ["/gps_en/"]
date: "2010-01-01"
---
This information should work with any GPS module that transmits data via a serial port using the NMEA protocol.

The main output of GPS modules are many NMEA strings, at least 10 of them per second (separated by carriage return and line feed characters). The most interesting one for typical applications is the one that starts with `GPGGA`. For instance: `$GPGGA,182402.02,3436.5829,S,05825.7855,W,1,04,1.5,57,M,-34.0,M,,,*70`

Each field contains different useful data:
	
* `$GPGGA`: String identifier
* `182402.02`: Time (en GMT)
* `3436.5829,S`: Latitude (34º 36.5829' South)
* `05825.7855,W`: Longitude (58º 25.7855' West)
* `1`: Is the fix valid? If 0, the data may have been extrapolated from old positions
* `04`: Amount of satellites that were used to get this position
* `1.5`: Dilution of precision (see [HDOP](https://en.wikipedia.org/wiki/Dilution_of_precision_(GPS)))
* `57,M`: Altitude (meters above sea level)
* `-34.0,M`: Altitude respect to [WGS84](https://en.wikipedia.org/wiki/World_Geodetic_System) reference system
* `*70`: Checksum, calculated as the XOR of every byte between $ and *

A simple way to parse the data from a microcontroller is to store every line (from $ until \r\n) in a buffer and then analyze them. This is harder to do in low memory devices since the strings tend to have around 80 characters.

An alternate way is parsing the string as it arrives, using a state machine. For example, the interrupt routine that executes when a byte is received could remember the current field identifier, and save all required data into multiple variables.
