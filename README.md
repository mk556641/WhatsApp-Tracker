WhatsApp-Tracker
================

- A tool that checks the last time online whether the user has enabled or disabled the last seen time.
- Una herramienta que permite ver la última hora de cualquier usuario de WhatsApp, independientemente de que tenga la última hora en línea oculta.

![WATracker](http://cl.ly/image/1P331F2S3q0b/watracker.png)

----------
***Español/Spanish***

### ¿Qué es WhatsApp Tracker?

Es una herramienta que permite rastrear los últimos tiempos en línea del usuario. Para usuarios que tengan activa la última hora en línea, no es que sea muy útil, pues cualquiera puede ver cuando fue la última vez se conectó. Pero esta herramienta te permitirá saber también cuando fue la última vez que se conecto un usuario que tenga 'la última vez en línea' invisible.

Actualmente hay dos posibles formas para mostrar los tiempos en línea del usuario, o bien por pantalla o bien de forma remota. De forma remota, irá enviandote al número de teléfono que tú le asignes un log de la última vez en línea.

Esta basado en [WhatsAPI](https://github.com/venomous0x/WhatsAPI) un proyecto que esta llevando [Shirioko](https://github.com/shirioko) y la comunidad :)

### ¿Motivo de este script?

Más que nada para demostrar que no existe privacidad y que se puede automatizar la monitorización de cualquier usuario.

***Sinceramente***, hay clientes más seguros que WhatsApp.

### Comandos

php watracker.php

Una lista con los comandos que actualmente tiene el programa:

- ***-check < numero >*** Te muestra por pantalla la última hora en línea del usuario. (solo funciona con usuarios que tengan visible su última hora en línea).
- ***-cRemote0 < tuNumero > < numero >*** Te muestra por pantalla la última hora en línea del usuario y te mando un log al número que tu le asignes. (solo funciona con usuarios que tengan visible su última hora en línea).
- ***-cHidden < numero >*** Te muestra por pantalla la última hora en línea del usuario. (Funciona para todos los usuarios, enfocado para los que lo tienen en invisible).
- ***-cRemote1 < tuNumero > < numero >*** Te muestra por pantalla la última hora en línea del usuario y te manda un log al número que tu le asignes. (Funciona para todos los usuarios, enfocado para los que lo tienen en invisible).

----------
***Inglés/English***

### What is WhatsApp Tracker?

It's a tool that allows to track when the user is online or offline, wether the user has the "last seen" hidden or not. For users who have active the last time online, it is not very useful, as anyone can see when was the last time he was online. But this tool also lets you know when was the last time of a user with 'last online' hidden.

There are currently two ways to display the user's last seen time, by screen or remotely. Remotely will send you a log of the user you are tracking.

It is based on [WhatsAPI](https://github.com/venomous0x/WhatsAPI) a project that is taking [Shirioko](https://github.com/shirioko) and community :)


### The reason for this script?

More than anything to show that there is no privacy and can automate monitoring of any user.

***Honestly***, there are clients with better privacy.

### Commands

php watracker.php

A list of commands that the program currently has:

- ***-check < number >*** It shows on screen the last time the user was online every minute. (only works for users who have their last seen visible).
- ***-cRemote0 < yourNumber > < number >*** It shows on screen and send a message to the mobile you assign the log of the last time the user was online every minute. (only works for users who have their last seen visible).
- ***-cHidden < number >*** It shows on screen the last time the user was online. (Works for all users, focused to those who has the last seen time hidden).
- ***-cRemote1 < yourNumber > < number >*** It shows on screen and send a message to the mobile you assign the log of the last time the user was online. (Works for all users, focused to those who has the last seen time hidden).