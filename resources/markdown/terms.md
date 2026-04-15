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

### 4t Sprint

- CRUD complet de vídeos via **`VideosManageController`**: `index`, `create`, `store`, `show`, `edit`, `update`, `delete`, `destroy`.
- Funció **`index()`** a `VideosController` per llistar tots els vídeos publicats.
- Tres vídeos per defecte: `defaultVideo()`, `defaultVideo2()`, `defaultVideo3()` als helpers i al DatabaseSeeder.
- Nous permisos CRUD: **`create-videos`**, **`edit-videos`**, **`delete-videos`** (afegits a `create_permissions()` i `define_gates()`).
- **`create_video_manager_user()`** assigna els 4 permisos CRUD al Video Manager.
- Vistes del CRUD de gestió: `manage/index.blade.php`, `manage/create.blade.php`, `manage/edit.blade.php`, `manage/delete.blade.php` (amb atribut `data-qa`).
- Vista pública **`videos/index.blade.php`** amb llistat de vídeos estil YouTube (miniatures, títol, data).
- Rutes CRUD protegides per gate + ruta pública `/videos` per a l'índex.
- **Navbar i footer** afegits al layout `videos-app.blade.php` amb navegació entre pàgines.
- Tests: `UserTest`, `VideosTest` (+3 tests índex) i `VideosManageControllerTest` (+10 tests CRUD) seguint **TDD + AAA**.
- Verificació de 0 errors amb **Larastan**.

### 5è Sprint

- Afegit el camp **`user_id`** a la taula de vídeos (migració amb clau forana nullable, cascade a null en eliminar l'usuari).
- Model `Video` actualitzat: `user_id` al `$fillable` i relació `BelongsTo` amb `User`.
- `VideosManageController::store()` assigna automàticament `user_id = auth()->id()` en crear un vídeo.
- Nou **`UsersController`** amb funcions `index()` (llistat d'usuaris amb cercador) i `show()` (perfil d'usuari i els seus vídeos).
- Nou **`UsersManageController`** amb CRUD complet: `index`, `create`, `store`, `edit`, `update`, `delete`, `destroy`.
- Nous permisos CRUD d'usuaris: **`manage-users`**, **`create-users`**, **`edit-users`**, **`delete-users`** (afegits a `create_permissions()` i `define_gates()`).
- **`create_superadmin_user()`** assigna els 4 permisos de gestió d'usuaris al Super Admin.
- Vistes CRUD de gestió d'usuaris: `users/manage/index.blade.php`, `users/manage/create.blade.php`, `users/manage/edit.blade.php`, `users/manage/delete.blade.php` (amb atribut `data-qa`).
- Vista pública **`users/index.blade.php`** amb llistat d'usuaris i cercador, i **`users/show.blade.php`** amb perfil i vídeos de l'usuari.
- Rutes d'usuaris protegides per gate (manage) i per auth (index i show), amb l'ordre correcte per evitar conflictes amb el wildcard `{user}`.
- Tests `UsersTest` (6 tests: index i show per 3 rols) i `UsersManageControllerTest` (14 tests CRUD per 3 rols) seguint **TDD + AAA**.
- Verificació de 0 errors amb **Larastan**.

### 6è Sprint

- Nova migració **`create_series_table`**: taula `series` amb els camps `id`, `title`, `description`, `image` (nullable), `user_name`, `user_photo_url` (nullable), `published_at` (nullable), `timestamps`.
- Nova migració **`add_series_foreign_key_to_videos_table`**: afegeix clau forana de `videos.series_id` cap a `series.id` amb `nullOnDelete`.
- Nou model **`Serie`** amb: `$fillable`, `testedBy()`, relació `videos()` (HasMany Video), i accessors de data en català (`getFormattedCreatedAtAttribute`, `getFormattedForHumansCreatedAtAttribute`, `getCreatedAtTimestampAttribute`).
- Model `Video` actualitzat: afegida relació `serie()` (BelongsTo Serie).
- Nous helpers: **`create_series()`** (crea 3 sèries per defecte), 4 nous permisos de sèries (`manage-series`, `create-series`, `edit-series`, `delete-series`) a `create_permissions()` i `define_gates()`.
- `create_superadmin_user()` i `create_video_manager_user()` assignen ara també els 4 permisos de sèries.
- Nou **`SeriesController`** amb `index()` (llistat amb cercador) i `show()` (vídeos de la sèrie).
- Nou **`SeriesManageController`** amb CRUD complet: `index`, `create`, `store`, `edit`, `update`, `delete`, `destroy`.
- Vistes CRUD de gestió: `series/manage/index.blade.php`, `series/manage/create.blade.php`, `series/manage/edit.blade.php`, `series/manage/delete.blade.php` (amb `data-qa`).
- Vista pública **`series/index.blade.php`** amb llistat de sèries i cercador, i **`series/show.blade.php`** amb els vídeos de la sèrie.
- Rutes de sèries protegides per gate (manage) i per auth (index i show), amb l'ordre correcte (`/series/manage` abans del wildcard `{serie}`).
- Factory **`SerieFactory`** per als tests.
- Tests unitaris `SerieTest` (1 test: `serie_have_videos`), tests feature `SeriesTest` (3 tests: index, show, guest) i `SeriesManageControllerTest` (15 tests CRUD per 3 rols) seguint **TDD + AAA**.
- Correcció Larastan: `UsersManageController::update()` simplificada la comparació de password.
- Resultat final: **111 tests passats**, 7 skipped (API), 0 fallats.
- Verificació de 0 errors amb **Larastan**.

---

## Alumne

- **Nom:** Miquel Dieguez
- **Curs:** DAM
- **Professor:** Jan Almudeve
- **Assignatures:** M7, M8, M9
