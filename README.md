# AWP sample exam (40 + 40)

This repository contains an **exam** starter (`exam/`) and a **reference solution** (`solution/`). Part 1 is server-side (Laravel **Garden**). Part 2 is client-side (three small React + TypeScript apps).

| Area                                    | Points | Pass threshold |
| --------------------------------------- | ------ | -------------- |
| Part 1 — Laravel (`exam/tasks-laravel`) | 40     | ≥ 40% (16 pts) |
| Part 2 — React (`exam/tasks-react/*`)   | 40     | ≥ 40% (16 pts) |

Course rules: both parts must reach at least **40%**, the exam is in-person and supervised, you may bring prepared materials and **official language documentation** only, **no public internet** during the exam. The `03-rest-holidays` task uses a **local Fastify API** (fixtures on disk) — not third-party HTTP APIs.

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

Task descriptions and scoring live in **this README**. `03-rest-holidays` also has a short `README.md` at that task root (`client/` + `server/` layout).

---

## Part 1 — Laravel: **Garden** (40 points)

A small **plants** app: each plant has a `name`, a `spot`, and an optional `care_note`. The starter is a Laravel app with **Breeze** already installed (auth, `<x-app-layout>`, navigation, dashboard). The exam ships with a `plants` table, a seeder, and a separate migration that adds `user_id` to `plants`. Set `APP_NAME=Garden` in `.env`. The reference solution adds extra UX (an "all vs my plants" page, "added by" on cards) — your course can ignore that for marking unless it says otherwise.

**Three blocks (40 points):**

- **L1** — Listing routes + `plants/index` Blade (10)
- **L2** — Many-to-many: pivot migration + Eloquent relations (10)
- **L3** — Auth, navigation, create plant (20)

Recommended order: **L1 → L2 → L3**.

Screenshots under each block were captured from a running **Garden** app (`solution/tasks-laravel/Garden` after `migrate:fresh --seed`, `npm run build`, `php artisan serve` on `http://127.0.0.1:8011`).

---

### L1 — `routes/web.php` + `PlantController` + `plants/index` (10 points)

Public guest **home** at `/` (with a plant counter), and a public **plants listing** at `/plants` driven by the controller.

Files: `routes/web.php`, `app/Http/Controllers/PlantController.php`, `resources/views/home.blade.php`, `resources/views/plants/index.blade.php`. Look for `// TODO (L1)` markers.

- **a. (1 pt)** Register `GET /` and name the route `home`.
- **b. (1 pt)** When the user is **not** logged in, return the `home` view and pass `plantCount` (e.g. `Plant::count()`).

![Guest home (`/`) with plant count](docs/images/laravel/laravel-home.png)

- **c. (2 pts)** Register `GET /plants` pointing to `PlantController@index`, route name `plants.index`.
- **d. (2 pts)** In `PlantController@index`, load the plants and `return view('plants.index', compact('plants'))` instead of any placeholder view.
- **e. (2 pts)** In `plants/index.blade.php`, **keep** the existing `<x-app-layout>` and `<x-slot name="header">…</x-slot>` shell — replace the hard-coded demo card inside the grid with a `@foreach ($plants as $plant)` (or equivalent) loop that renders the actual data.
- **f. (1 pt)** For each plant, show `name`, `spot`, and `care_note` when present, using the responsive Tailwind grid/card pattern from the starter.
- **g. (1 pt)** After `php artisan migrate:fresh --seed`, opening `/plants` renders without errors.

![Public plants listing (`/plants`)](docs/images/laravel/laravel-plants-all.png)

---

### L2 — Many-to-many: `plant_user` pivot + Eloquent relations (10 points)

Add a many-to-many relation between users and plants (e.g. "users that grow this plant"). The exam starter does **not** include the pivot migration — you create it.

Files: a new migration in `database/migrations/`, `app/Models/User.php`, `app/Models/Plant.php`. Look for `// TODO (L2)` markers in the models.

