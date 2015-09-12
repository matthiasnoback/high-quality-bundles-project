server {
    listen  80;
    server_name {{ nginx.servername }};
    root {{ nginx.docroot }};

    location / {
        # try to serve file directly, fallback to app.php
        try_files $uri /app_dev.php$is_args$args;
    }

    location ~ ^/(app_dev|config)\.php(/|$) {
        fastcgi_pass unix:/var/run/php5-fpm.sock;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    error_log /var/log/nginx/hexagonal_architecture_error.log;
    access_log /var/log/nginx/hexagonal_architecture_access.log;
}
