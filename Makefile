BUILD_DIR = lib

COMPOSER = bin/composer
COMPOSER_SOURCE = https://getcomposer.org/download/1.4.2/composer.phar

PHPUNIT = vendor/bin/phpunit

default: build-dev

.PHONY: build build-dev composer-build
.PHONY: test test-unit

build: COMPOSER_FLAGS = --no-dev
build: composer-build
	@echo 'Build successful!'

build-dev: COMPOSER_FLAGS = --dev
build-dev: composer-build
	@echo 'Build-dev successful!'

test: test-unit

test-unit: build-dev
	$(PHPUNIT) --configuration tests/unit.xml $(PHPUNIT_FLAGS)

composer-build: $(COMPOSER) vendor

bin/composer: bin
	wget -O bin/composer "$(COMPOSER_SOURCE)"
	chmod +x bin/composer
	touch bin/composer

bin:
	mkdir bin

vendor: composer.lock
	$(realpath $(COMPOSER)) install $(COMPOSER_FLAGS)

composer.lock: composer.json
	$(realpath $(COMPOSER)) update $(COMPOSER_FLAGS)

clean:
	rm -rf bin vendor
