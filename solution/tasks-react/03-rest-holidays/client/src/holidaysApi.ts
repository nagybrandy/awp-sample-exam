/**
 * Holidays Fastify API base (no trailing slash).
 * If unset, use same-origin `/api/...` (Vite dev server proxies to `../server`).
 */
export function holidaysApiBase(): string {
  const raw = import.meta.env.VITE_HOLIDAYS_API_URL as string | undefined
  return raw?.replace(/\/$/, '') ?? ''
}

export function countriesEndpoint(): string {
  const b = holidaysApiBase()
  return b ? `${b}/api/countries` : '/api/countries'
}

export function holidaysEndpoint(countryCode: string, year: number): string {
  const b = holidaysApiBase()
  const path = `/api/countries/${encodeURIComponent(countryCode)}/holidays?year=${encodeURIComponent(String(year))}`
  return b ? `${b}${path}` : path
}
