# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),

## [Unreleased] - 2023-08-21

### Added
 - Add `taggable` model.
 - Add `store` method in repository.
 - Add `StoreTagJob` job.

## [Unreleased] - 2023-08-21

### Added
 - Add `unique` to `slug` in `tags` table migration.
 - Add generate slug in model creating event.

### Changes
 - Change `title` to `name` in `tags`.

## Unreleased - 2023-08-21

### Added
 - Add `uuid` to migrations and config file.
 - Add `enabled`, `name`, and `middleware` to routes and config file.
 - Add `taggable_uuid` to config file and update migrations.

### Changes
 - Extend controller from `RestController` class from `briofy/rest-laravel` package.
 - Update config file routes object.

## [0.0.0] - 2023-05-29
### Add
- [a98560f](https://github.com/Briofy/tag-laravel/commit/a98560f82fc119893077efa7042894c86fa8062e) Initial commit of the project