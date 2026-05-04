# AWP sample exam (40 + 40)

This repository contains an **exam** starter (`exam/`) and a **reference solution** (`solution/`). Part 1 is server-side (Laravel **Garden**). Part 2 is client-side (three small React + TypeScript apps).


| Area                                           | Points | Pass threshold |
| ---------------------------------------------- | ------ | -------------- |
| Part 1 — Laravel (`exam/tasks-laravel/Garden`) | 40     | ≥ 40% (16 pts) |
| Part 2 — React (`exam/tasks-react/*`)          | 40     | ≥ 40% (16 pts) |


Overall exam rules (as communicated on the course): both parts must reach at least **40%**; the exam is in-person and supervised; you may bring prepared materials and **official language documentation** only; **no public internet** during the exam. The `**03-rest-holidays`** task uses a **local Fastify API** (fixtures on disk) — not third-party HTTP APIs.

---

## Repository layout

```text
exam/
  tasks-laravel/Garden/     # Laravel starter (intentional gaps)
  tasks-react/
    01-weather-component/
    02-find-the-problems/
    03-rest-holidays/       # client/ (Vite) + server/ (Fastify)
solution/
  tasks-laravel/Garden/     # Full Laravel reference
  tasks-react/              # Same three apps, completed
```

Task descriptions and scoring are in **this README**. `**03-rest-holidays`** also has a short `**README.md**` at that task root (`client/` + `**server/**` layout).

---

## Part 1 — Laravel: **Garden** (40 points)

Short context: **plants** (`name`, `spot`, optional `care_note`). **Laravel Breeze** is installed — the **`plants/index`** starter already uses **`<x-app-layout>`** (with a header slot); the graded work there is to **iterate `$plants`** inside that shell, not to add or remove the layout wrapper. Also use **`PlantController`**, **`routes/web.php`**, and **`layouts/navigation.blade.php`** where the tasks require it. Set `APP_NAME=Garden` in `.env`. The **solution** may add “all vs my plants” / “added by” UX; ignore for marking unless your course says otherwise.

### Reference screenshots (`solution/tasks-laravel/Garden`)

Captured from the reference app after `migrate:fresh --seed`, `npm run build`, `php artisan serve`. Images are repo-relative `![](…)` paths. Optional: inline Laravel PNGs with `node scripts/embed-readme-images.mjs`.







**Three blocks (40 points):** **1 — Listing** (`/` guest home + `**/plants`** read UI, 10) · **2 — Many-to-many** (10) · **3 — Auth & create** (logged-in `**/`** redirect + nav + middleware + create, 20). Order: **1 → 2 → 3**.

---

### 1 — Listing: routes, `PlantController`, Blade (10 points)

**Scope:** public `**/`** (guest **home** + `plantCount`) and `**/plants`** listing (read UI). Authenticated user on `**/**` → **§3 — Home route** (redirect).

**Files:** `routes/web.php`, `PlantController`, `resources/views/` (`home`, `plants/`). Starter already has `plants` table, seeder, `user_id` migration.

- **a. (1 pt)** Register `**GET /`** and name the route `**home**`.
- **b. (1 pt)** Guest on `**/`** → show `**home**` with `**plantCount**` = `**Plant::count()**`.
- **c. (2 pts)** Register `**GET /plants`** → `**PlantController@index**`, route name `**plants.index**`.
- **d. (2 pts)** In `**index()`**, load all plants; `**return view('plants.index', compact('plants'))**` (no stub).
- **e. (2 pts)** `**plants/index.blade.php`:** Keep the starter’s `**<x-app-layout>`** and `**<x-slot name="header">…</x-slot>`** (do not strip or double-wrap the page). Replace the hard-coded demo card inside the grid with `**@foreach ($plants as $plant)`** (or equivalent) so the list is driven by the controller’s `**$plants**`.
- **f. (1 pt)** For each plant, show `**name**`, `**spot**`, and `**care_note**` when present, using the responsive Tailwind grid/card pattern from the starter (or equivalent readable layout).
- **g. (1 pt)** After `**migrate:fresh --seed`**, `**/plants**` renders without error.

