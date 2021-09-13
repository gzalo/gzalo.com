---
title: "Utilities for Digital Systems classes"
summary: "Software I made to assist with the development of FPGA systems that include a VGA output."
thumbnail: "/thumbs/cordic.png"
date: "2015-01-01"
---

These are a couple of tools that I created in 2015 to help when creating of FPGA-based systems:
- VCD parser: converts `R`, `G`, `B`, `VerticalSync` and `HorizontalSync` signals into an image
- Point sender: sends a list of points through a serial port
- PNG to Character ROM: converts an image into a VHDL code describing a read only memory, and each bit maps to a pixel from the image
- CORDIC rotation simulation: simulates that algorithm for 3D rotations, and shows how the iteration count changes the quality

**[Access source code in the repository](https://github.com/gzalo/sistemas-digitales)**
