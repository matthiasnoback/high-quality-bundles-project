# Stop RabbitMQ:

    rabbitmqctl stop

# Start RabbitMQ:

    rabbitmq-server  -detached

# RabbitMQ Management Web UI

    http://localhost:15672/

# Start asynchronous events consumer:

    app/console rabbitmq:consumer asynchronous_events -w

# Start asynchronous commands consumer:

    app/console rabbitmq:consumer asynchronous_commands -w
