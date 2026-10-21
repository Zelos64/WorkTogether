# AGENTS.md

This is the Symfony app. The repo root also has a separate, console-only Composer install; it does not contain this app's dependencies. Run app commands from this directory.

## Stack and layout

- Symfony 8.1 on PHP >=8.4. `FrameworkBundle`, Doctrine ORM, Doctrine Migrations, and SecurityBundle are installed (`config/bundles.php`). No Twig, Serializer, Validator, MakerBundle, PHPUnit, or php-cs-fixer.
- `src/` is `App\` (PSR-4) and is auto-wired by `config/services.yaml`. Put controllers in `src/Controller/`; `#[Route]` attributes are auto-loaded through `routing.controllers` in `config/routes.yaml`.
- No `templates/` or `assets/` directory exists yet. Do not assume Twig. Doctrine entities live in `src/Entity/` and migrations in `migrations/`.
- `App\Entity\Utilisateur` is an abstract single-table-inheritance entity with `Administrateur` (`ROLE_ADMIN`) and `Comptable` (`ROLE_COMPTABLE`) children. Security uses the `Utilisateur` entity provider with `json_login` at `/api/login`; `ROLE_ADMIN` inherits `ROLE_COMPTABLE`.
- `config/reference.php` is generated; do not edit it. Do not hand-edit `symfony.lock`.
- Install packages with `composer require` and let Flex update `config/bundles.php` and package config. `extra.symfony.allow-contrib` is `false`, so contrib recipes need explicit opt-in.

## Commands (run here)

- Install dependencies: `composer install`
- Console: `php bin/console <command>` (or `symfony console <command>`)
- Dev server: `symfony serve -d` (serves `public/`)
- Smoke checks: `php bin/console about`, `php bin/console debug:router`, `php bin/console lint:container`
- Doctrine checks that work without a running DB: `doctrine:mapping:info`, `doctrine:schema:validate --skip-sync`, `doctrine:schema:create --dump-sql`. Migration commands require the database.
- From the repo root, use `composer --working-dir=worktogether ...` or `php worktogether/bin/console ...`. Never use the root Composer install for this app's dependencies.

## Testing

- There is no test runner, `tests/` directory, or CI configuration. Do not run `phpunit`/`bin/phpunit` or claim tests passed.
- If tests are requested, install `symfony/test-pack`, place tests in `tests/` (`App\Tests\`), and use `WebTestCase`/`KernelTestCase`.
- Available verification today: `php bin/console lint:container`, `debug:router`, and `doctrine:mapping:info`.

## Environment and style

- `.env` is committed with defaults (`APP_ENV=dev`, `DEFAULT_URI=http://localhost`); `.env.dev` holds the dev `APP_SECRET`. Put real secrets in `.env.local` (gitignored) or `bin/console secrets:set`.
- `DATABASE_URL` in `.env` defaults to local MySQL `worktogether` as `root` with no password. Adjust it or override it in `.env.local`; no database service is started by this repo.
- `var/` (cache, logs) is gitignored; the dev log is `var/log/dev.log`.
- Follow `.editorconfig` (LF, 4-space indent, final newline) and Symfony's `@Symfony` style. No formatter or linter is installed.

## Symfony conventions

- Use PHP attributes for framework metadata (`#[Route]`, `#[AsCommand]`, `#[AsEventListener]`, `#[Assert\...]`, etc.), not YAML/XML route definitions. Rely on autowiring and autoconfiguration; use `#[Autowire]`/`#[Target]` only when type hints are not enough.
- Controllers extend `AbstractController`, stay thin, and delegate to services.
- Prefer framework components over hand-rolled infrastructure (Form, Validator, Serializer, Messenger, Security, Lock). Add the component with `composer require` when the task needs it.
- Bind request data with `#[MapRequestPayload]`/`#[MapQueryString]` (after installing Serializer/Validator) instead of manual JSON parsing. Use `symfony/lock` for mutual exclusion.
- If MakerBundle is added, pass all arguments and `--no-interaction`; otherwise makers can hang non-interactive shells.
- Doctrine schema changes go through migrations (`doctrine:migrations:diff`, then `doctrine:migrations:migrate`), never `doctrine:schema:update`. Migrations require a reachable database; `doctrine:mapping:info` does not.
- If a task is ambiguous about persistence, UI, or auth, ask before scaffolding a stack.
