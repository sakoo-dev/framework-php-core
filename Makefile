.PHONY: start
start:
	@make hello
	@chmod +x -R ./bin/.
	@cp -a ./bin/hooks/. ./.git/hooks
	@ln -s ./bin/sakoo ./sakoo
	@cp .env.example .env
	@./sakoo up -d --build
	@./sakoo composer install

.PHONY: up
up:
	@./sakoo up -d

.PHONY: down
down:
	@./sakoo down

.PHONY: restart
restart:
	@./sakoo restart

.PHONY: rm
rm:
	@./sakoo down -v --remove-orphans

.PHONY: lint
lint:
	@./sakoo php ./vendor/bin/php-cs-fixer fix .

# Actions
.PHONY: prepare
prepare:
	@make test
	@make lint
	@make doc

# Checking like CI Pipeline
.PHONY: check
check:
	@make test
	@./bin/test-coverage
	@./sakoo composer validate --strict
	@./sakoo composer audit
	@./sakoo composer lint
	@./sakoo composer analyse
	@docker build --check -f ./docker/sakoo.app/Dockerfile .
	# Should run make prepare => doc:gen
	# Sonar Qube + CI
	# run secret key checking
	# run dependency checking
	# run dockerfile security check (docker scout recommendations $DOCKER_IMAGE / docker scout cves $DOCKER_IMAGE)
	# endpoint healthcheck (/dev/healthcheck/)

.PHONY: test
test:
	@./sakoo test

.PHONY: test-coverage
test-coverage:
	@rm -rf ./storage/tests/coverage/
	@./sakoo test --coverage-html=storage/tests/coverage/
	@open ./storage/tests/coverage/index.html

.PHONY: analyse
analyse:
	@./sakoo php ./vendor/bin/phpstan analyse

.PHONY: fresh
fresh:
	@./sakoo composer dump-autoload

.PHONY: watch
watch:
	@./sakoo assist watch

.PHONY: doc
doc:
	@./sakoo assist doc:gen

.PHONY: shell
shell:
	@./sakoo shell

.PHONY: module-check
module-check:
	@./sakoo test "./tests/$(src)" --coverage-html=storage/tests/coverage/ || true
	@open ./storage/tests/coverage/index.html || true
	@./sakoo php ./vendor/bin/phpstan analyse "./src/$(src)" || true
	@./sakoo assist doc:gen "./src/$(src)" || true

.PHONY: hello
hello:
	@echo "\t\t======================="
	@echo "\t\t========="
	@echo "  ======================="
	@echo "\nSakoo Development Group\n"