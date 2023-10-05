init:
	@chmod +x ./bin/sakoo
	@ln -s ./bin/sakoo ./sakoo
	@cp .env.example .env
	@./sakoo up -d --build
	@./sakoo composer install

up:
	@./sakoo up -d

down:
	@./sakoo down

rm:
	@./sakoo down -v --remove-orphans

stylefix:
	@./sakoo php ./vendor/bin/php-cs-fixer fix

check:
	@./sakoo php ./vendor/bin/phpstan analyse --level max src tests
	@./sakoo ./vendor/bin/php-cs-fixer fix --dry-run

test:
	@./sakoo test

test-coverage:
	@rm -rf ./storage/tests/coverage/
	@./sakoo test --coverage-html=storage/tests/coverage/
	@open ./storage/tests/coverage/index.html

fresh:
	@./sakoo composer dump-autoload

watch:
	@./sakoo assist watch

doc:
	@./sakoo assist doc:gen