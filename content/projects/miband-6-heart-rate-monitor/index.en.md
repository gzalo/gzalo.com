---
title: "Mi Band 6 Heart Rate Monitor (2022)"
summary: "Display your Mi Band 6's heart rate in the browser."
thumbnail: "/thumbs/miband-6-heart-rate-monitor.png"
date: "2022-01-18"
---

This is a basic website that can display your heart rate from a Mi Band 6 smartwatch in a browser window. Basically it's an improvement over miband-5-heart-rate-monitor, modified so it supports the version 6 of the watch (it contains a totally different authentication flow over BLE).

Uses [my own WASM port](https://github.com/gzalo/tiny-ECDH-wasm) of the [tiny-ECDH-c](https://github.com/kokke/tiny-ECDH-c) library to implement the new auth method (that uses Elliptic-curve Diffie–Hellman - ECDH). 

**[Access the repository with the live demo](https://github.com/gzalo/miband-6-heart-rate-monitor)**