- **a. (2 pts)** Create a migration for a `plant_user` table (or equivalent name) with `user_id` and `plant_id` columns.
- **b. (2 pts)** The pivot has `timestamps()` and a **unique** index on `(user_id, plant_id)`.
- **c. (2 pts)** Both columns are foreign keys: `user_id → users.id`, `plant_id → plants.id`.
- **d. (2 pts)** On the `User` model, define the correct relation with the correct pivot table and key names with belongsToMany to Plants.
- **e. (2 pts)** On the `Plant` model, define the correct relation with the correct pivot table and key names with belongsToMany to Users.

There is no separate pivot admin UI; after seeding, the reference **dashboard** lists **Plants you tend** from the `plant_user` relation.

![Dashboard: plants linked via `plant_user`](docs/images/laravel/laravel-l2-pivot-dashboard.png)

---

### L3 — Auth, navigation, create plant (20 points)

Make the app behave correctly for logged-in vs guest users: redirect home for auth users, split the navbar, and let a logged-in user actually save a new plant via the form.

Files: `routes/web.php`, `resources/views/layouts/navigation.blade.php`, `resources/views/plants/create.blade.php`, `app/Http/Controllers/PlantController.php`. Look for `// TODO (L3)` and `{{-- TODO (L3) --}}` markers.

**Home route — `routes/web.php`**

- **a. (1 pt)** When a logged-in user opens `/`, **redirect** to `dashboard` (e.g. `redirect()->route('dashboard')`) instead of returning the guest home.

![Logged-in user visiting `/` is redirected to the dashboard](docs/images/laravel/laravel-l2-pivot-dashboard.png)

**Navigation — `resources/views/layouts/navigation.blade.php`**

- **b. (1 pt)** Inside `@guest`: show only the public links (browse plants, log in, register). Prefer `route()` over hard-coded URLs.
- **c. (1 pt)** Inside `@auth`: show the logged-in links (dashboard, plants, add plant) and the Breeze profile / log-out controls.
- **d. (1 pt)** Guests must **not** see the "Dashboard" or "Add plant" links in the main nav.

![Guest `/login` — browse + auth links only](docs/images/laravel/laravel-login.png)

![Authenticated nav on `/plants`](docs/images/laravel/laravel-l3-nav-authenticated.png)

**Create plant — `plants/create.blade.php` + `PlantController@store`**

- **e. (4 pts)** In `store()`, after the validation block, **persist** the plant (e.g. `Plant::create([...])`) using the validated input plus the current user id.
- **f. (4 pts)** In `plants/create.blade.php`, the spot input must be `name="spot"` (the starter ships with `name="garden_spot"`, which fails validation).
- **g. (2 pts)** A valid POST results in a clean redirect or flash message — no HTTP **500**.

![`/plants/create` form (same page carries `@csrf` for h.)](docs/images/laravel/laravel-l3-create-plant.png)

**CSRF & route protection — `routes/web.php` + the form**

- **h. (1 pt)** The plant form includes `@csrf` so POST requests don't fail with **419**.
- **i. (2 pts)** `POST /plants` is behind the `auth` middleware: a guest hitting it gets redirected (or a **403**), never to a working save.
- **j. (1 pt)** `GET /plants/create` is in the same `auth` (or `verified`) group, so guests can't open the form either.
- **k. (1 pt)** Guests do **not** see the create form at all (no link, route blocks them).
- **l. (1 pt)** Logged-in: opening the form, submitting valid data, the new plant appears in the database / on the listing.

---

### Run (exam or solution)

```bash
cd exam/tasks-laravel/Garden   # or solution/tasks-laravel/Garden
composer install
cp .env.example .env            # if needed
php artisan key:generate
php artisan migrate:fresh --seed
npm install && npm run build    # Breeze assets
php artisan serve
```

---

## Part 2 — React + TypeScript (40 points)

Use **Node 20+**. In each task folder: `npm install`, `npm run dev`, `npm run build`. For `03-rest-holidays`, start the API in `server/` first (`cd …/03-rest-holidays/server && npm install && npm run dev`), then the Vite app in `client/` (`cd …/03-rest-holidays/client && npm install && npm run dev`). For `npm run build` / `vite preview`, set `VITE_HOLIDAYS_API_URL` — see `client/.env.example`.

**Three blocks (40 points):**

- **R1** — `01-weather-component` (15)
- **R2** — `02-find-the-problems` (10)
- **R3** — `03-rest-holidays` (15)

