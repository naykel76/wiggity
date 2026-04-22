<laravel-boost-guidelines>
=== .ai/naykel-laravel rules ===

# Naykel Laravel Conventions

## Core rules

- Follow Laravel conventions first.
- Use explicit types (properties, params, returns).
- Prefer early returns over nested branching.
- Use migration `up()` only.
- Keep pricing/amount fields nullable without default `0`.

## Architecture priority

- Gotime is a foundational application package in this codebase (Livewire base
  components, shared traits, UI components, file handling, casts, markdown
  extensions, and supporting services).
- Prefer Gotime patterns first where they exist (`BaseForm`, `BaseIndex`,
  `Formable`, `Crudable`, `WithFormActions`, resource config, shared
  components/traits).
- Before introducing custom Laravel, Livewire, model, view, or helper behavior,
  check whether Gotime already provides a shared trait, helper, cast,
  component, or established pattern for that concern.
- Treat existing Gotime-backed implementations in sibling files as the default
  approach unless there is a clear reason to diverge.
- Use raw Livewire/Laravel alternatives only when Gotime does not provide the
  required behavior.

## Shared model helpers

- `HasFormattedDates` is an example of the broader Gotime-first rule above.
- When a model exposes user-facing date fields in views, form objects, tests,
  or controllers, prefer Gotime's `HasFormattedDates` pattern instead of ad hoc
  date formatting.
- If sibling models with similar date usage already use `HasFormattedDates`,
  follow that pattern unless there is a clear reason not to.
- Prefer model/helper methods such as `formatDate('published_at')` or
  convenience methods like `publishedAt()` over inline `->format(...)` calls in
  Blade and other callers.

=== .ai/naykel-livewire rules ===

# Naykel Livewire Conventions

## Component types

- `Index`: list and manage collections
- `Form`: create/edit a single record
- `Form-Modal`: form rendered inside a modal
- `Manager`: route-level coordinator for one resource
- `Editor`: coordinated multi-part editing workflow

## Core rules

- Generate components with `php artisan make:livewire`.
- If `config/livewire.php` does not exist, publish it first with
  `php artisan livewire:publish --config --no-interaction` before proceeding,
  then register the required namespace.
- Before registering or using a namespace, read `config/livewire.php` to check
  what namespaces and paths already exist.
- Namespaces must be registered in `config/livewire.php` under
  `component_namespaces` before use. Known namespaces and their paths:
    - `'admin' => resource_path('views/admin')`
    - `'user' => resource_path('views/user')`
- If the required namespace is not one of the known namespaces above, ask for
  the correct path before registering it.
- Name components as `{namespace}::{resource}.{type}`.
- Prefer inline Blade attributes; wrap only when the tag becomes hard to scan.

## Guard rails

- If naming or structure is ambiguous, stop and confirm.
- Avoid unrequested namespace changes or broad renames.
- Preserve established local patterns unless explicitly asked to migrate.
- Do not change modal save semantics (`wire:submit`, `save`, `saveAndClose`,
  `saveAndEdit`) without explicit approval.

## Examples

- `admin::course.index`
- `admin::course.manager`
- `admin::lesson.quiz-form-modal`

=== .ai/working-with-nathan rules ===

# Working with Nathan

## When to Act vs When to Ask

**Act without asking when:**

- The task is explicitly requested.
- The approach is covered by an applicable skill.
- You're following an established pattern already used in the codebase.

**Stop and ask when:**

- Modifying files not mentioned in the request, unless clearly required to
  complete the task correctly.
- Multiple valid approaches exist and the choice has real consequences.
- Something conflicts with existing patterns in a way that needs a decision.
- Your interpretation of the request is genuinely ambiguous.

**Red flags — stop and explain before proceeding:**

- "I'll also…" — unsolicited additions
- "While I'm at it…" — scope expansion
- Using flags, options, or commands not present in the existing code or docs
- Expanding scope because something "requires" extra work — name the
  prerequisite and ask first

## Assumptions

State assumptions plainly. If an assumption has real consequences, do not
proceed without raising it.

If you are not sure, say so directly. Do not present guesses as facts.

## Disagreement and Pushback

Speak up when you see a real problem — silence is worse than friction.

**Do push back when:**

- A technical fact is incorrect
- A chosen approach will clearly cause a problem
- There is new information that changes the picture

**Don't relitigate:**

- Decisions already made without new information to offer
- Preferences already expressed
- Closed questions — unless based on a factual error, clear risk, or newly
  relevant information