---

### 2 — Many-to-many: pivot + Eloquent (10 points)

**Files:** new migration, `**User`**, `**Plant**`. Exam starter does **not** include the pivot migration.

- **a. (2 pts)** Migration creates `**plant_user`** (or equivalent) with `**user_id**`, `**plant_id**`.
- **b. (2 pts)** Pivot has `**timestamps()`** and **unique**(`user_id`, `plant_id`).
- **c. (2 pts)** Foreign keys to `**users`** and `**plants**`.
- **d. (2 pts)** `**User::belongsToMany(Plant::class, …)`** with correct pivot/table keys.
- **e. (2 pts)** `**Plant::belongsToMany(User::class, …)`** on the **same** pivot.

---

### 3 — Auth & create plant (20 points)

**Scope:** authenticated behaviour on `**/`** (redirect), `**layouts/navigation.blade.php**`, `**web.php**` middleware, plant create Blade, `**@csrf**`, `**PlantController@store**`. (Guest `**/**` + `**home**` route name → **§1**.)

#### Home route (`/`)

- **a. (1 pt)** Authenticated user on `**/`** → **redirect** to `**dashboard`** (e.g. `route('dashboard')`).

#### Navigation — `layouts/navigation.blade.php`

- **a. (1 pt)** `**@guest`:** plants (browse), log in, register — prefer `**route()`**.
- **b. (1 pt)** `**@auth`:** dashboard, plants, add plant, Breeze profile/logout.
- **c. (1 pt)** Guests must **not** see dashboard or “add plant” as normal nav links.

#### Create — Blade + `PlantController@store`

- **a. (4 pts)** Validate and **save** the plant (e.g. `**Plant::create`**).
- **b. (4 pts)** Form field name for the spot is `**spot`**, not `**garden_spot**`.
- **c. (2 pts)** Valid POST: redirect or flash — no **500**.

#### CSRF & middleware — `routes/web.php` + form

- **a. (1 pt)** Plant form includes `**@csrf`** (no **419** on POST).
- **b. (2 pts)** `**POST /plants`** behind `**auth**` (guest → redirect or **403**).
- **c. (1 pt)** `**GET /plants/create`** in the same `**auth**` (or `**verified**`) group as required.
- **d. (1 pt)** Guest must **not** see the create form.
- **e. (1 pt)** Logged in: create → submit → new plant in DB or list.

---

### Reference (exam vs solution)

The **exam** starter matches the tasks above. The **solution** may add extra UX (**all vs my plants**, **added by** on cards); your course can ignore that for marking unless it says otherwise.

**Run (exam or solution):**

```bash
cd exam/tasks-laravel/Garden   # or solution/...
composer install
cp .env.example .env            # if needed
php artisan key:generate
php artisan migrate:fresh --seed
npm install && npm run build    # Breeze assets
php artisan serve
```

---

## Part 2 — React + TypeScript (40 points)

Use **Node 20+**. In each task folder: `npm install`, `npm run dev`, `npm run build`. For `**03-rest-holidays`**, use `**server/**` + `**client/**`: start the API first (`cd …/03-rest-holidays/server && npm install && npm run dev`), then the Vite app (`cd …/03-rest-holidays/client && npm install && npm run dev`). For `**npm run build**` / `**vite preview**`, set `**VITE_HOLIDAYS_API_URL**` — see `**client/.env.example**`.

**Workload (40 points):** **R1** 15 + **R2** 10 + **R3** 15 (`01-weather-component`, `02-find-the-problems`, `03-rest-holidays`). Follow the `**exam**` starters and align with the `**solution**`. Each task includes a reference `**![](docs/images/react/…)**` GIF (from the *Kliensoldali webprogramozás* `**zh**` archive — same idea, not a pixel-perfect spec).

