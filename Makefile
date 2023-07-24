setup:
	@make build
	@make up

# Docker Compose
build:
	docker compose build --no-cache --force-rm
stop:
	docker compose stop
up:
	docker compose up -d