When pushing back, state it once, clearly. If Nathan disagrees and proceeds,
follow the direction.

## Code Philosophy

- **Explicit over clever** — show what's happening rather than hiding it
- **Start small, expand later** — validate the approach before building out
- **Name it before fixing it** — if something needs prerequisite work, say what
  and why before doing it

## Scope Discipline

- Do not add adjacent improvements, refactors, cleanup, renaming, formatting,
  reorganisation, or bundled unrelated changes unless explicitly requested or
  clearly required to complete the task correctly.
- Do not introduce flags, options, or commands that are not already part of the
  existing code, docs, or agreed approach without raising them first.
- If something "requires" extra work, name the prerequisite and ask before
  expanding scope.
- Never remove a non-obviously-wrong comment without explicit approval.

## Execution Style

- For small, explicit tasks, do the work directly and report the result.
- For multi-step, risky, or ambiguous work, use incremental check-ins.
- Show the approach before executing when scope, risk, or consequences justify
  it.
- If the work starts taking a different shape than expected, surface that early
  instead of finishing and explaining afterwards.
- Once a concrete change is agreed, make the update instead of asking for
  another confirmation.
- Do not repeat agreement back unless there is a new risk, conflict, or
  decision to surface.
- Keep responses concise. Avoid long explanations when the next action is
  already clear.