---

### R1 — `01-weather-component` (15 points) — weather UI

- **a. (3 pts)** Import `**weatherList**` (and `**WeatherCity**` if needed) from `**./data/weather**` and pass it to `**CitiesList**` so the city list shows and you can select a city.
- **b. (3 pts)** Store the **selected city** in React **state**; when the list is not empty, **default** to the **first** city.
- **c. (3 pts)** Wire `**handleCityChange(id)**` so it selects the city with that `**id**` (e.g. `weatherList.find(…)`).
- **d. (3 pts)** Pass the selected city into `**Forecast**` and render **name**, **icon**, **temperature**, and the **wind**, **humidity**, and **condition** fields from `**details**`.
- **e. (3 pts)** Keep the **°C / °F** switch inside `**Forecast**` as **local** `useState<'C' | 'F'>` and connect the radios to the bundled Celsius/Fahrenheit values.



---

### R2 — `02-find-the-problems` (10 points) — Task A + Task B

**Task A — `TaskA/TaskA.tsx**`

- **a. (3 pts)** Make **“+5 minutes”** update the **modified** clock immediately (minutes and carry hours as needed), as shown by `**Time**`.
- **b. (3 pts)** Make **“Toggle show seconds”** show or hide seconds on the **modified** clock **without** mutating the shared `**initialTime**` object used for **“Initial time”** (fix the shared-mutation / bad state update bug in the starter).

**Task B — `TaskB/Box.tsx**`

- **c. (4 pts)** When the user changes the colour `**<select>**`, update the positioned **box** fill so it matches the chosen colour (fix how `**Box**` reads `**color**` from props).



---

### R3 — `03-rest-holidays` (15 points) — API + router

- **a. (1 pt)** `**cd 03-rest-holidays/server**`, run `**npm install**` and `**npm run dev**` (default `**http://127.0.0.1:4010**`). Start the API **before** the Vite app in `**client/**`.
- **b. (2 pts)** Load countries and holidays **only via HTTP** from your Fastify app (fixtures live in `**server/data/*.json**`). Do **not** call `**date.nager.at**` and do **not** `**import**` those JSON files in the client as the main data source.

**API (reference)**


| Method | Path                                             | Response                                           |
| ------ | ------------------------------------------------ | -------------------------------------------------- |
| `GET`  | `/api/health`                                    | `{ "ok": true }`                                   |
| `GET`  | `/api/countries`                                 | Full `countries.json` array                        |
| `GET`  | `/api/countries/:countryCode/holidays?year=YYYY` | Holidays filtered by `countryCode` and year prefix |


- **c. (2 pts)** Use `**client/src/holidaysApi.ts**` (`countriesEndpoint`, `**holidaysEndpoint**`). In dev, `**client/vite.config.ts**` proxies `**/api**` to the server so `**fetch('/api/...')**` works; for `**npm run build**` / `**vite preview**`, set `**VITE_HOLIDAYS_API_URL**` as in `**client/.env.example**`. More detail: `**server/README.md**`.
- **d. (2 pts)** `**fetch**` the country list from `**GET /api/countries**` (or the proxied `**/api/countries**` path) and render a table of `**Link`**s to `**/{countryCode}`**.
- **e. (2 pts)** Set up `**main.tsx`** / `**react-router-dom**` with a **nested** route: parent layout shows the country table, child route `**:countryCode`** shows holidays with an `**Outlet**`.
- **f. (3 pts)** On the holidays screen, `**fetch`** `**GET /api/countries/:countryCode/holidays?year=…**` whenever **country** or **year** changes; add a working **year** input (`type="number"` or equivalent).
- **g. (3 pts)** Show each holiday’s **date** and **name** in a table and add a **“Back”** `**Link`** to `**/**`.



---

