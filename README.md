# Telegram Creator x Promoter Mini App (Laravel MVP)

This project is a working MVP for a Telegram-style creator marketplace:

- Promoters create profiles and post campaigns.
- Creators create profiles and apply to campaigns.
- Promoters review applicants and update status (`pending`, `shortlisted`, `accepted`, `rejected`).

## Core Flows

1. Promoter setup
- Open `/promoter/register`
- Create or switch the active promoter profile
- Post campaigns at `/campaigns/create`

2. Creator setup
- Open `/creator/register`
- Create or switch the active creator profile
- Browse campaigns at `/campaigns`
- Apply to a campaign from `/campaigns/{campaign}`

3. Application management
- Creators track applications at `/creator/applications`
- Promoters review applications at `/campaigns/{campaign}/applicants`

## Tech Notes

- Uses session-based active profiles (`creator_id`, `promoter_id`) for MVP simplicity.
- Schema-backed Eloquent models:
  - `Promoter`
  - `Creator`
  - `Campaign`
  - `CampaignApplication`
- Migrations are ordered so foreign keys run correctly on fresh installs.

## Setup

```bash
cp .env.example .env
php artisan key:generate
```

Set your DB in `.env`, then run:

```bash
php artisan migrate
php artisan serve
```

Open: `http://127.0.0.1:8000`

## Tests

Feature tests are included for:

- promoter campaign creation
- creator single-application guard
- promoter status updates

Run:

```bash
php artisan test
```

Note: current dependencies require `PHP >= 8.4`.
