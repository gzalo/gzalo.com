---
title: "Genico - Numeric icon generator"
summary: "A numeric icon generator, very useful for working with HMI display, like DGUS (DWIN) / SGUS / VGUS."
thumbnail: "/thumbs/genico.png"
date: "2019-01-01"
---

This is a small project developed to generate iconsets containing all digits, a decimal dot and the minus sign. It's very useful for working with HMI screens like DGUS (DWIN) / SGUS / VGUS. By default they don't feature high quality fonts (particularly when displaying numbers).

The code is quite simple and is contained within a single file, and it's quite easy to modify it to increase the limits of the parameters and to add new fonts (which can be installed locally on the system). 

It uses Vue to update all the icons (which are drawn using Canvas) whenever any parameter is modified. When pressing the save button, `FileSaver.js` is used to export all the 12 generated files as PNG files.

**[Launch icon generator](https://genico.gzalo.com/)**

**[Access and download source code from the repository](https://github.com/gzalo/genico/) (Licence: MIT)**
