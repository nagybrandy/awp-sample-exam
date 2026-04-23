import { readFile } from 'node:fs/promises'
import { dirname, join } from 'node:path'
import { fileURLToPath } from 'node:url'

import cors from '@fastify/cors'
import Fastify from 'fastify'

const __dirname = dirname(fileURLToPath(import.meta.url))
const assetsDir = join(__dirname, 'data')

const [countriesRaw, holidaysRaw] = await Promise.all([
  readFile(join(assetsDir, 'countries.json'), 'utf8'),
  readFile(join(assetsDir, 'holidays.json'), 'utf8'),
])

const countries = JSON.parse(countriesRaw)
const holidays = JSON.parse(holidaysRaw)

const app = Fastify({ logger: true })

await app.register(cors, {
  origin: true,
})

app.get('/api/health', async () => ({ ok: true }))

app.get('/api/countries', async (_request, reply) => {
  reply.header('Cache-Control', 'public, max-age=60')
  return countries
})

app.get('/api/countries/:countryCode/holidays', async (request, reply) => {
  const { countryCode } = request.params
  const code = String(countryCode || '').toUpperCase()
  const year = Number(request.query.year)
  const y = Number.isFinite(year) && year > 0 ? String(year) : String(new Date().getFullYear())

  const rows = holidays.filter((h) => h.countryCode === code && h.date.startsWith(y))
  reply.header('Cache-Control', 'public, max-age=30')
  return rows
})

const port = Number(process.env.PORT) || 4010
const host = process.env.HOST || '127.0.0.1'

try {
  await app.listen({ port, host })
  app.log.info(`Holidays API → http://${host}:${port}  (CORS: any origin in dev)`)
} catch (err) {
  if (err && typeof err === 'object' && 'code' in err && err.code === 'EADDRINUSE') {
    app.log.error(
      { port, host },
      `Port ${port} is already in use. Stop the other Node process (or close the terminal that is still running "npm run dev"), or start on another port, e.g. PORT=4011 npm run dev — then point the Vite client at that port (VITE_HOLIDAYS_API_URL / proxy).`,
    )
  }
  throw err
}
