---
title: "Using GPS modules with microcontrollers"
tags: ["articles", "electronics"]
summary: "How to get the position from a GPS module, by parsing the NMEA strings."
thumbnail: "/thumbs/gps.png"
aliases: ["/gps_en/"]
date: "2010-01-01"
---
This information should work with any GPS module (it was tested with an [ET-332](http://www.globalsat.co.uk/product_pages/product_et332.htm)) that transmits data via a serial port, using the NMEA protocol.

The main output of the GPS module are lots of NMEA strings, generally more than 10 per second, separated by carriage return and line feed characters. The most interesting one for typical applications is the one starting with GPGGA. For instance: `$GPGGA,182402.02,3436.5829,S,05825.7855,W,1,04,1.5,57,M,-34.0,M,,,*70`

Each field has a different information:
	
* `$GPGGA`: String identifier
* `182402.02`: Time (en GMT)
* `3436.5829,S`: Latitude (34º 36.5829' South)
* `05825.7855,W`: Longitude (58º 25.7855' West)
* `1`: Is the fix valid? If 0, the data may have been extrapolated from old positions
* `04`: Amount of satellites used to get position
* `1.5`: Dilution of precision (see [HDOP](http://en.wikipedia.org/wiki/Dilution_of_precision_(GPS)))
* `57,M`: Altitude (meters above sea level)
* `-34.0,M`: Altitude respect to [WGS84](http://en.wikipedia.org/wiki/World_Geodetic_System) reference system
* `*70`: Checksum, calculated as a XOR of every byte between $ and *

A simple way to parse the data from a microcontroller is to store every line (from $ until \r\n) in a buffer, and then analize them. This is more complex in low memory devices, since the strings tend to have around 80 characters.

An alternate way would be to parse the string when it arrives, using a state machine, and in such a way that the interrupt routine remembers in which field it is, and saving all desired data into variables.
