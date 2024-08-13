start:
	$(call print_sakoo)
	@chmod +x -R ./bin/.
	@cp -a ./bin/hooks/. ./.git/hooks
	@ln -s ./bin/sakoo ./sakoo
	@cp .env.example .env
	@./sakoo up -d --build
	@./sakoo composer install
# mkdir storage/* folders

up:
	@./sakoo up -d

down:
	@./sakoo down

restart:
	@./sakoo restart

rm:
	@./sakoo down -v --remove-orphans

stylefix:
	@./sakoo php ./vendor/bin/php-cs-fixer fix .

check:
	@make test-coverage
	$(call get_user_confirmation)
	@./sakoo composer analyze
	@./sakoo composer validate --strict
	@./sakoo composer stylecheck
#	run dependency checking
# run dockerfile security check
# endpoint healthcheck (/dev/healthcheck/)

analyze:
	@./sakoo composer analyze

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

commit:
	@./sakoo assist commit

# ------------------------ ADD IT TO GITHUB ACTIONS WORKFLOW | GIT PRE_COMMIT ------------------------
push:
	@make check
# suggest composer package / php version update
	@make doc
	@make commit
#	still here and wait for user confirmation
	@git push

# --- MAKE COMMIT CHALLENGES ---
# classification changes
  # using a component pattern map on the project and classify changes based on it
# finding type of changes
  # --
# finding scope of changes
  # using component pattern map
# finding subject changes
  # --

# --- RULES ---
# - Limited to to 50 Chars
# - Without special chars and dot (only # ! are allowed in scope)
# - Without Capital Chars
# - Without Whitespaces
# - Use present tense or imperative mood
# - introduces a breaking API change by refactoring because of the “!” symbol

# --- EXAMPLES ---
# type(optional: scope): subject
# feat(lang): add french language to refactored lang module
# fix(#123): remove sql desc clause
# refactor(!routing): change routing interface
# test: write a test

# --- TYPES ---
# feat (Minor / Major on !) – a new feature is introduced with the changes
# refactor (Minor / Major on !) – refactored code that neither fixes a bug nor adds a feature
# fix (Patch) – a bug fix has occurred
# perf (Patch) – performance improvements
# revert (Based on Previous Commit) – reverts a previous commit
# build (Noting) – changes that affect the build system or external dependencies
# chore (Noting) – changes that do not relate to a fix or feature and don't modify src or test files (for example updating dependencies)
# docs (Nothing) – updates to documentation such as a the README or other markdown files
# style (Nothing) – changes that do not affect the meaning of the code, likely related to code formatting such as white-space, missing semi-colons, and so on.
# test (Nothing) – including new or correcting previous tests
# ci (Nothing) – continuous integration related

define get_user_confirmation
	@read -p "Is it okay to you? " -n 1 -r; \
			if [[ $$REPLY =~ ^[Nn] ]]; \
			then \
					exit 1; \
			fi
endef

define print_sakoo
	echo '---'
endef