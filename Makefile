BUILD_DIR = lib

COMPOSER = bin/composer
COMPOSER_SOURCE = https://getcomposer.org/download/1.4.2/composer.phar

default: build-dev

.PHONY: build build-dev composer-build

build: COMPOSER_FLAGS = --no-dev
build: composer-build
	@echo 'Build successful!'

build-dev: COMPOSER_FLAGS = --dev
build-dev: composer-build
	@echo 'Build-dev successful!'

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
