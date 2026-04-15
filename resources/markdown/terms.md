# Termes del servei — VideosAppMiquelDieguez

## Sobre el projecte

**VideosAppMiquelDieguez** és una aplicació web de gestió i visualització de vídeos, similar a YouTube, desenvolupada com a projecte de final de curs del cicle formatiu **DAM (Desenvolupament d'Aplicacions Multiplataforma)**.

L'aplicació ha estat construïda amb **Laravel + Jetstream (Livewire)** i permet als usuaris registrar-se, iniciar sessió i visualitzar vídeos publicats a la plataforma.

---

## Què s'ha fet als sprints

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

### 3r Sprint

- Instal·lació de **`spatie/laravel-permission`** per a la gestió de permisos basada en rols.
- Nova migració: camp `super_admin` (boolean, default false) afegit a la taula `users`.
- Model `User` ampliat amb el trait `HasRoles`, el mètode `isSuperAdmin()` i `testedBy()`.
- Refactorització de `helpers.php`: extracció de `add_personal_team()`, assignació de `super_admin = true` al professor, creació de `create_regular_user()`, `create_video_manager_user()`, `create_superadmin_user()`, `define_gates()` i `create_permissions()`.
- `AppServiceProvider::boot()` inicialitza les **portes d'accés (gates)** de l'aplicació.
- Nou **`VideosManageController`** amb ruta `/videos/manage` protegida per gate `manage-videos`.
- **DatabaseSeeder** actualitzat amb els tres nous usuaris i els permisos Spatie.
- Tests unitaris `UserTest` (funció `isSuperAdmin()`) i feature tests `VideosManageControllerTest` (accés per rols) seguint **TDD + AAA**.
- Publicació dels **stubs** de Laravel per personalitzar la generació de codi.
- Verificació de 0 errors amb **Larastan**.

---

## Alumne

- **Nom:** Miquel Dieguez
- **Curs:** DAM
- **Professor:** Jan Almudeve
- **Assignatures:** M7, M8, M9
