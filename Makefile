run-local:
	@php artisan serve

run:
	@php artisan serve --host=0.0.0.0

migrate:
    @php artisan migrate

fresh-seed:
    @php artisan migrate:fresh --seed

test:
    @php artisan test

test-feature:
    @php artisan test --testsuite=Feature

test-unit:
    @php artisan test --testsuite=Unit
