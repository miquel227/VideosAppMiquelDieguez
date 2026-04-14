# Termes del servei — VideosAppMiquelDieguez

## Sobre el projecte

**VideosAppMiquelDieguez** és una aplicació web de gestió i visualització de vídeos, similar a YouTube, desenvolupada com a projecte de final de curs del cicle formatiu **DAM (Desenvolupament d'Aplicacions Multiplataforma)**.

L'aplicació ha estat construïda amb **Laravel + Jetstream (Livewire)** i permet als usuaris registrar-se, iniciar sessió i visualitzar vídeos publicats a la plataforma.

---

## Què s'ha fet als dos sprints

### 1r Sprint

- Creació del projecte Laravel amb el nom **VideosAppMiquelDieguez**.
- Instal·lació i configuració de **Jetstream amb Livewire i Teams**.
- Configuració de la base de dades **SQLite**.
- Creació dels **helpers** `defaultUser()` i `defaultProfessor()` amb credencials llegides del `.env`.
- Tests unitaris dels helpers seguint la metodologia **TDD i el patró AAA**.
- Publicació del codi a **GitHub**.

### 2n Sprint

- Creació del **Model Video** amb accessors de dates en català (Carbon).
- Creació del **VideosController** amb la funció `show`.
- Creació del **layout VideosAppLayout** per a les pàgines de vídeos.
- Creació de la **ruta i vista** per visualitzar un vídeo.
- Helper `defaultVideo()` i actualització del **DatabaseSeeder**.
- Tests unitaris i de funcionalitat per als vídeos (**TDD + AAA**).
- Instal·lació i configuració de **Larastan** (nivell 5) amb 0 errors detectats.

---

## Alumne

- **Nom:** Miquel Dieguez
- **Curs:** DAM
- **Professor:** Jan Almudeve
- **Assignatures:** M7, M8, M9