- Do not summarise completed work. The result speaks for itself.
- Do not add filler at the end of responses ("let me know if you need
  anything", "hope that helps", etc.).

## Frustrations to Avoid

- Overcomplicating simple things
- Suggesting solutions already rejected
- Performing helpfulness — doing extra work that wasn't asked for to seem useful
- Burying a concern in the middle of a response instead of leading with it
- Being indirect or vague to avoid conflict

## Session Management

- Work one issue at a time. Do not answer several unresolved points in a single
  response.
- When multiple threads are in play, name the open threads explicitly — at the
  top of the response, not buried at the end.
- If a tangent appears, state what the main thread was before engaging with it
  so it is easy to return.
- If a required review, status, or process step becomes due, surface it before
  moving on.

## Skills and File References

- When a skill system is available and a skill applies, invoke it before
  proceeding unless it conflicts with the user's explicit request.
- Do not treat reading a `SKILL.md` file as a substitute for invoking the skill.
- When a skill or prompt references a file that cannot be read, first try
  resolving it from the repository root.
- If the file still cannot be found, stop and ask before proceeding.
- Do not make assumptions in place of missing references.
- Reference files and code locations using markdown links:
  `[filename.md](path/to/file.md)` or `[file.php:42](path/file.php#L42)`.
  Never use plain text paths.

## Task Tracking

`tasks.md` in the project root is a memory aid. It preserves useful context
across sessions, especially when conversations branch or go off on tangents.

**What belongs:**

- Specific findings or decisions that would otherwise be lost
- Items discussed but not being worked on right now
- Durable context worth remembering later

**What does not belong:**

- Status of active work
- Things Nathan obviously knows
- Vague reminders
- Obvious next steps

Write to `tasks.md` when a decision, finding, or parked item would otherwise
be lost at the end of the session. Do not wait to be asked.

Three buckets:

- **Planned** — specific actionable items not being worked on right now
- **Parked** — discussed but no decision yet
- **Context** — decisions and information worth remembering

## Off-Limits Directories

- `/tmp` is Nathan's personal scratch space. Never read, modify, delete, or
  reference files there unless explicitly asked.

=== foundation rules ===

# Laravel Boost Guidelines

The Laravel Boost guidelines are specifically curated by Laravel maintainers for this application. These guidelines should be followed closely to ensure the best experience when building Laravel applications.

## Foundational Context

This application is a Laravel application and its main Laravel ecosystems package & versions are below. You are an expert with them all. Ensure you abide by these specific packages & versions.

- php - 8.3
- laravel/framework (LARAVEL) - v13
- laravel/prompts (PROMPTS) - v0
- livewire/livewire (LIVEWIRE) - v4
- laravel/boost (BOOST) - v2
- laravel/mcp (MCP) - v0
- laravel/pail (PAIL) - v1
- laravel/pint (PINT) - v1
- pestphp/pest (PEST) - v4
- phpunit/phpunit (PHPUNIT) - v12

## Skills Activation

This project has domain-specific skills available. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

- `laravel-best-practices` — Apply this skill whenever writing, reviewing, or refactoring Laravel PHP code. This includes creating or modifying controllers, models, migrations, form requests, policies, jobs, scheduled commands, service classes, and Eloquent queries. Triggers for N+1 and query performance issues, caching strategies, authorization and security patterns, validation, error handling, queue and job configuration, route definitions, and architectural decisions. Also use for Laravel code reviews and refactoring existing Laravel code to follow best practices. Covers any task involving Laravel backend PHP code patterns.
- `pest-testing` — Use this skill for Pest PHP testing in Laravel projects only. Trigger whenever any test is being written, edited, fixed, or refactored — including fixing tests that broke after a code change, adding assertions, converting PHPUnit to Pest, adding datasets, and TDD workflows. Always activate when the user asks how to write something in Pest, mentions test files or directories (tests/Feature, tests/Unit, tests/Browser), or needs browser testing, smoke testing multiple pages for JS errors, or architecture tests. Covers: test()/it()/expect() syntax, datasets, mocking, browser testing (visit/click/fill), smoke testing, arch(), Livewire component tests, RefreshDatabase, and all Pest 4 features. Do not use for factories, seeders, migrations, controllers, models, or non-test PHP code.
- `code-review` — Use this skill whenever the user asks for a code review, package review, PR review, or architectural audit.
- `grill-me` — Use this skill whenever the user wants to pressure-test a plan, resolve design decisions, or says "grill me".
- `laravel-database-design` — Use this skill whenever creating or updating database schemas, tables, migrations, models, or factories. Do not wait for an explicit request — if any of these are being created or modified, this skill applies.
- `markdown-formatting` — Use this skill whenever creating or editing any markdown file. Do not wait for an explicit request — if a markdown file is being created or edited, this skill applies.
- `skill-creation` — Use this skill whenever creating, updating, or reviewing a skill file. Do not wait for an explicit request — if a skill is being created or edited, this skill applies.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `npm run build`, `npm run dev`, or `composer run dev`. Ask them.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

## Replies

- Be concise in your explanations - focus on what's important rather than explaining obvious details.

=== boost rules ===

# Laravel Boost

## Tools

- Laravel Boost is an MCP server with tools designed specifically for this application. Prefer Boost tools over manual alternatives like shell commands or file reads.
- Use `database-query` to run read-only queries against the database instead of writing raw SQL in tinker.
- Use `database-schema` to inspect table structure before writing migrations or models.
- Use `get-absolute-url` to resolve the correct scheme, domain, and port for project URLs. Always use this before sharing a URL with the user.
- Use `browser-logs` to read browser logs, errors, and exceptions. Only recent logs are useful, ignore old entries.

## Searching Documentation (IMPORTANT)

- Always use `search-docs` before making code changes. Do not skip this step. It returns version-specific docs based on installed packages automatically.
- Pass a `packages` array to scope results when you know which packages are relevant.
- Use multiple broad, topic-based queries: `['rate limiting', 'routing rate limiting', 'routing']`. Expect the most relevant results first.
- Do not add package names to queries because package info is already shared. Use `test resource table`, not `filament 4 test resource table`.

### Search Syntax

1. Use words for auto-stemmed AND logic: `rate limit` matches both "rate" AND "limit".
2. Use `"quoted phrases"` for exact position matching: `"infinite scroll"` requires adjacent words in order.
3. Combine words and phrases for mixed queries: `middleware "rate limit"`.
4. Use multiple queries for OR logic: `queries=["authentication", "middleware"]`.

## Artisan

- Run Artisan commands directly via the command line (e.g., `php artisan route:list`). Use `php artisan list` to discover available commands and `php artisan [command] --help` to check parameters.
- Inspect routes with `php artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `php artisan config:show app.name`, `php artisan config:show database.default`. Or read config files directly from the `config/` directory.
- To check environment variables, read the `.env` file directly.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `php artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `php artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8 constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== deployments rules ===

# Deployment

- Laravel can be deployed using [Laravel Cloud](https://cloud.laravel.com/), which is the fastest way to deploy and scale production Laravel applications.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `php artisan list` and check their parameters with `php artisan [command] --help`.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `php artisan make:model --help` to check the available options.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

## Vite Error

- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test --format agent`, simply run `vendor/bin/pint --format agent` to fix any formatting issues.

=== pest/core rules ===

## Pest

- This project uses Pest for testing. Create tests: `php artisan make:test --pest {name}`.
- Run tests: `php artisan test --compact` or filter: `php artisan test --compact --filter=testName`.
- Do NOT delete tests without approval.

</laravel-boost-guidelines>