Each block includes **PNG screenshots** taken from the running **solution** Vite dev apps (local `npm run dev`, same idea as the old course GIFs — not a pixel-perfect spec).

---

### R1 — `01-weather-component` (15 points) — weather UI

- **a. (3 pts)** Import `weatherList` (and `WeatherCity` if needed) from `./data/weather` and pass it to `CitiesList` so the city list shows and you can select a city.
- **b. (3 pts)** Store the **selected city** in React state; when the list is not empty, default to the **first** city.
- **c. (3 pts)** Wire `handleCityChange(id)` so it selects the city with that `id` (e.g. `weatherList.find(…)`).

![Reference: `01-weather-component` dev server](docs/images/react/r1-weather.png)

- **d. (3 pts)** Pass the selected city into `Forecast` and render `name`, `icon`, `temperature`, plus the `wind`, `humidity`, and `condition` fields from `details`.
- **e. (3 pts)** Keep the **°C / °F** switch inside `Forecast` as local `useState<'C' | 'F'>` and connect the radios to the bundled Celsius / Fahrenheit values.

---

### R2 — `02-find-the-problems` (10 points) — Task A + Task B

**Task A — `TaskA/TaskA.tsx`**

- **a. (3 pts)** Make **"+5 minutes"** update the **modified** clock immediately (minutes carry into hours as needed), as shown by the `Time` component.
- **b. (3 pts)** Make **"Toggle show seconds"** show or hide seconds on the **modified** clock **without** mutating the shared `initialTime` object that drives "Initial time" — fix the shared-mutation / bad state update bug in the starter.

![Reference: Task A (`02-find-the-problems`)](docs/images/react/r2-find-the-problems.png)

**Task B — `TaskB/Box.tsx`**

- **c. (4 pts)** When the user changes the colour `<select>`, update the positioned **box** fill so it matches the chosen colour (fix how `Box` reads `color` from props).

---

### R3 — `03-rest-holidays` (15 points) — API + router

- **a. (1 pt)** `cd 03-rest-holidays/server`, run `npm install` and `npm run dev` (default `http://127.0.0.1:4010`). Start the API **before** the Vite app in `client/`.
- **b. (2 pts)** Load countries and holidays **only via HTTP** from your Fastify app (fixtures live in `server/data/*.json`). Do **not** call `date.nager.at` and do **not** `import` the JSON files directly in the client as the main data source.

![Reference: country list (`/`, solution `03-rest-holidays` client)](docs/images/react/r3-rest-holidays-countries.png)

**API (reference)**

| Method | Path                                             | Response                                           |
| ------ | ------------------------------------------------ | -------------------------------------------------- |
| `GET`  | `/api/health`                                    | `{ "ok": true }`                                   |
| `GET`  | `/api/countries`                                 | Full `countries.json` array                        |
| `GET`  | `/api/countries/:countryCode/holidays?year=YYYY` | Holidays filtered by `countryCode` and year prefix |

- **c. (2 pts)** Use `client/src/holidaysApi.ts` (`countriesEndpoint`, `holidaysEndpoint`). In dev, `client/vite.config.ts` proxies `/api` to the server so `fetch('/api/...')` works; for `npm run build` / `vite preview`, set `VITE_HOLIDAYS_API_URL` as in `client/.env.example`. More detail in `server/README.md`.
- **d. (2 pts)** `fetch` the country list from `GET /api/countries` (or the proxied `/api/countries` path) and render a table of `Link`s to `/{countryCode}`.
- **e. (2 pts)** Set up `main.tsx` / `react-router-dom` with a **nested** route: the parent layout shows the country table, the child route `:countryCode` shows holidays through an `Outlet`.
- **f. (3 pts)** On the holidays screen, `fetch` `GET /api/countries/:countryCode/holidays?year=…` whenever the **country** or **year** changes; add a working **year** input (`type="number"` or equivalent).

![Reference: holidays + year (`/:countryCode`, e.g. `/AD`)](docs/images/react/r3-rest-holidays-detail.png)

- **g. (3 pts)** Show each holiday's **date** and **name** in a table and add a **"Back"** `Link` to `/`.

---
