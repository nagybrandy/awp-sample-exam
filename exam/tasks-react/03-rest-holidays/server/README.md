# Holidays Fastify API (**required** for task `03-rest-holidays`)

Small **REST** server in **`server/`**. Reads fixtures from **`data/`** (`countries.json`, `holidays.json`). Your client **must** load data via **`fetch`** to this API (see **`../client/src/holidaysApi.ts`**).

```bash
cd server
npm install
npm run dev
```

| Method | Path | Description |
|--------|------|-------------|
| `GET` | `/api/health` | `{ "ok": true }` |
| `GET` | `/api/countries` | Country list |
| `GET` | `/api/countries/:countryCode/holidays?year=YYYY` | Filtered holidays |

Default **`http://127.0.0.1:4010`**. **CORS** enabled. **`../client/vite.config.ts`** proxies **`/api`** → this server in dev.

### Server won’t start

- **`EADDRINUSE` / “address already in use”** — something else is already bound to **4010** (often another `npm run dev` you left running). Stop that process, or use another port, e.g. **`PORT=4011 npm run dev`**. For the Vite dev client, start with **`HOLIDAYS_API_PROXY_TARGET=http://127.0.0.1:4011 npm run dev`** (see **`../client/vite.config.ts`**). For **`vite preview`** / build, set **`VITE_HOLIDAYS_API_URL=http://127.0.0.1:4011`** in **`../client/.env`**.
- Run from the **`server/`** directory after **`npm install`**. Use **`npm run dev`** (watch) or **`npm start`** (no watch).
