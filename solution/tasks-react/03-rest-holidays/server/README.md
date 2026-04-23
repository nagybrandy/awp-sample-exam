# Holidays Fastify API (**required** for task `03-rest-holidays`)

Small **REST** server in this **`server/`** folder. It reads JSON fixtures from **`data/`** (`countries.json`, `holidays.json`) on disk (no public internet). The **React client** must **`fetch`** this API — no `date.nager.at`, and no **`import`** of those JSON files in the client.

## Run

From the **`server/`** directory:

```bash
cd server
npm install
npm run dev
```

Default: **`http://127.0.0.1:4010`**. Override with **`PORT`** / **`HOST`** (use **`HOST=0.0.0.0`** only for LAN access).

## Endpoints

| Method | Path | Description |
|--------|------|-------------|
| `GET` | `/api/health` | `{ "ok": true }` |
| `GET` | `/api/countries` | Same array as `data/countries.json` |
| `GET` | `/api/countries/:countryCode/holidays?year=2023` | Filtered holidays for that ISO country code and year |

**CORS:** `@fastify/cors` with `origin: true` so the client can call **`http://127.0.0.1:4010`** when **`VITE_HOLIDAYS_API_URL`** is set.

## Client dev (Vite proxy)

In **`../client/vite.config.ts`**, Vite **proxies** **`/api`** → **`http://127.0.0.1:4010`**. If **`VITE_HOLIDAYS_API_URL`** is **unset**, the browser uses **`/api/...`** (dev server forwards to this server). For **`npm run build`** / **`vite preview`**, set **`VITE_HOLIDAYS_API_URL=http://127.0.0.1:4010`** in **`client/.env`** / **`.env.production.local`**.

## Wire the client

See **`../client/.env.example`**. Use **`client/src/holidaysApi.ts`** (`countriesEndpoint`, `holidaysEndpoint`) in **`App.tsx`** and **`Holidays.tsx`**.

## Server won’t start

- **`EADDRINUSE` / “address already in use”** — port **4010** is taken (often another `npm run dev`). Stop that process, or run **`PORT=4011 npm run dev`** and set **`VITE_HOLIDAYS_API_URL=http://127.0.0.1:4011`** for preview/build; if you keep a custom port in dev, update the proxy target in **`../client/vite.config.ts`**.
- Run from **`server/`** after **`npm install`**. Use **`npm run dev`** (watch) or **`npm start`** (no watch).
